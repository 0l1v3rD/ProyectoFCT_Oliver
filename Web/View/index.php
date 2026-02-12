<?php
    session_start();
    include("../Controller/db.inc");
    if(isset($_SESSION["nombre"]))
    {
        $nombre = $_SESSION["nombre"];
    }
    else
    {
        $nombre = "Anónimo";
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C-Weight</title>
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
    <!--Stack overflow (Header y Footer)-->
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
        <p class="ms-3 mt-2"><a title="Inicio" href="index.php">Inicio</a></p>
        <div class="container d-flex justify-content-around">
                <div id="camisetas" class="carousel carousel-custom w-100 carousel-dark slide">
                    <hr>
                    <?php
                        if(isset($_GET["error"]) && $_GET["error"] == 1):
                    ?>
                    <p>Error en el inicio de sesión.</p>
                    <?php
                        endif;
                    ?>
                    
                    <h1 style="margin-left:15px">Productos</h1>
                    <hr>
                    <div class="carousel-inner">
                        <!--Item por defecto-->
                        <div class="carousel-item active">
                            <div class="container">
                                <!-- Conjunto productos-->
                                <div class="row justify-content-center g-3">
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body d-flex flex-column text-center">
                                                <a href="camiseta.php"><img src="img/isolated_white_and_black_t_shirt_front_view-no-bg.png" class="img-fluid mb-3"
                                                title="Camiseta" alt="Camiseta"></a>
                                                <p class="card-text">Camiseta negra básica</p>
                                                <a href="desarrollo.php" class="btn btn-primary mt-auto">Añadir al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body d-flex flex-column text-center">
                                                <a href="camiseta.php"><img src="img/isolated_white_and_black_t_shirt_front_view-no-bg.png" class="img-fluid mb-3"
                                                title="Camiseta" alt="Camiseta"></a>
                                                <p class="card-text">Camiseta negra básica</p>
                                                <a href="desarrollo.php" class="btn btn-primary mt-auto">Añadir al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body d-flex flex-column text-center">
                                                <a href="camiseta.php"><img src="img/isolated_white_and_black_t_shirt_front_view-no-bg.png" class="img-fluid mb-3"
                                                title="Camiseta" alt="Camiseta"></a>
                                                <p class="card-text">Camiseta negra básica</p>
                                                <a href="desarrollo.php" class="btn btn-primary mt-auto">Añadir al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item carousel-->
                        <div class="carousel-item">
                            <div class="container">
                                <!-- Conjunto productos-->
                                <div class="row justify-content-center g-3">
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body d-flex flex-column text-center">
                                                <a href="camiseta.php"><img src="img/isolated_white_and_black_t_shirt_front_view-no-bg.png" class="img-fluid mb-3"
                                                title="Camiseta" alt="Camiseta"></a>
                                                <p class="card-text">Camiseta negra básica</p>
                                                <a href="desarrollo.php" class="btn btn-primary mt-auto">Añadir al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body d-flex flex-column text-center">
                                                <a href="camiseta.php"><img src="img/isolated_white_and_black_t_shirt_front_view-no-bg.png" class="img-fluid mb-3"
                                                title="Camiseta" alt="Camiseta"></a>
                                                <p class="card-text">Camiseta negra básica</p>
                                                <a href="desarrollo.php" class="btn btn-primary mt-auto">Añadir al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body d-flex flex-column text-center">
                                                <a href="camiseta.php"><img src="img/isolated_white_and_black_t_shirt_front_view-no-bg.png" class="img-fluid mb-3"
                                                title="Camiseta" alt="Camiseta"></a>
                                                <p class="card-text">Camiseta negra básica</p>
                                                <a href="desarrollo.php" class="btn btn-primary mt-auto">Añadir al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- Controles carousel -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#camisetas" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#camisetas" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>
            <div class="container d-flex justify-content-around">
                <div id="pantalones" class="carousel carousel-custom w-100 carousel-dark slide">
                    <h1 style="margin-left:15px">Pantalones</h1>
                    <hr>
                    <div class="carousel-inner">
                        <!--Item por defecto-->
                        <div class="carousel-item active">
                            
                            <div class="container">
                                <!-- Conjunto productos-->
                                <div class="row justify-content-center g-3">
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body d-flex flex-column text-center">
                                                <a href="pantalon.php"><img src="img/dsf.png" class="img-fluid mb-3"
                                                title="Pantalón" alt="Pantalón"></a>
                                                <p class="card-text">Pantalón negro básico</p>
                                                <a href="#" class="btn btn-primary mt-auto">Añadir al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body d-flex flex-column text-center">
                                                <a href="pantalon.php"><img src="img/dsf.png" class="img-fluid mb-3"
                                                title="Pantalón" alt="Pantalón"></a>
                                                <p class="card-text">Pantalón negro básico</p>
                                                <a href="#" class="btn btn-primary mt-auto">Añadir al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body d-flex flex-column text-center">
                                                <a href="pantalon.php"><img src="img/dsf.png" class="img-fluid mb-3"
                                                title="Pantalón" alt="Pantalón"></a>
                                                <p class="card-text">Pantalón negro básico</p>
                                                <a href="desarrollo.php" class="btn btn-primary mt-auto">Añadir al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item carousel-->
                        <div class="carousel-item">
                            <div class="container">
                                <!-- Conjunto productos-->
                                <div class="row justify-content-center g-3">
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body d-flex flex-column text-center">
                                                <a href="pantalon.php"><img src="img/dsf.png" class="img-fluid mb-3"
                                                title="Pantalón" alt="Pantalón"></a>
                                                <p class="card-text">Pantalón negro básico</p>
                                                <a href="desarrollo.php" class="btn btn-primary mt-auto">Añadir al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body d-flex flex-column text-center">
                                                <a href="pantalon.php"><img src="img/dsf.png" class="img-fluid mb-3"
                                                title="Pantalón" alt="Pantalón"></a>
                                                <p class="card-text">Pantalón negro básico</p>
                                                <a href="desarrollo.php" class="btn btn-primary mt-auto">Añadir al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <div class="card-body d-flex flex-column text-center">
                                                <a href="pantalon.php"><img src="img/dsf.png" class="img-fluid mb-3"
                                                title="Pantalón" alt="Pantalón"></a>
                                                <p class="card-text">Pantalón negro básico</p>
                                                <a href="desarrollo.php" class="btn btn-primary mt-auto">Añadir al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- Controles carousel -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#pantalones" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#pantalones" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>
    </main>
    <div id="footer"></div>
</body>
</html>