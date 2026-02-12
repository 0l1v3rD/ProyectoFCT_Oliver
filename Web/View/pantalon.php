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
        $sql = "INSERT into ";
    }
    $_SESSION["carrito"] = array();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalón</title>
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
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
    </script>
    <script>
        $(function(){
            $("#header").load("header.php?pagina=producto"); 
            $("#footer").load("footer.php"); 
        });
        function $carr(){

        }
    </script>
</head>
<body>
    <div id="header"></div>
    <main>
        <p class="ms-3 mt-2"><a title="Inicio" href="index.php">Inicio</a> > <a title="Inicio" href="pantalon.php">Pantalón</a></p>
        <form id="producto" class="d-flex justify-content-around">
            <div>
                <img src="img/dsf.png" height="500px" alt="Camiseta">
            </div>
            <div class="border border-1 align-content-center">
                <div class="align-self-end p-2">
                    <button type="button"><img src="img/heart (1).png" width="60px" alt="Favorito"></button>
                </div>
                <div class="align-content-center p-5">
                    <h2>Pantalón negro básico.</h2>
                    <p>Pantalón negro básico para hombre.</p>
                    <p><b class="text-success">24.99&euro;</b></p>
                    <p>Colores:</p>
                    <div id="color" class="container">
                        <button type="button"><img src="img/button.png" title="Negro" width="30px" alt="Negro"></button>
                        <button type="button"><img src="img/fc000953-f397-4cc1-ad92-9a4108cc4768.png" title="Blanco" width="30px" alt="Blanco"></button>
                    </div>
                    <p>Almacén más cercano: <b class="text-success">Torrevieja</b></p>
                    <p>Envio: <b class="text-success">Gratis</b></p>
                    <p>Stock: <b class="text-success">2</b></p>
                    <a href="desarrollo.php"><button class="btn btn-primary" onclick="$carr()" type="submit">Añadir al carrito.</button></a>
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