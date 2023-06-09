<?php 

  require_once '../../engine/funciones.php';
  if(isset($_SESSION['id_unico'])){
    header("location: /usuario");
  }
?>

<?php include_once "../../include/header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Chat en PHP</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>Nombre</label>
            <input type="text" name="nombre_usuario" placeholder="Nombre" required>
          </div>
          <div class="field input">
            <label>Apellido</label>
            <input type="text" name="apellido_usuario" placeholder="Apellido" required>
          </div>
        </div>
        <div class="field input">
          <label>Correo Electronico</label>
          <input type="text" name="email_usuario" placeholder="Ingresa tu correo electronico" required>
        </div>
        <div class="field input">
          <label>Contraseña</label>
          <input type="password" name="contrasena_usuario" placeholder="Ingresa tu contraseña" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="image-preview">
          <input type="file" class="select-image" id="imagen_usuario" name="imagen_usuario" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>          
          <label for="imagen_usuario">
            <span class="field image">Seleccionar imagen</span>
          </label>
          <img id="preview" src="#" alt="Vista previa de la imagen">
        </div>

        <div class="field button">
          <input type="submit" name="submit" value="Registrar">
        </div>
      </form>
      <div class="link">¿Ya estas registrado? <a href="<?php echo www;?>">Ingresa ahora</a></div>
    </section>
  </div>

  <?php include_once "../../include/footer.php"; ?>
  <script src="<?php echo www;?>/assets/js/pass-show-hide.js"></script>
  <script src="<?php echo www;?>/assets/js/registro.js"></script>

</body>
</html>
