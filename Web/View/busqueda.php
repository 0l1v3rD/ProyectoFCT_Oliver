<?php
    session_start();
    include("../Controller/db.inc");
    $error = "";
    if(isset($_GET["nombre"]) && $_GET["nombre"] != ""){
        $nombre_busq = $_GET["nombre"];
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%$nombre_busq%'";
        $res = mysqli_query($conn, $sql);
        $productos = mysqli_fetch_all($res, MYSQLI_ASSOC);
        $contador = 0;
    }
    else{
        $nombre_busq = "";
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Buscar</title>
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
        <!--Stack overflow (Ignorar)-->
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
            <p class="ms-3 mt-2"><a href="./index.php">Inicio</a> > <a href="./busqueda.php?nombre='<?php echo $nombre_busq ?>'">Búsqueda</a></p>
            <main>
                <?php  ?>
                <div class="m-5">
                    <h1>Resultados de <?php if($nombre_busq == ""){ echo "\"\""; } else{ echo("\"$nombre_busq\""); } ?></h1>
                    <div class="container d-flex flex-column gap-3 w-100">
                    <hr>
                        <div class="row justify-content-around w-100 g-3">
                                <?php if(isset($_GET["nombre"]) && $nombre_busq != ""):
                                        foreach ($productos as $prod):
                                            $contador++; ?>
                                            <!-- Carta para todos los productos de la fila en la que esta el bucle -->
                                            <div class="col-md-4">
                                                <div class="card h-100">
                                                    <div class="card-body d-flex flex-column text-center">
                                                        <a href="producto.php?id=<?= $prod["id"] ?>"><img src="<?= $prod["img_url"] ?>" class="img-fluid mb-3"
                                                        title="<?= $prod["nombre"] ?>" alt="<?= $prod["nombre"] ?>" height="250px"></a>
                                                        <p class="card-text"><?= $prod["nombre"] ?></p>
                                                        <a href="carrito.php?id=<?= $prod["id"] ?>" class="btn btn-primary mt-auto">Añadir al carrito</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- Cada 3 productos: -->
                                        <?php if($contador == 3): ?>
                                        <!-- Cierro el row actual -->
                                        </div>
                                        <hr>
                                        <div class="row justify-content-around w-100 g-3">
                                        <?php $contador=0; endif; endforeach; 
                                        else:?>
                                        <h2 class="text-center">No hay nada en la barra de búsqueda...</h2>
                                        <?php endif; ?>
                        </div>
                </div>
            </main>
        <div id="footer"></div>
    </body>
</html>