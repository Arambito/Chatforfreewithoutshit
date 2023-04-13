<?php

    include_once '../../engine/funciones.php';
    $id_salida = $_SESSION['id_unico'];
    $sql = "SELECT usuario.*, COALESCE(fecha_ult_mensaje, '1900-01-01') AS ultima_fecha_mensaje
    FROM usuario
    LEFT JOIN (
      SELECT 
        CASE 
          WHEN id_mensaje_salida = {$id_salida} THEN id_mensaje_entrada
          ELSE id_mensaje_salida
        END AS id_unico_mensaje,
        MAX(fecha_mensaje) AS fecha_ult_mensaje
      FROM mensaje
      WHERE {$id_salida} IN (id_mensaje_salida, id_mensaje_entrada)
      GROUP BY id_unico_mensaje
    ) AS ult_mensaje ON usuario.id_unico = ult_mensaje.id_unico_mensaje
    WHERE NOT usuario.id_unico = {$id_salida}
    ORDER BY ultima_fecha_mensaje DESC
    ";
    $query = mysqli_query($db, $sql);
    $salida = "";
    if(mysqli_num_rows($query) == 0){
        $salida .= "No hay usuarios disponibles para chatear";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "../../engine/funciones/data.php";
    }
    echo $salida;
?>