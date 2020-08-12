<?php
session_start();

// comprobamos si estamos logados
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Welcome</title>

        <LINK REL="stylesheet" TYPE="text/css" href="estilos.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

    </head>
    <body>

        <?php
        require_once "../view/cabecera.php";
        ?>

        <br><p>

        <h2 class = "text-center">REGISTRAR NUEVA TAREA</h2><br>
        <form action="../controller/nuevaCreacion.php" method="post">
            <fieldset>
                <div class="form-group row">
                    <label for="lnombre" class="col-sm-1 col-form-label">Nombre:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="nombre" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð]{2,50}" maxlength="50" autofocus required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lemail" class="col-sm-1 col-form-label">E-mail:</label>
                    <div class="col-sm-5">
                        <input type="email" class="form-control" placeholder="mail@mail.com" name="email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ldesc" class="col-sm-1 col-form-label">Descripción</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="desc" maxlength="150" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ldir" class="col-sm-1 col-form-label">Dirección:</label>
                    <div class="col-sm-5">

                        <input type="text" class="form-control" placeholder="calle, número, piso, ciudad" name="dir">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lcp" class="col-sm-1 col-form-label">CP:</label>
                    <div class="col-sm-3">

                        <input type="number" class="form-control" placeholder="código postal" maxlength="5" name="cp">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lpass" class="col-sm-1 col-form-label">Contraseña:</label>
                    <div class="col-sm-3">
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
                    </div>
                </div>

            </fieldset>
        </form>

    </p><br>


    <div class="align-items-left">
        <a href="mostrarDatos.php" class="btn btn-danger">Listar tareas</a>
    </div>
</body>
</html>