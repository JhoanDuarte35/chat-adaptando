<?php
include_once(__dir__."/../../model/config.php");
if (!isset($_SESSION['unique_id'])) {
  //  header('Location: '.controlador::$rutaAPP.'index.php');
}
?>
<?php include_once(__dir__."/../header/header.php"); ?>

<body>
    HOLA
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
        $sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE cc_user = {$user_id}");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        } else {
        header('Location: '.controlador::$rutaAPP.'/views/pagina/pagina.php');
        }
        ?>
        <a href="app/views/pagina/chat.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="app/views/images/1676636707img2.jpeg<?php //echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['nombre'] . " " . $row['apellido'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Escribe tu mensaje aquí..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="<?php echo controlador::$rutaAPP?>app/views/javascript/chat.js"></script>


</body>

</html>