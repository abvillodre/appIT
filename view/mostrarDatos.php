<?php
session_start();
?>

<html>
    <head>
        <LINK REL="stylesheet" TYPE="text/css" href="estilos.css"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <title>Listado de tareas</title>
    </head>
    <body>

<?php
require_once "../view/cabecera.php";
?>
        <br><br>
        <div class="contenidoTabla">
            <table class="table table-striped" style="border:1;">


                <thead>
                    <tr>
                        <td><font face="verdana"><b>Nombre</b></font></td>
                        <td><font face="verdana"><b>Email</b></font></td>
                        <td><font face="verdana"><b>Descripción</b></font></td>
                        <td><font face="verdana"><b>Dirección</b></font></td>
                        <td><font face="verdana"><b>Código Postal</b></font></td>
                    </tr>
                </thead>
                <tbody>
<?php
require_once "../config/config.php";

$sql = "SELECT nombre, descripcion, email, direccion, cp FROM tareas";


$result = mysqli_query($link, $sql);
$numero = 0;

while ($row = mysqli_fetch_array($result)) {
    echo "<tr><td><font face=\"verdana\">" .
    $row["nombre"] . "</font></td>";
    echo "<td><font face=\"verdana\">" .
    $row["email"] . "</font></td>";
    echo "<td><font face=\"verdana\">" .
    $row["descripcion"] . "</font></td>";
    echo "<td><font face=\"verdana\">" .
    $row["direccion"] . "</font></td>";
    echo "<td><font face=\"verdana\">" .
    $row["cp"] . "</font></td></tr>";
    $numero++;
}
echo "<tr><td colspan=\"5\"><font face=\"verdana\"><b>Total: " . $numero .
 "</b></font></td></tr>";
?>
                <tbody>

            </table>
        </div>
        <a href="principal.php" class="btn btn-danger">Registrar nueva tarea</a>
    </body>
</html>
