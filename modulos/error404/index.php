<?php 

  require_once '../../engine/funciones.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="<?php echo www;?>/assets/images/favicon.ico">
    <link rel="stylesheet" href="<?php echo www;?>/assets/css/error.css">
    <title>Error 404</title>
</head>

<body class="permission_denied">
    <div id="tsparticles"></div>
    <div class="denied__wrapper">
        <h1>404</h1>
        <h3>PERDIDO EN EL <span>SPACIO</span> ? mmm, parece que esa pagina no existe.</h3>
        <a href="/" class="btn">Volver al inicio</a>
    </div>

    <?php include_once "../../include/footer.php"; ?>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tsparticles@2.3.4/tsparticles.bundle.min.js">
    </script>
    <script type="text/javascript" src="<?php echo www;?>/assets/js/404.js"></script>
</body>

</html>