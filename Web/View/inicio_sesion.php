<?php
    session_start();
    if(isset($_SESSION["nombre"])){
        header("location: ./index.php");
    }
    include("../Controller/db.inc");
    include("../Controller/mail/mail.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    if(isset($_GET["inicio"])){
        $email = htmlspecialchars($_POST["email"]);
        $password = sha1(htmlspecialchars($_POST["password"]));
        $sql = "SELECT * FROM usuarios WHERE email='$email' AND password='$password'";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
            unset($_SESSION["error"]);
            $usuario = mysqli_fetch_assoc($res);
            $_SESSION["nombre"] = $usuario["nombre"];
            $_SESSION["imagen"] = $usuario["imagen_url"];
            header("Location: ./index.php");
        }
        else{
            $_SESSION["error"] = "Login";
            header("Location: ./inicio_sesion.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
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
            <h1 class="text-center m-2">Inicio de sesión</h1>
            <?php if(isset($_SESSION["error"]) && $_SESSION["error"] == "login"): ?>
                <p class="text-danger">Error, la contraseña o el email son incorrectos.</p>
            <?php endif; ?>
            <form action="inicio_sesion.php?inicio=1" method="post" class="d-flex flex-column justify-content-center m-4 w-75 gap-3">
                <label for="email" class="form-label">Correo electronico</label>
                <input id="email" class="form-control" placeholder="Email" required type="text" label="email" name="email">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" class="form-control" placeholder="Contraseña" required type="password" label="password" name="password">
                <button type="submit" id="inicio" class="btn btn-warning form-control">Iniciar sesión</button>
            </form>
            <p>No tienes cuenta? <a href="./registro.php" class="text-warning">Registrate</a></p>
        </div>
        <div class="d-flex d-none d-lg-flex align-items-center justify-content-center w-50">
            <img alt="Persona levantando peso" width="500px" height="500px" src="img/barbell-black-and-white-black-and-white-791763.jpg">
        </div>
    </main>
    <div id="footer"></div>
</body>
</html>