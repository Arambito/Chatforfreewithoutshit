<?php
    session_start();

    // Si la sesión existe y el tiempo de inactividad ha superado el límite de tiempo, se cierra la sesión
    if (isset($_SESSION['id_unico']) && (time() - $_SESSION['ultimo_acceso']) > 1800) {
        $estado = "Desconectado ahora";
          $sql2 = mysqli_query($db, "UPDATE usuario SET estado_usuario = '{$estado}' WHERE id_unico = {$_SESSION['id_unico']}");
        session_unset();
        session_destroy();
        
        header("Location: /");
        exit;
    }

    // Actualizar el tiempo de último acceso a la página
    $_SESSION['ultimo_acceso'] = time();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Chat ~ PHP Version</title>
  <link rel="icon" type="image/x-icon" href="<?php echo www;?>/assets/images/favicon.ico">
  <link rel="stylesheet" href="<?php echo www;?>/assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>