<?php
    session_start();
    include("../Controller/mail/mail.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    include("../Controller/db.inc");
    if(!isset($_SESSION["email"])){
        header("Location: index.php");
    }
    $email = $_SESSION["email"];
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    if(mysqli_query($conn, $sql)){
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
            $usuario = mysqli_fetch_assoc($res);
            $email = $usuario["email"];
        }
    }
    else{
        $_SESSION["error"] = "Usuario";
        header("Location: carrito.php");
    }
    if(isset($_SESSION["carrito"]) && count($_SESSION["carrito"]) > 0){
        $fecha_hoy = date_create();
        $fecha_formato = date_add($fecha_hoy, date_interval_create_from_date_string("40 days"));
        $fecha_hoy = date_sub($fecha_hoy, date_interval_create_from_date_string("40 days"));
        $fecha_hoy = $fecha_hoy->format('Y-m-d');
        $fecha_formato = $fecha_formato->format('Y-m-d');
        $carrito = $_SESSION["carrito"];
        $id_usuario = $_SESSION["id"];
        $sql = "SELECT id FROM pedidos WHERE id = (SELECT MAX(id) FROM pedidos)";
        $res = mysqli_query($conn, $sql);
        $pedido = mysqli_fetch_assoc($res);
        $id_pedido = $pedido["id"] + 1;
        $sql = "INSERT into pedidos(id, id_cliente, fecha_inicio, fecha_final, estado) VALUES($id_pedido, $id_usuario, '$fecha_hoy', '$fecha_formato', 'Pendiente')";
        $res = mysqli_query($conn, $sql);
            if($res){
                $sql = "SELECT id FROM pedidos WHERE id = (SELECT MAX(id) FROM pedidos)";
                $res = mysqli_query($conn, $sql);
                $pedido = mysqli_fetch_assoc($res);
                $id_pedido = $pedido["id"];
                foreach ($carrito as $prod) {
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
                            if($res){
                                unset($_SESSION["carrito"]);
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
                                    $mail->addAddress($email);
                                    // Titulo del mail
                                    $mail->Subject = 'Registro en C-Weight';
                                    // Contenido
                                    $mail->Body = "Pedido realizado en $fecha_hoy correctamente , entrega estimada en $fecha_formato.";
                                    $mail->send();
                                }
                                catch (Exception $e) {
                                    $_SESSION["error"] = "Error correo automático";
                                }
                            }
                        }
                    }
                        else{
                            $_SESSION["error"] = "Pedido";
                            header("Location: carrito.php");
                        }
                }
            }
        }
        else{
            header("Location: index.php");
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido completado</title>
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
        <h1>Gracias por su compra!</h1>
    </main>
    <div id="footer"></div>
</body>
</html>