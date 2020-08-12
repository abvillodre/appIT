<?php
// Incluimos el archivo de configuracion de bd
require_once "../config/config.php";
 
// Procesamos los datos del formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
 

  
$nombre = trim($_POST["nombre"]);    
$password = $_POST["password"];
$email = trim($_POST["email"]);    
$desc = $_POST["desc"];
$dir = trim($_POST["dir"]);
$cp = trim($_POST["cp"]);
    
    
    
    
        // preparamps el insert
        $sql = "INSERT INTO tareas (nombre, email, descripcion, direccion, cp,  password) VALUES (?, ?, ?, ?, ?, ?)";
         
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Seteamos parametros a la consulta
            mysqli_stmt_bind_param($stmt,'ssssis', $nombre, $email, $desc, $dir, $cp, $password);
            
            // ejecutamos la consulta
            if(mysqli_stmt_execute($stmt)){
                // si es ok, redirigimos a la pag principal
                echo '<script">alert("Tarea añadida correctamente");</script>';
               header("location: ../view/principal.php");
            } else{
                echo "Algo salió mal, por favor inténtalo de nuevo.";
            }
        }else{
            echo 'fail';
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    
    
    // Close connection
    mysqli_close($link);
}
?>