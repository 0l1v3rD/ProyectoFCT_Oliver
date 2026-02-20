<?php
    include("../Controller/db.inc");
    $carrito = array();
    $contador = 0;
    if(isset($_GET["id"])){
        $_SESSION["carrito"][] = $_GET["id"];
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
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
        <p class="ms-3 mt-2"><a title="Inicio" href="index.php">Inicio</a> > <a title="Camiseta" href="carrito.php">Carrito</a></p>
        <div class="m-3">
            <?php
            if(isset($_GET["id"])){
                foreach ($_SESSION["carrito"] as $id) {
                    $sql = "SELECT * FROM productos WHERE id='$id'";
                    $res = mysqli_query($conn, $sql);
                    $carrito[] = $res;
                }
            }
            ?>
            <h1>Carrito:</h1>
            <div class="container border border-1 d-flex">
                <div class="container row col-md-4">
                    <?php foreach($carrito as $prod): 
                        $contador++;
                    ?>
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column text-center">
                                <a href="producto.php?id=<?= $prod["id"] ?>"><img src="<?php if($prod["img_url"] != ""){ echo($prod["img_url"]); } else{ echo("./img/broken-image.png"); } ?>" class="img-fluid mb-3"
                                title="<?= $prod["nombre"] ?>" alt="<?= $prod["nombre"] ?>" height="250px"></a>
                                <p class="card-text"><?= $prod["nombre"] ?></p>
                            </div>
                        </div>            

                </div>
                    <?php endforeach; ?>
            </div>
        </div>
    </main>
    <div id="footer"></div>
</body>
</html>