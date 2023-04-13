<?php 

  include_once '../../engine/funciones.php';
  if(!isset($_SESSION['id_unico'])){
    header("location: /");
  }
?>
<?php include_once "../../include/header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          $id_usuario = $_GET['id_usuario'];
          $sql = mysqli_query($db, "SELECT * FROM usuario WHERE id_unico = '{$id_usuario}'");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: /usuario");
          }
        ?>
        <a href="/usuario" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="../../assets/images/<?php echo $row['imagen_usuario']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['nombre_usuario']. " " . $row['apellido_usuario'] ?></span>
          <p><?php echo $row['estado_usuario']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="id_entrada" name="id_entrada" value="<?php echo $id_usuario; ?>" hidden>
        <input type="text" class="contenido" name="contenido"  placeholder="Escribe un mensaje aquí..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>
  <footer style="top: 95%;">
        <div class="footer-text">
            Hecho con PHP & <span class="heart">&hearts;</span> by <span>BITO</span>
        </div>
    </footer>
  <script src="<?php echo www;?>/assets/js/chat.js"></script>

</body>
</html>
