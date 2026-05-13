<?php
$hal = $_GET['hal'] ?? 'home';

function isActive($page, $hal) {
    return $hal === $page ? 'active' : '';
}
function isActiveStudies($hal) {
    return in_array($hal, ['level_list','level_form','level_detail','studies_list','studies_form','studies_detail']) ? 'active' : '';
}
?>

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="img/sttnf.png" alt="Logo" width="40">
      My Personal Page
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link <?= isActive('home', $hal) ?>" href="index.php?hal=home">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= isActive('about', $hal) ?>" href="index.php?hal=about">About Me</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= isActive('contact', $hal) ?>" href="index.php?hal=contact">Contact Me</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= isActiveStudies($hal) ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            My Studies
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item <?= isActive('level_list', $hal) ?>" href="index.php?hal=level_list">Level</a></li>
            <li><a class="dropdown-item <?= isActive('studies_list', $hal) ?>" href="index.php?hal=studies_list">Studies</a></li>
          </ul>
        </li>

        <?php if (!isset($_SESSION['MEMBER'])) { ?>
          <li class="nav-item">
            <a class="nav-link <?= isActive('login', $hal) ?>" href="index.php?hal=login">Login</a>
          </li>
        <?php } else { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= $_SESSION['MEMBER']['username'] . ' - ' . $_SESSION['MEMBER']['role'] ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="index.php?hal=home">Home</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
        <?php } ?>

      </ul>
    </div>
  </div>
</nav>