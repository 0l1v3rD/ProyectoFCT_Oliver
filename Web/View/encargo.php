<?php
    session_start();
    include("../Controller/db.inc");
    if(isset($_GET["ins"])){
        $nombre = $_POST["nombre"];
        $desc = $_POST["descripcion"];
        $stock = $_POST["stock"];
        $tipo = $_POST["tipo"];
        // Imagen
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
        $sql = "INSERT INTO productos(nombre, descripcion, stock, encargo, tipo, img_url) VALUES('$nombre', '$desc', '$stock', 1, '$tipo', '$img_url')";
        if(mysqli_query($conn, $sql)){
            $insertado = TRUE;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encargo</title>
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
    <main class="d-flex justify-content-center">
        <?php if($insertado): ?>
            <h2 class="text-success"></h2>
        <?php endif; ?>
        <form action="encargo.php?ins=" enctype="multipart/form-data" class="d-flex flex-column justify-content-center m-4 w-75 gap-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input name="nombre" type="text" class="form-control" placeholder="Nombre">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" placeholder="Descripción"></textarea>
            <label for="stock" class="form-label">Stock</label>
            <input name="stock" type="number" min="1" max="999">
            <label for="tipo" class="form-label">Tipo de producto:</label>
            <input name="tipo">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </main>
    <div id="footer"></div>
</body>
</html>