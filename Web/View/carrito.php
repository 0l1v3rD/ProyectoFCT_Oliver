<?php
    session_start();    
    include("../Controller/db.inc");
    $contador = 0;
    $precio_total = 0;
    if(!isset($_SESSION["id"])){
        header("Location: inicio_sesion.php");
    }
    if(isset($_SESSION["carrito"])){
        if((isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0') && isset($_GET["id"])){
            header("Location: carrito.php");
        }
        else{
            if(isset($_GET["id"])){
                if(isset($_GET["cantidad"])){
                    $id = $_GET["id"];
                    $sql = "SELECT id FROM productos WHERE id=$id";
                    $res = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($res) > 0){
                        $cantidad = $_GET["cantidad"];
                        for ($i=0; $i < $cantidad; $i++) {
                            $_SESSION["carrito"][] = [
                                "id" => $id,
                                "cantidad" => $cantidad
                            ];
                        }
                    }
                }
            }
            if(isset($_GET["emp"])){
                if($_GET["emp"] == "*"){
                    $_SESSION["carrito"] = array();
                }
                if(is_numeric($_GET["emp"])){
                    $pos = array_search($_GET["emp"], $_SESSION["carrito"]);
                    unset($_SESSION["carrito"][$pos]);
                }
            }
            $carrito = array_merge($_SESSION["carrito"]);
        }
    }
    else{
        header("location: inicio_sesion.php");
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
        <p class="ms-3 mt-2"><a title="Inicio" href="index.php">Inicio</a> > <a title="Carrito" href="carrito.php">Carrito</a></p>
        <h1>Carrito:</h1>
        <?php if(isset($_SESSION["error"]) && $_SESSION["error"] == "Pedido"): ?>
            <p class="text-danger">Error en el pedido, contacte con el soporte si necesita ayuda.</p>
        <?php endif; ?>
        <?php if(count($_SESSION["carrito"]) > 0): ?>
        <div class="m-3 d-flex justify-content-around">
            <div class="container border border-1 d-flex justify-content-center">
                <div class="row g-2 p-1 w-100 m-2 justify-content-center">
                    <?php foreach($carrito as $prod):
                        $id = $prod["id"];
                        $contador += $prod["cantidad"];
                        $sql = "SELECT * FROM productos WHERE id='$id'";
                        $res = mysqli_query($conn, $sql);
                        $prod = mysqli_fetch_assoc($res);
                        $precio_total += $prod["precio_unidad"];
                    ?>
                        <div class="col-12 col-md-4 m-0 p-2">
                            <div class="card h-100 m-1">
                                <div class="card-body p-0 d-flex flex-column text-center align-items-center">
                                    <a href="producto.php?id=<?= $prod["id"] ?>"><img src="<?php if($prod["img_url"] != ""){ echo($prod["img_url"]); } else{ echo("./img/broken-image.png"); } ?>" class="mb-3"
                                    title="<?= $prod["nombre"] ?>" alt="<?= $prod["nombre"] ?>" height="250px" width="250px"></a>
                                    <p class="card-text"><?= $prod["nombre"] ?></p>
                                    <a class="btn btn-danger w-50" href="carrito.php?emp=<?= $prod["id"] ?>">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php if(count($_SESSION["carrito"]) == 0): ?>
            <div class="container text-center">
                <h1>No hay productos en el carrito...</h1>
            </div>
            <?php endif; ?>
            <?php if(count($_SESSION["carrito"]) > 0): ?>
            <div class="border border-1 p-2">
                <p>Precio total: <?= $precio_total; ?>€</p>
                <p>Cantidad de productos: <?= $contador; ?></p>
                <button class="btn btn-primary"><a href="./pedido.php">Realizar pedido</a></button>
                <a href="carrito.php?emp=*" class="btn btn-danger"><button class="btn btn-danger">Vaciar</button></a>
            </div>
            <?php endif; ?>
        </div>
    </main>
    <div id="footer"></div>
</body>
</html>