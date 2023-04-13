<?php

include_once '../../engine/funciones.php';

$nombre = $_POST['nombre_usuario'];
$apellido = $_POST['apellido_usuario'];
$email = $_POST['email_usuario'];
$contrasena = $_POST['contrasena_usuario'];

if (!empty($nombre) && !empty($apellido) && !empty($email) && !empty($contrasena)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($db, "SELECT * FROM usuario WHERE email_usuario = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "$email - ¡Este correo ya existe!";
        } else {
            if (isset($_FILES['imagen_usuario'])) {
                $img_name = $_FILES['imagen_usuario']['name'];
                $img_type = $_FILES['imagen_usuario']['type'];
                $tmp_name = $_FILES['imagen_usuario']['tmp_name'];
                $img_size = $_FILES['imagen_usuario']['size'];

                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);

                $extensions = ["jpeg", "png", "jpg"];
                if (in_array($img_ext, $extensions) === true) {
                    $types = ["image/jpeg", "image/jpg", "image/png"];
                    if (in_array($img_type, $types) === true) {
                        if ($img_size <= 3145728) { // Tamaño máximo de 3MB
                            $time = time();
                            $new_img_name = $time . $img_name;
                            if (move_uploaded_file($tmp_name, "../../assets/images/" . $new_img_name)) {
                                $ran_id = rand(time(), 100000000);
                                $status = "Activo ahora";
                                $encrypt_pass = md5($contrasena);
                                $insert_query = mysqli_query($db, "INSERT INTO usuario (id_unico, nombre_usuario, apellido_usuario, email_usuario, contrasena_usuario, imagen_usuario, estado_usuario)
                                VALUES ({$ran_id}, '{$nombre}','{$apellido}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");
                                if ($insert_query) {
                                    $select_sql2 = mysqli_query($db, "SELECT * FROM usuario WHERE email_usuario = '{$email}'");
                                    if (mysqli_num_rows($select_sql2) > 0) {
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        $_SESSION['id_unico'] = $result['id_unico'];
                                        echo "success";
                                    } else {
                                        echo "¡Este correo no existe!";
                                    }
                                } else {
                                    echo "Algo salio mal. ¡Porfavor, intenta nuevamente!";
                                }
                            }
                        } else {
                            echo "La imagen es demasiado grande. ¡El tamaño máximo es de 5MB!";
                        }
                    } else {
                        echo "Porfavor sube una imagen - jpeg, png, jpg";
                    }
                } else {
                    echo "Porfavor sube una imagen - jpeg, png, jpg";
                }
            }
        }
    } else {
        echo "¡$email no es un correo válido!";
    }
} else {
    echo "¡Todos los campos son obligatorios!";
}
