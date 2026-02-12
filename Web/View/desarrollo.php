<?php
    session_start();
    if(isset($_SESSION["usuario"])){
        $nombre = $_SESSION["usuario"];
    }
    else{
        $nombre = "Anónimo";
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Próximamente...</title>
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
    <!--Stack overflow-->
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
        <p class="ms-3 mt-2"><a title="Inicio" href="index.html">Inicio</a> > <a title="Inicio" href="index.html">Desarrollo</a></p>
        <div class="container d-flex flex-column text-center justify-content-around">
            <h1>En desarrollo...</h1>
            <h2>Ahora mismo no tenemos la infraestructura para el link al que has accedido.</h2>
            <img class="align-self-center m-4" src="img/chain.png" width="500px" alt="En proceso...">
            <p style="font-size: 20px;">Consejo: El botón amarillo de arriba a la izquierda abre un menú, si por el momento quiere buscar una categoría, sientase libre de entrar en el menú del botón amarillo.</p>
        </div>
    </main>
    <div id="footer"></div>
</body>
</html>