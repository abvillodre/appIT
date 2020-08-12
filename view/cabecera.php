<html>
    <head>
        <title>title</title>
        <link rel=”stylesheet” type=”text/css” href=”estilo.css”>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    </head>
    <body>

        <div class="contenidoCabecera">
            <h5 style="float: left">Hola, <b><?php echo htmlspecialchars($_SESSION["nomUsuario"]); ?></b>. Bienvenid@</h5>
            <a href="logout.php" class="btn btn-danger" style="float: right">Cerrar sesión</a>
        </div>

    </body>
</html>
