<?php
    include("../Controller/db.inc");
    session_start();
    if(isset($_GET["id"])){
            $id_producto = $_GET["id"];
            $sql = "SELECT * FROM productos WHERE id='$id_producto'";
            $res = mysqli_query($conn, $sql);
            if(mysqli_num_rows($res) > 0){
                $producto = mysqli_fetch_assoc($res);
                $precio = $producto["precio_unidad"];
            }
            else{
                header("Location: index.php");
            }
            if(isset($_SESSION["id"])){
                $id_cliente = $_SESSION["id"];
            }
            $fecha_hoy = date_create();
            $fecha_esp = date_add($fecha_hoy, date_interval_create_from_date_string("40 days"));
            if(isset($_GET["ins"]) && isset($_GET["id"]) && isset($_GET["cantidad"])){
                $_SESSION["carrito"][] = [
                    "id"=> $_GET["id"],
                    "cantidad"=> $_GET["cantidad"]
                ];
                header("Location: pedido.php");
            }
            if(!isset($_SESSION["carrito"])){
                $_SESSION["carrito"] = array();
            }
        }
    else{
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $producto['nombre'] ?? 'Producto' ?></title>
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
        <form id="producto" action="pedido.php?ins=1" class="d-flex justify-content-around">
            <div>
                <img title="<?= $producto['nombre'] ?? 'Producto' ?>" src="<?= !empty($producto['img_url']) ? $producto['img_url'] : './img/chain.png' ?>" alt="<?= $producto['nombre'] ?? 'Producto' ?>" height="500">
            </div>
            <div class="border border-1 ">
                <div class="align-content-center p-5">
                    <h2><?= $producto['nombre'] ?></h2>
                    <p><?= $producto['descripcion'] ?></p>
                    <p><b class="text-success"><?= $producto['precio_unidad'] ?>€</b></p>
                    <p>Almacén más cercano: <b class="text-success">Torrevieja</b></p>
                    <p>Envio: <b class="text-success">Gratis</b></p>
                    <p>Stock: <b class="text-success">5</b></p>
                    <a href="carrito.php?id=<?= $producto['id'] ?>&cantidad=1"><button class="btn btn-primary" type="button">Añadir al carrito.</button></a>
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