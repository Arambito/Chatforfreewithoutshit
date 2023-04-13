<?php 

  require_once '../../engine/funciones.php';
  if(!isset($_SESSION['id_unico'])){
    header("location: /");
  }

?>
<?php include_once "../../include/header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($db, "SELECT * FROM usuario WHERE id_unico = {$_SESSION['id_unico']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <img src="<?php echo www;?>/assets/images/<?php echo $row['imagen_usuario']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['nombre_usuario']. " " . $row['apellido_usuario'] ?></span>
            <p><?php echo $row['estado_usuario']; ?></p>
          </div>
        </div>
        <a href="<?php echo www;?>/engine/funciones/logout.php?id_logout=<?php echo $row['id_unico']; ?>" class="logout">Cerrar Sesión</a>
      </header>
      <div class="search">
        <span class="text">¡Escribele a alguien!</span>
        <input type="text" placeholder="Ingresa el nombre para buscar...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="contenedor-loader"><div class="loader"><div></div><div></div><div></div></div></div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <?php include_once "../../include/footer.php"; ?>
  <script src="<?php echo www;?>/assets/js/usuario.js"></script>
  <audio id="notification-sound" src="<?php echo www;?>/assets/sounds/notification.wav"></audio>
</body>
</html>
