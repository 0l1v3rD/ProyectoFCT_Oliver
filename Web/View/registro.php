<?php
    session_start();
    include("../Controller/db.inc");
    include("../Controller/mail/mail.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    if(isset($_GET["registro"])){
        if(isset($_SESSION["email"])){
            header("index.php");
        }
        $nombre = htmlspecialchars($_POST["nombre"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = sha1(htmlspecialchars($_POST["password"]));
        $genero = htmlspecialchars($_POST["genero"]);
        $direccion = htmlspecialchars($_POST["direccion"]);
        $poblacion = htmlspecialchars($_POST["poblacion"]);
        $provincia = htmlspecialchars($_POST["provincia"]);
        $postal = htmlspecialchars($_POST["postal"]);
        $allowedExtensions = ['jpg', 'png'];
        // Check
        if(isset($_FILES["img_usr"]) && $_FILES["img_usr"]["error"] == 0){
            // Tipos de imagen aceptados
            $allowedExtensions = ['jpg', 'png'];
            // Tipo de imagen
            $tipo = strtolower(pathinfo($_FILES["img_usr"]["name"], PATHINFO_EXTENSION));
            // Si tipo esta aceptado
            if(in_array($tipo, $allowedExtensions)){
                // uniqid genera un numero que si o si es unico y lo pongo como nombre de imagen con su tipo al final
                $nombre_archivo = uniqid('', true) . '.' . $tipo;
                // Donde voy a mandar la imagen junto a la imagen en si
                $ruta_destino = './img/img_usr/' . $nombre_archivo;
                // Mueve imagen
                if(move_uploaded_file($_FILES["img_usr"]["tmp_name"], $ruta_destino)){
                    // Para que los ficheros en View puedan acceder
                    $imagen_url_completa = "./img/img_usr/" . $nombre_archivo;
                }
            }
        }
        // Verifico si usuario esta ya en la base de datos
        $sql = "SELECT * FROM usuarios WHERE email='$email'";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
            $_SESSION["error"] = "Usuario";
            header("registro.php");
        }
        else{
            // Verifico si usuario esta ya en la base de datos
            $sql = "SELECT * FROM clientes WHERE email='$email'";
            $res = mysqli_query($conn, $sql);
            if(mysqli_num_rows($res) > 0){
                $_SESSION["error"] = "Cliente";
                header("registro.php");
            }
            else{
                # Lo mismo con el cliente
                $sql = "INSERT into usuarios(nombre, email, password, imagen_url) VALUES('$nombre', '$email', '$password', '$imagen_url_completa')";
                if(mysqli_query($conn, $sql)){
                    $sql = "INSERT into clientes(nombre, apellidos, email, genero, direccion, codpostal, poblacion, provincia  password) VALUES('$nombre', '$apellidos', '$email', '$genero', '$direccion', '$codpostal', '$poblacion', '$provincia', '$password')";
                    if(mysqli_num_rows($res) > 0){
                        header("registro.php");
                    }
                    else{
                        if(mysqli_query($conn, $sql)){
                            // Mail
                            $mail = new PHPMailer(true);
                            try {
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                // Autenticacion
                                $mail->SMTPAuth = true;
                                // El que lo manda
                                $mail->Username = 'oliveraprietabotones@gmail.com';
                                // Clave de Gmail del que lo manda (Cuidado!)
                                $mail->Password = 'vkcd mquk hqwr kact';
                                // Encriptacion
                                $mail->SMTPSecure = 'tls';
                                $mail->Port = 587;
                                $mail->setFrom('oliveraprietabotones@gmail.com', 'C-Weight Company');
                                // El que lo recibe
                                $mail->addAddress('$_POST["email"]');
                                // Titulo del mail
                                $mail->Subject = 'Registro en C-Weight';
                                // Contenido
                                $mail->Body = "Felicidades $nombre, se ha registrado correctamente en la tienda C-Weight, ahora podrá añadir productos al carrito, añadir productos a su lista de deseados y mucho más!!!";
                                $mail->send();
                                $mail_code = 0;
                            } catch (Exception $e) {
                                $mail_code = 1;
                            }
                        }
                    }
                    header("./inicio_sesion.php");
                }
            }
        } 
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro C-Weight</title>
    <link rel="icon" type="image/x-icon" href="./img/logo.png">
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
            <?php if($_SESSION["error"] == "Cliente"): ?>
                <h2 class="text-danger">Error, ya hay un cliente con ese email.</h2>
            <?php endif; ?>
            <?php if($_SESSION["error"] == "Usuario"): ?>
                <h2 class="text-danger">Error, ya hay un usuario con ese email.</h2>
            <?php endif; ?>
            <form action="registro.php?registro=1" method="post" enctype="multipart/form-data" class="d-flex flex-column justify-content-center m-4 w-75 gap-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input class="form-control" required type="text" label="nombre" name="nombre" maxlength="50">
                <label for="nombre" class="form-label">Apellidos</label>
                <input class="form-control" required type="text" label="apellidos" name="apellidos" maxlength="75">
                <p class="form-label">Género</p>
                <div class="">
                    <input id="M" type="radio" name="genero" value="M"> <label class="form-label" for="M">Mujer</label><br>
                    <input id="H" type="radio" name="genero" value="H"> <label class="form-label" for="H">Hombre</label><br>
                </div>
                <label for="email" class="form-label">Dirección</label>
                <input id="direccion" required class="form-control" type="text" label="direccion" name="direccion" maxlength="100">
                <label for="poblacion" class="form-label">Población</label>
                <input id="poblacion" required class="form-control" type="text" label="poblacion" name="poblacion" maxlength="100">
                <label for="provincia" class="form-label">Provincia</label>
                <input id="provincia" required class="form-control" type="text" label="provincia" name="provincia" maxlength="100">
                <label for="direccion" class="form-label">Dirección</label>
                <input id="direccion" required class="form-control" type="text" label="direccion" name="direccion" maxlength="100">
                <label for="postal" class="form-label">Cod. Postal</label>
                <input id="postal" required class="form-control" type="number" label="postal" name="postal" maxlength="5">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" required class="form-control" type="text" label="email" name="email" maxlength="50">
                <label for="password" required class="form-label">Contraseña</label>
                <input id="password" class="form-control" type="password" label="password" name="password">
                <label for="img">Imágen de usuario:</label>
                <input id="img_usr" class="form-control" type="file" accept=".jpg, .png" label="img_usr" name="img_usr">
                <button type="submit" id="registro" class="btn form-control">Registrarse</button>
            </form>
        </div>
        <div class="d-flex d-none d-lg-flex align-items-center justify-content-center w-50">
            <img alt="Persona levantando peso" width="500px" height="500px" src="img/barbell-black-and-white-black-and-white-791763.jpg">
        </div>
    </main>
    <div id="footer"></div>
</body>
</html>