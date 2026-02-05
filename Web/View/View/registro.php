<?php
    if(isset($_GET["registro"])){
        session_start();
        $_SESSION['usuario'] = $_POST['usuario'];
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro C-Weight</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="index.css" rel="stylesheet">
    <!--Fuentes-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gravitas+One&family=Nunito:ital,wght@0,700;1,700&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.js" 
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script>
        $(function(){
            $("#header").load("header.php"); 
            $("#footer").load("footer.php"); 
        });
    </script>
</head>
<body>
    <div id="header"></div>
    <p class="ms-3 mt-2"><a title="Inicio" href="index.php">Inicio</a> > <a title="Registro" href="registro.php">Registro</a></p>
    <main class="d-flex flex-row justify-content-center">
        <div class="d-flex flex-column justify-content-center align-items-center w-50">
            <h1 class="text-center m-2">Registro</h1>
            <form action="registro.php?registro=1" method="post" class="d-flex flex-column justify-content-center m-4 w-75 gap-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input id="usuario" class="form-control" type="text" label="usuario" name="usuario">
                <!--<label class="form-label">Apellidos</label>
                <input id="apellidos" class="form-control" type="text" label="apellidos" name="apellidos">-->
                <label for="email" class="form-label">Correo electronico</label>
                <input id="email" class="form-control" type="text" label="email" name="email">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" class="form-control" type="password" label="password" name="password">
                <button type="button" id="registro" class="btn form-control">Registrarse</button>
            </form>
        </div>
        <div class="d-flex d-none d-lg-flex align-items-center justify-content-center w-50">
            <img alt="Persona levantando peso" width="500px" height="500px" src="img/barbell-black-and-white-black-and-white-791763.jpg">
        </div>
    </main>
    <div id="footer"></div>
</body>
</html>