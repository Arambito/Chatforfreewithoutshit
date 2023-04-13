<?php

    while($row = mysqli_fetch_assoc($query)){

        $id_usuario_remitente = $db->query("SELECT id_usuario FROM usuario WHERE id_unico = {$row['id_unico']}")->fetch_assoc()['id_usuario'];
        $id_usuario_destino = $db->query("SELECT id_usuario FROM usuario WHERE id_unico = {$id_salida}")->fetch_assoc()['id_usuario'];
        
        $sql_id_mensaje = "(SELECT id_mensaje FROM mensaje WHERE (id_mensaje_entrada = {$row['id_unico']}
        OR id_mensaje_salida = {$row['id_unico']}) AND (id_mensaje_salida = {$id_salida} 
        OR id_mensaje_entrada = {$id_salida}) ORDER BY id_mensaje DESC LIMIT 1)";
        
        // Obtener el estado de lectura del mensaje
        $sql3 = $db->query("SELECT leido FROM estados_de_lectura WHERE id_mensaje = $sql_id_mensaje AND id_usuario_remitente = {$id_usuario_destino} AND id_usuario_destino = {$id_usuario_remitente}");
        
        // Verificar si el mensaje fue leído o no
        if($sql3->num_rows > 0){
            $row3 = $sql3->fetch_assoc();
            if($row3['leido'] == 1){
                $read_status = '<i class="fa fa-check" aria-hidden="true"></i><i class="fa fa-check" aria-hidden="true"></i>';
                $read = "read";
            }else{
                $read_status = '<i class="fa fa-check" aria-hidden="true"></i>';
                $read = "";
            }
        }else{
            $read_status = '';
            $read = "";
        }
        


        // Consulta para obtener el número de mensajes no leídos
        $sql4 = "SELECT COUNT(*) AS total_mensajes_no_leidos 
                FROM estados_de_lectura 
                WHERE leido = 0 
                AND id_usuario_destino = {$id_usuario_destino} 
                AND id_usuario_remitente = {$id_usuario_remitente}";
        $query4 = mysqli_query($db, $sql4) or die(mysqli_error($db));

        if (mysqli_num_rows($query4) > 0) {
            $row4 = mysqli_fetch_assoc($query4);
            $msg_count = $row4['total_mensajes_no_leidos'];
            $msg_count_html = $msg_count > 0 ? "<span>{$msg_count}</span>" : "";
        }

        // Consulta para obtener el último mensaje enviado o recibido
        $sql2 = "SELECT * 
                FROM mensaje 
                WHERE (id_mensaje_entrada = {$row['id_unico']} OR id_mensaje_salida = {$row['id_unico']}) 
                AND (id_mensaje_salida = {$id_salida} OR id_mensaje_entrada = {$id_salida}) 
                ORDER BY id_mensaje DESC LIMIT 1";
        $query2 = mysqli_query($db, $sql2) or die(mysqli_error($db));

        if (mysqli_num_rows($query2) > 0) {
            $row2 = mysqli_fetch_assoc($query2);
            $result = $row2['contenido'];
            $msg = strlen($result) > 28 ? substr($result, 0, 28) . '...' : $result;
            $you = isset($row2['id_mensaje_salida']) && $id_salida == $row2['id_mensaje_salida'] ? "Tú: " : "";
        } else {
            $result = "No hay mensajes";
            $msg = $result;
            $you = "";
        }

        // Actualiza el HTML del contador de mensajes no leídos en función del resultado de la consulta anterior

        
        
        if (isset($row2['id_mensaje_entrada'])) {
            $msg_count_html = $msg_count > 0 ? "<span>{$msg_count}</span>" : "";
        } else {
            $msg_count_html = "";
        }
        
        

        
          
          
        
        
        $offline = "";
        if ($row['estado_usuario'] == "Desconectado ahora") {
            $offline = "offline";
        }
        
        $hid_me = "";
        if ($id_salida == $row['id_unico']) {
            $hid_me = "Ocultar";
        }


          
        
        $salida .= '<a href="/chat/' . $row['id_unico'] . '/">
            <div class="content">
                <img src="../../assets/images/' . $row['imagen_usuario'] . '" alt="">
                <div class="details">
                    <span>' . $row['nombre_usuario'] . " " . $row['apellido_usuario'] . '</span>
                    <p>' . $you . $msg . '</p>
                </div>
            </div>
            <div class="message-info">' . $msg_count_html . '</div>   
            <div class="message-status ' . $read . '">
                ' . $read_status . '
            </div> 
            <div class="status-dot ' . $offline . '"><i class="fa fa-circle" aria-hidden="true"></i></div>
        </a> ';
        
    }
?>