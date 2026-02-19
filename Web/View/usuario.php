<?php
    session_start();
    include("../Controller/db.inc");
    include("../Controller/mail/mail.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    if(isset($_GET["upd"])){
        $nombre = htmlspecialchars($_POST["usr"]) ? htmlspecialchars($_POST["usr"]) : $_SESSION["nombre"];
        $imagen_url_completa = $_SESSION["imagen"];
        $email = $_SESSION["email"];
        $id = $_SESSION["id"];
        $sql = "SELECT password FROM usuarios WHERE nombre='$nombre' AND email='$email'";
        $res = mysqli_query($conn, $sql);
        $usuario = mysqli_fetch_row($res);
        $password = sha1(htmlspecialchars($_POST["password"])) ?? $usuario["password"];
        // Imagen
        $allowedExtensions = ['jpg', 'png'];
        // Check
        if(isset($_FILES["imagen_url"]) && $_FILES["imagen_url"]["error"] == 0){
            // Tipos de imagen aceptados
            $allowedExtensions = ['jpg', 'png'];
            // Tipo de imagen
            $tipo = strtolower(pathinfo($_FILES["imagen_url"]["name"], PATHINFO_EXTENSION));
            // Si tipo esta aceptado
            if(in_array($tipo, $allowedExtensions)){
                // uniqid genera un numero que si o si es unico y lo pongo como nombre de imagen con su tipo al final
                $nombre_archivo = uniqid('', true) . '.' . $tipo;
                // Donde voy a mandar la imagen junto a la imagen en si
                $ruta_destino = './img/img_usr/' . $nombre_archivo;
                // Mueve imagen
                if(move_uploaded_file($_FILES["imagen_url"]["tmp_name"], $ruta_destino)){
                    // Para que los ficheros en View puedan acceder
                    $imagen_url_completa = "./img/img_usr/" . $nombre_archivo;
                }
            }
        }
        $sql = "UPDATE usuarios SET nombre='$nombre', password='$password', imagen_url='$imagen_url_completa' WHERE id='$id'";
        $res = mysqli_query($conn, $sql);
        if($res){
            $sql = "SELECT * FROM usuarios WHERE id='$id'";
            $res = mysqli_query($conn, $sql);
            $usuario = mysqli_fetch_assoc($res);
            $_SESSION["nombre"] = $usuario["nombre"];
            $_SESSION["email"] = $usuario["email"];
            $_SESSION["id"] = $usuario["id"];
            $_SESSION["imagen"] = $usuario["imagen_url"];
            header("Location: ./index.php");
        }
        else{
            $_SESSION["error"] = "Update";
            header("Location: ./usuario.php?id=$id");
        }
    }
    if(!isset($_SESSION["nombre"])){
        header("location: ./inicio_sesion.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
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
    <p class="ms-3 mt-2"><a title="Inicio" href="index.php">Inicio</a> > <a title="Usuario" href="usuario.php">Usuario</a></p>
    <main class="d-flex flex-lg-row flex-column justify-content-center">
        <div class="d-flex flex-column justify-content-center align-items-center w-100">
            <img id="usr" src="<?php if($_SESSION["imagen"] != ""){ echo($_SESSION["imagen"]); } else{ echo("./img/people.png"); } ?>" width="400px" height="400px">
            <a href="./desc.php"><img id="desc" src="./img/8917901.png"></a>
        </div>
        <div id="d_usr" class="d-flex flex-column d-md-flex align-items-center justify-content-center border border-2 w-100 h3">
            <p id="nombre_usr">Nombre: <?= $_SESSION["nombre"] ?></p>
            <p id="email">Email: <?= $_SESSION["email"] ?></p>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <img src="./img/pencil.png" width="25px">
            </button>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="usuario.php?id=<?= $_SESSION["id"] ?>&upd=1" enctype="multipart/form-data" method="post">
            <label class="form-label">Usuario</label>
            <input type="text" name="usr" class="form-control">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control">
            <br>
            <input id="imagen_url" class="form-control" type="file" accept=".jpg, .png" label="img_usr" name="imagen_url">
            <br>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
    </main>
    <div id="footer"></div>
    <script>
        let $nombre_upd = document.getElementById("nombre_upd");
        let $email_upd = document.getElementById("email_upd");
        $nombre_upd.addEventListener("click", () => {
            $nombre_upd.innerHTML = `<form class="form">
                <input class="form-control form-text" type="text" name="nombre" value="<?= $_SESSION["nombre"] ?>">
                <button class="btn btn-primary" type="submit">
            </form>`;
        });
    </script>
</body>
</html>