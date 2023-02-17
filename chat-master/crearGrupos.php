<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
  header("location: login.php");
}
?>
<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          }
          ?>
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
          <a href="users.php" class="logout">Volver</a>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Cerrar Sesión</a>
      </header>
        <div>Miembros del Grupo</div>
      <div class="users-list-group">
        

      </div>
  
      <div class="search">
        <span class="text">Agrega Usuarios a tu grupo</span>
        <input type="text" placeholder="Busca usuarios">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">

      </div>
      <form action="" type="POST">
      <input type="text" placeholder="Nombre del grupo">
      <input type="submit" value="Crear Grupo">
      </form>
    </section>
  </div>

  <script src="javascript/crearGrupos.js"></script>

</body>

</html>