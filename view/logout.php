<?php
// inicializamos la sesión
session_start();
 

$_SESSION = array();
 
// destruimos la sesión
session_destroy();
 
//redirigimos al login
header("location: ../index.php");
exit;
?>