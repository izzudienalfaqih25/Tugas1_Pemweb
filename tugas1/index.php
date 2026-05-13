<?php
  session_start();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Personal Home Page</title>
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
  <?php
        include_once 'koneksi.php';
        include_once 'models/Level.php';
        include_once 'models/Studies.php';
        include_once 'models/Member.php';
  ?>
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">
        <?php include_once 'header.php'; ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <?php include_once 'menu.php'; ?>
      </div>
    </div>

    <br />

    <div class="row">
      <!-- Sidebar KIRI (3 grid) -->
      <div class="col-md-3">
        <?php include_once 'sidebar.php'; ?>
      </div>

      <!-- Main KANAN (9 grid) -->
      <div class="col-md-9">
        <?php
        if (isset($_GET['hal'])) {
          $req = $_GET['hal'];
          include_once $req . '.php';
        } else {
          include_once 'home.php';
        }
        ?>
      </div>
    </div>

    <br />

    <div class="row">
      <div class="col-md-12">
        <?php include_once 'footer.php'; ?>
      </div>
    </div>

  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
