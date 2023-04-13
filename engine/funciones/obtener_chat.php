<?php 
    include_once '../../engine/funciones.php';
    if(isset($_SESSION['id_unico'])){
        
        $id_salida = $_SESSION['id_unico'];
        $id_entrada = $_POST['id_entrada'];
        $salida = "";
        $sql = mysqli_query($db, "SELECT * FROM mensaje LEFT JOIN usuario ON usuario.id_unico = mensaje.id_mensaje_salida
        WHERE (id_mensaje_salida = $id_salida AND id_mensaje_entrada = $id_entrada)
        OR (id_mensaje_salida = $id_entrada AND id_mensaje_entrada = $id_salida) ORDER BY id_mensaje");
        

        if(mysqli_num_rows($sql) > 0){
            $id_usuario_destino = "(SELECT id_usuario FROM usuario WHERE id_unico = $id_salida)";
            $id_mensajes = [];
            while($row = mysqli_fetch_assoc($sql)){
                $id_mensaje = $row['id_mensaje'];
                $id_mensajes[] = $id_mensaje;
                if($row['id_mensaje_salida'] === $id_salida){
                    $salida .= '<div class="chat outgoing">
                                
                                <div class="details">
                                <div class="derecha"><i>Tú</i></div>
                                    <p>'. $row['contenido'] .'</p>
                                </div>
                                </div>';
                }else{
                    $salida .= '<div class="chat incoming">
                                <img src="../../assets/images/'.$row['imagen_usuario'].'" alt="">
                                <div class="details">
                                    <p>'. $row['contenido'] .'</p>
                                </div>
                                </div>';
                }
            }
            $id_mensajes_str = implode(",", $id_mensajes);
            $update_sql = mysqli_query($db, "UPDATE estados_de_lectura SET leido = 1 WHERE id_usuario_destino = $id_usuario_destino AND id_mensaje IN ($id_mensajes_str)");
        }else{
            $salida .= '<div class="text">No hay mensajes disponibles. Una vez envies un mensaje, aparecerá aquí.</div>';
        }
        echo $salida;
    }else{
        header("location: ../../modulos/login/index.php");
    }
    
?>