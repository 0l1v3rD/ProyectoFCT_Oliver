<?php
    session_start();
    include("../Controller/db.inc");
    include("../Controller/mail/mail.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    $mail_cliente = $_SESSION["email"];
    if(!isset($_SESSION["id"])){
        header("Location: inicio_sesion.php");
    }
    if(isset($_POST["nombre"])){
        $nombre = $_POST["nombre"];
        $desc = $_POST["descripcion"];
        $stock = $_POST["stock"];
        $tipo = $_POST["tipo"];
        // Imagen
        $allowedExtensions = ['jpg', 'png'];
        // Check
        if(isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0){
            // Tipos de imagen aceptados
            $allowedExtensions = ['jpg', 'png'];
            // Tipo de imagen
            $tipo = strtolower(pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION));
            // Si tipo esta aceptado
            if(in_array($tipo, $allowedExtensions)){
                // uniqid genera un numero que si o si es unico y lo pongo como nombre de imagen con su tipo al final
                $nombre_archivo = uniqid('', true) . '.' . $tipo;
                // Donde voy a mandar la imagen junto a la imagen en si
                $ruta_destino = './img/img_prod/' . $nombre_archivo;
                // Mueve imagen
                if(move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_destino)){
                    // Para que los ficheros en View puedan acceder
                    $imagen_url_completa = "./img/img_prod/" . $nombre_archivo;
                }
            }
        }
        // Inserto el producto como producto con encargo 1 (1 es que es un encargo)
        $sql = "INSERT INTO productos(nombre, descripcion, stock, encargo, tipo, img_url) VALUES('$nombre', '$desc', '$stock', 1, '$tipo', '$img_url_completa')";
        if(mysqli_query($conn, $sql)){
            $insertado = TRUE;
            $sql = "SELECT id FROM pedidos WHERE id = (SELECT MAX(id) FROM pedidos)";
            if(mysqli_query($conn, $sql)){
                $res = mysqli_query($conn, $sql);
                $pedido = mysqli_fetch_assoc($res);
                // ID maxima que hay ahora +1 para insertar
                $id_pedido = $pedido["id"] + 1;
            }
            else{
                // Si no hay se pone 0, ayuda para poder inicializar la tabla con números nuevos
                $id_pedido = 0;
            }
            $sql = "INSERT into pedidos(id, id_cliente, fecha_inicio, fecha_final, estado) VALUES($id_pedido, $id_usuario, '$fecha_hoy', '$fecha_formato', 'Pendiente')";
            $res = mysqli_query($conn, $sql);
                if($res){
                    $sql = "SELECT id FROM pedidos WHERE id = (SELECT MAX(id) FROM pedidos)";
                    $res = mysqli_query($conn, $sql);
                    $pedido = mysqli_fetch_assoc($res);
                    $id_pedido = $pedido["id"];
                    $sql = "SELECT id FROM pedidos WHERE id=(SELECT max(id) FROM productos)";
                    $id_producto = $prod["id"];
                    $sql = "SELECT * FROM productos WHERE id = $id_producto";
                    $res = mysqli_query($conn, $sql);
                    $producto = mysqli_fetch_assoc($res);
                    if($res){
                        if($producto["stock"] >= 1){
                            $precio_total = $producto["precio_unidad"] * $prod["cantidad"];
                            $cantidad_producto = $prod["cantidad"]; 
                            $sql = "INSERT into pedido_detalles(id_pedido, id_producto, cantidad, precio_total) VALUES($id_pedido, $id_producto, '$cantidad_producto', '$precio_total')";
                            $res = mysqli_query($conn, $sql);
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
                                $mail->addAddress("oliverdominguezmoreno@gmail.com");
                                // Titulo del mail
                                $mail->Subject = 'Encargo realizado';
                                // Contenido
                                $mail->Body = "El cliente " . $_SESSION['nombre'] . " ha realizado un encargo de un producto " . $tipo . "\n Tiene el nombre " . $nombre . ".";
                                $mail->send();
                            }
                            catch (Exception $e) {
                                $_SESSION["error"] = "Error correo automático";
                            }
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
                                $mail->addAddress("$mail_cliente");
                                // Titulo del mail
                                $mail->Subject = 'Encargo realizado';
                                // Contenido
                                $mail->Body = "Felicidades, hemos recibido el encargo y hemos empezado en su creación, si tiene algún detalle más en la producción o quiere preguntar cualquier cosa sobre su encargo, porfavor, no dude en enviarnos un email a soporte@c-weight.com \n Gracias por la confianza que tiene en nosotros!";
                                $mail->send();
                            }
                            catch (Exception $e) {
                                $_SESSION["error"] = "Error correo automático a cliente";
                            }
                        }
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
        <?php if(isset($insertado) && $insertado): ?>
            <h2 class="text-success">Encargo enviado!</h2>
        <?php endif; ?>
        <form action="encargo.php" enctype="multipart/form-data" class="d-flex flex-column justify-content-center m-4 w-75 gap-3">
            <h2>Encargo</h2>
            <label for="nombre" class="form-label">Nombre:</label>
            <input name="nombre" type="text" class="form-control" placeholder="Nombre">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" placeholder="Descripción" class="form-control border-1 border-black"></textarea>
            <label for="stock" class="form-label">Stock</label>
            <input name="stock" type="number" min="1" max="999" class="form-control border-1 border-black">
            <label for="tipo" class="form-label">Tipo de producto:</label>
            <input name="tipo" type="text" class="form-control border-1 border-black">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </main>
    <div id="footer"></div>
</body>
</html>