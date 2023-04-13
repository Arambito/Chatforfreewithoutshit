<?php

    include_once '../../engine/funciones.php';

    $id_salida = $_SESSION['id_unico'];
    $terminoBusqueda = $_POST['terminoBusqueda'];

    $sql = "SELECT * FROM usuario WHERE NOT id_unico = {$id_salida} AND (nombre_usuario LIKE '%{$terminoBusqueda}%' OR apellido_usuario LIKE '%{$terminoBusqueda}%' OR CONCAT(nombre_usuario, ' ', apellido_usuario) LIKE '%{$terminoBusqueda}%')";
    $salida = "";
    $query = mysqli_query($db, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $salida .= 'No se encontró ningún usuario relacionado con su búsqueda';
    }
    echo $salida;
?>