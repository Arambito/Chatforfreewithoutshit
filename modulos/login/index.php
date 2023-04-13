<?php 

  require_once '../../engine/funciones.php';

  if(isset($_SESSION['id_unico'])){
      header("location: /usuario");
  }
?>

<?php include_once "../../include/header.php"; ?>

<body>
  <div class="wrapper">
    <section class="form login">
      <header>Chat en PHP</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Correo Electronico</label>
          <input type="text" name="email_usuario" placeholder="Ingresa tu correo" required>
        </div>
        <div class="field input">
          <label>Contraseña</label>
          <input type="password" name="contrasena_usuario" placeholder="Ingresa tu contraseña" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Ingresar">
        </div>
      </form>
      <div class="link">¿Aún no te registras? <a href="<?php echo www;?>/registro">Registrate ahora</a></div>
    </section>
  </div>
  <?php include_once "../../include/footer.php"; ?>
  <script src="<?php echo www;?>/assets/js/pass-show-hide.js"></script>
  <script src="<?php echo www;?>/assets/js/login.js"></script>

</body>
</html>
