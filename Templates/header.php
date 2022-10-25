<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Aplicación CRUD PHP</title>
    
    <link rel="stylesheet" href="../styles/styles.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../styles/navbar.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <?php
      if($_SESSION["user_id"]) {
    ?>
      <a class="navbar-brand fw-bold" href="#">Ongi etorri - <?php echo $_SESSION["username"]; ?></a>
    <?php
      }else {
    ?>
    <a class="navbar-brand fw-bold" href="#">Ikasleen web orria</a>
    <?php
      }
    ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="administrazioa.php">Administrazioa</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link">Link</a>
        </li>
      </ul>
      <?php
      if($_SESSION["user_id"]) {
      ?>
        <button class="btn btn-outline-dark fw-bold"><a href="../Model/logout.php">Logout</a></button>
      <?php
      }else {
      ?>
        <button class="btn btn-outline-dark fw-bold"><a href="login.php">Login</a></button>      <?php
      }
      ?>
     
    </div>
  </div>
</nav>
