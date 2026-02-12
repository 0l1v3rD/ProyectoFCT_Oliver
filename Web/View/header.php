<?php
    session_start();
    include("../Controller/db.inc");
    if(isset($_SESSION["nombre"]))
    {
        $nombre = $_SESSION["nombre"];
    }
    else
    {
        $nombre = "Usuario";
    }
    $sql = "SELECT imagen_url FROM usuarios WHERE nombre='$nombre'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $imagen_url = $row['imagen_url'] ?? './img/people.png';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C-Weight</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="index.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
    <!--Stack overflow-->
    <script src="https://code.jquery.com/jquery-3.3.1.js" 
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
    </script>
</head>
<header class="d-flex align-items-center justify-content-between p-3 w-100">
        <div id="right" class="d-flex flex-row align-items-center">
            <a id="aside_menu" title="Menu Aside" class="btn btn-warning bi bi-list" data-bs-toggle="offcanvas" href="#aside" role="button" aria-controls="aside"></a>
            <a href="index.php"><img width="100px" id="logo" src="img/logo.png" title="Logo"></a>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="aside" aria-labelledby="aside">
                    <div class="offcanvas-header">
                        <img id="logo" width="100px" src="img/logo.png" title="Logo">
                        <h5 class="offcanvas-title" id="titulo">C-Weight</h5>
                        <button type="button" class="btn-close bg-danger" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div>
                            <p><a href="index.php">Inicio</a></p>
                            <p><a href="index.php">Registro</a></p>
                        </div>
                        <div>Categorías</div>
                        <div class="dropdown mt-3">
                            <p class="categorias_ofc"><a href="./camiseta.php">Camisetas</a></p>
                            <p class="categorias_ofc"><a href="./pantalon.php">Pantalones</a></p>
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">Accesorios</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="desarrollo.php">Mochilas</a></li>
                                    <li><a class="dropdown-item" href="desarrollo.php">Pesas tobilleras</a></li>
                                    <li><a class="dropdown-item" href="desarrollo.php">Chalecos de peso</a></li>
                                </ul>
                        </div>
                    </div>
                </div>
        </div>
        <form class="d-flex mx-auto form-inline" action="busqueda.php?nombre=<?php if(isset($_POST["prod"])) {echo($_POST["prod"]);} ?>" style="max-width: 400px;">
            <input id="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="nombre">
            <button class="btn btn-outline-success my-2 my-sm-0 mx-2" type="submit">Search</button>
        </form>
        <div class="d-flex align-items-center flex-sm-row justify-content-center gap-2">
            <p id="nombre" class="float-end"><?= $nombre ?></p>
            <a href="./inicio_sesion.php"><img id="usr_img" alt="Inicio de sesión" width="50px" src="<?php if ($imagen_url != "") { echo($imagen_url); } else { echo("./img/people.png"); } ?>"></a>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </header>
