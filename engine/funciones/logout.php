<?php
include_once '../../engine/funciones.php';
    if($_SESSION['id_unico']){
        
        $id_logout = $_GET['id_logout'];
        if(isset($id_logout)){
            $estado_usuario = "Desconectado ahora";
            $sql = mysqli_query($db, "UPDATE usuario SET estado_usuario = '{$estado_usuario}' WHERE id_unico={$id_logout}");
            if($sql){
                session_unset();
                session_destroy();
                header("location: /");
            }
        }else{
            header("location: /usuario");
        }
    }else{  
        header("location: /");
    }
?>