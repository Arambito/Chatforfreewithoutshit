<?php 

    include_once '../../engine/funciones.php';
    $email = $_POST['email_usuario'];
    $contrasena = $_POST['contrasena_usuario'];
    if(!empty($email) && !empty($contrasena)){
        $sql = mysqli_query($db, "SELECT * FROM usuario WHERE email_usuario = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $user_pass = md5($contrasena);
            $enc_pass = $row['contrasena_usuario'];
            if($user_pass === $enc_pass){
                $estado = "Activo ahora";
                $sql2 = mysqli_query($db, "UPDATE usuario SET estado_usuario = '{$estado}' WHERE id_unico = {$row['id_unico']}");
                if($sql2){
                    $_SESSION['id_unico'] = $row['id_unico'];
                    $_SESSION['start_time'] = time(); // Se establece el tiempo de inicio de la sesión
                    $_SESSION['expire_time'] = $_SESSION['start_time'] + (60 * 30); // Se establece el tiempo de expiración de la sesión (30 minutos)
                    echo "success";
                }else{
                    echo "Algo salio mal. ¡Porfavor intenta nuevamente!";
                }
            }else{
                echo "¡El email o contraseña es incorrecta!";
            }
        }else{
            echo "¡$email - Este correo no existe!";
        }
    }else{
        echo "¡Todos los campos son obligatorios!";
    }
?>
