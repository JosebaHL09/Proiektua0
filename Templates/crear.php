<?php

if (isset($_POST['submit'])) {
 
  $resultado = [
    'error' => false,
    'mensaje' => 'Usuario agregado con éxito'
  ];
  
  $config = include '../Model/config.php';

  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    // Código que insertará un alumno
    $alumno = [
        "nombre"   => $_POST['nombre'],
        "apellido" => $_POST['apellido'],
        "email"    => $_POST['email'],
        "edad"     => $_POST['edad'],
      ];

        $consultaSQL = "INSERT INTO alumnos (nombre, apellido, email, edad)";
        $consultaSQL .= "values (:" . implode(", :", array_keys($alumno)) . ")";
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute($alumno);

        header('Location:crear.php');
  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}
?>
<?php include "../templates/header.php"; ?>
<?php
if (isset($resultado)) {
  ?>
  <div class="container mt-5 alerta">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-<?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
          <?= $resultado['mensaje'] ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>
<div class="flex-r">
    <div class="flex-r login-wrapper">
      <div class="login-text">
        <div class="logo">
          <span><img src="../Images/logo.png" alt="" class="imgLogo"></span>
        </div>
        <h1>Crea un alumno</h1>
        <form action="" method="POST" name="login_form" class="flex-c form">
          <div class="input-box">
            <span class="label">Nombre</span>
            <div class=" flex-r input">
              <input name="nombre" type="text" placeholder="">
              <i class="fa fa-user-circle"></i>
            </div>
          </div>
          <div class="input-box">
            <span class="label">Apellido</span>
            <div class=" flex-r input">
              <input name="apellido" type="text" placeholder="">
              <i class="fa fa-user-circle"></i>
            </div>
          </div>
          <div class="input-box">
              <span class="label">E-mail</span>
              <div class=" flex-r input">
                <input name="email" type="email" placeholder="user@uni.eus" pattern=".+@uni\.eus" required>
                <i class="fas fa-at"></i>
              </div>  
          </div>
          <div class="input-box">
            <span class="label">Edad</span>
            <div class=" flex-r input">
              <input name="edad" type="number" placeholder="" min=0 max=100>
              <i class="fa-solid fa-cake-candles"></i>
            </div>
          </div>

          <input name="submit" type="submit" class="btn_input" value="Crear">
          <span class="extra-line">
            <a href="administrazioa.php">Regresar la pagina de administracion</a>
          </span>
        </form>
      </div>
    </div>
  </div>

<?php include "../templates/footer.php"; ?>