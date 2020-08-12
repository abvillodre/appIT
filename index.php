<?php
// iniciamos la sesión
session_start();

// comprobamos si el usuario esta logado con el objeto sesión
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: view/principal.php");
    exit;
}

require_once "config/config.php";

// definimos variables de error
$nomUsuario = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //comprobamos si son vacios
    if (empty(trim($_POST["nomUsuario"]))) {
        $username_err = "Por favor ingrese su usuario.";
    } else {
        $nomUsuario = trim($_POST["nomUsuario"]);
    }


    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor ingrese su contraseña.";
    } else {
        $password = trim($_POST["password"]);
    }

    // validacion
    if (empty($username_err) && empty($password_err)) {

        $sql = "SELECT id, nomUsuario, password FROM usuarios WHERE nomUsuario = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "s", $param_username);


            $param_username = $nomUsuario;


            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_store_result($stmt);

                // comprobamos si el usuario existe, si existe comprobamos contraseña
                if (mysqli_stmt_num_rows($stmt) == 1) {

                    mysqli_stmt_bind_result($stmt, $id, $nomUsuario, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            //guardamos las variables de sesión
                            session_start();


                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["nomUsuario"] = $nomUsuario;

                            // redirigimos
                            header("location: view/principal.php");
                        } else {
                            //mostramos error si no es correcta
                            $password_err = "La contraseña que has ingresado no es válida.";
                            echo "Algo salió mal, por favor vuelve a intentarlo.";
                        }
                    }
                } else {
                    // mostramos que no existe el usuario
                    $username_err = "No existe cuenta registrada con ese nombre de usuario.";
                }
            } else {
                echo "Algo salió mal, por favor vuelve a intentarlo.";
            }
        } else {
            echo "Algo salió mal, por favor vuelve a intentarlooooo.";
        }
    }

    // cerramos conexión
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>app Ingeteam</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            body{ font: 14px sans-serif;  width: 840px; background-color: #EEEDE9;}
            .contenidoLogin{ padding: 20px;
                      margin-left: 445px;
            }

        </style>
    </head>
    <body>
        <div class="contenidoLogin">
            <h2>Login APP PROYECTO INGETEAM</h2>
            <p>Por favor, complete sus credenciales para iniciar sesión.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label>Usuario</label>
                    <input type="text" name="nomUsuario" class="form-control" value="<?php echo $nomUsuario; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>    
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Ingresar">
                </div>
                <p>¿No tienes una cuenta? <a href="register.php">Regístrate ahora</a>.</p>
            </form>
        </div>    
    </body>
</html>