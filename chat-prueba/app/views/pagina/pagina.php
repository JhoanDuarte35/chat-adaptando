<?php
include_once(__dir__."/../../model/config.php");
if (!isset($_SESSION['unique_id'])) {
    header('Location: '.controlador::$rutaAPP.'index.php');
}
?>
<?php include_once(__dir__."/../header/header.php"); ?>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php
          $sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE cc_user = {$_SESSION['unique_id']}");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          }
          ?>
          <img src="<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['nombre'] . " " . $row['apellido'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <a href="<?php echo controlador::$rutaAPP?>index.php?action=cerrar" class="logout">Cerrar Sesión</a>
      </header>
      <div class="search">
        <span class="text">Selecciona un usuario para iniciar el chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">

      </div>
    </section>
  </div>

  <script src="<?php echo controlador::$rutaAPP?>app/views/javascript/users.js"></script>

</body>

</html>