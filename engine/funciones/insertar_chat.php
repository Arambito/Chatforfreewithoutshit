<?php 
    include_once '../../engine/funciones.php';
    if(isset($_SESSION['id_unico'])){
        
        $id_salida = $_SESSION['id_unico'];
        $id_entrada = $_POST['id_entrada'];
        $contenido = $_POST['contenido'];
        $fecha_actual = date('Y-m-d H:i:s');
        if(!empty($contenido)){
            $id_usuario_destino = "(SELECT id_usuario FROM usuario WHERE id_unico = $id_entrada)";
            $id_usuario_remitente = "(SELECT id_usuario FROM usuario WHERE id_unico = $id_salida)";
            $sql = mysqli_query($db, "INSERT INTO mensaje (id_mensaje_entrada, id_mensaje_salida, contenido, fecha_mensaje)
                          VALUES ({$id_entrada}, {$id_salida}, '{$contenido}', '$fecha_actual')") or die();

            // Obtener el id del mensaje insertado
            $id_mensaje = mysqli_insert_id($db);

            // Insertar el estado de lectura para el destinatario del mensaje
            $sql2 = mysqli_query($db, "INSERT INTO estados_de_lectura (id_mensaje, id_usuario_destino, id_usuario_remitente, leido, fecha_lectura)
                                    VALUES ({$id_mensaje}, {$id_usuario_destino}, {$id_usuario_remitente}, 0, NULL)") or die();
        }
    }else{
        header("location: ../login.php");
    }


    
?>