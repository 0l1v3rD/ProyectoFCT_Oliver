<?php
    include("../Controller/db.inc");
    session_start();
    if(isset($_GET["ins"])){
        $nombre = "Camiseta negra";
        $color = htmlspecialchars($_POST["color"]);
        if($fav == true){
            $fav = "Si";
        }
        else{
            $fav = "No";
        }
        $precio = htmlspecialchars($_POST["precio"]);
        // Stack Overflow
        $sql = "SELECT id FROM pedido_detalles WHERE id=( SELECT max(id) FROM pedido_detalles )";
        $id = mysqli_query($conn, $sql);
        $sql = "INSERT into pedidos()";
    }
    if(!isset($_SESION["carrito"])){
        $_SESSION["carrito"] = array();
    }
    $ultimo = 0;
    for ($i=0; $i < count($_SESSION["carrito"]); $i++) {
        $ultimo += 1;
    }
    $_SESSION["carrito"][$ultimo] = $id;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camiseta negra</title>
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
    <!--Import de header y footer -->
    <script src="https://code.jquery.com/jquery-3.3.1.js" 
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
    </script>
    <script>
        $(function(){
            $("#header").load("header.php"); 
            $("#footer").load("footer.php"); 
        });
    </script>
</head>
<body>
    <div id="header"></div>
    <main>
        <p class="ms-3 mt-2"><a title="Inicio" href="index.html">Inicio</a> > <a title="Camiseta" href="camiseta.html">Camiseta</a></p>
        <form id="producto" action="camiseta.php?ins=1" class="d-flex justify-content-around">
            <div>
                <img title="" src="img/isolated_white_and_black_t_shirt_front_view-no-bg.png" alt="Camiseta">
            </div>
            <div class="border border-1 ">
                <div class="align-self-end p-2">
                    <button type="button"><img src="img/heart (1).png" width="60px" alt="Favorito"></button>
                </div>
                <div class="align-content-center p-5">
                    <h2>Camiseta negra básica.</h2>
                    <p>Camiseta negra básica para hombre.</p>
                    <p><b class="text-success">19.99&euro;</b></p>
                    <p>Colores:</p>
                    <div id="color" class="container">
                        <button type="button"><img src="img/button.png" title="Negro" width="30px" alt="Negro"></button>
                        <button type="button"><img src="img/fc000953-f397-4cc1-ad92-9a4108cc4768.png" title="Blanco" width="30px" alt="Blanco"></button>
                    </div>
                    <p>Almacén más cercano: <b class="text-success">Torrevieja</b></p>
                    <p>Envio: <b class="text-success">Gratis</b></p>
                    <p>Stock: <b class="text-success">5</b></p>
                    <p><?= mysqli_insert_id($conn); ?></p>
                    <a href="carrito.php"><button class="btn btn-primary" type="button">Añadir al carrito.</button></a>
                    <?php
                        if(count($_SESSION["carrito"]) == 0 && isset($_SESSION["nombre"])):
                    ?>
                    <br><button id="comprar" class="btn btn-warning" type="submit">Comprar.</button>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </main>
    <div id="footer"></div>
</body>
</html>