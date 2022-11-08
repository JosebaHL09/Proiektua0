<?php
//include 'funciones.php';

$config = include '../Model/config.php';

$resultado = [
  'error' => false,
  'mensaje' => ''
];

if (!isset($_GET['id'])) {
  $resultado['error'] = true;
  $resultado['mensaje'] = 'El alumno no existe';
}

if (isset($_POST['submit'])) {
  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $alumno = [
      "id"        => $_GET['id'],
      "nombre"    => $_POST['nombre'],
      "apellido"  => $_POST['apellido'],
      "email"     => $_POST['email'],
      "edad"      => $_POST['edad'],
    ];
    
    $consultaSQL = "UPDATE alumnos SET
        nombre = :nombre,
        apellido = :apellido,
        email = :email,
        edad = :edad,
        updated_at = NOW()
        WHERE id = :id";
    
    $consulta = $conexion->prepare($consultaSQL);
    $consulta->execute($alumno);

  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
    
  $id = $_GET['id'];
  $consultaSQL = "SELECT * FROM alumnos WHERE id =" . $id;

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $alumno = $sentencia->fetch(PDO::FETCH_ASSOC);

  if (!$alumno) {
    $resultado['error'] = true;
    $resultado['mensaje'] = 'No se ha encontrado el alumno';
  }

} catch(PDOException $error) {
  $resultado['error'] = true;
  $resultado['mensaje'] = $error->getMessage();
}
?>

<?php require "../templates/header.php"; ?>

<?php
if ($resultado['error']) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $resultado['mensaje'] ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>



<?php
if (isset($alumno) && $alumno) {
  ?>
  <?php
    if (isset($_POST['submit']) && !$resultado['error']) {
      ?>
      <div class="containermsg">
      <div class="row">
          <div class="col-md-12">
            <div class="alert alert-success" role="alert">
              El alumno ha sido actualizado correctamente
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
        <h2 class="mt-4">Editando el alumno <?= ($alumno['nombre']) . ' ' . ($alumno['apellido'])  ?></h2>
        <form action="" method="POST" name="login_form" class="flex-c form">
          <div class="input-box">
            <span class="label">Nombre</span>
            <div class=" flex-r input">
              <input name="nombre" id="nombre" value="<?= ($alumno['nombre']) ?>" type="text" placeholder="">
              <i class="fa fa-user-circle"></i>
            </div>
          </div>
          <div class="input-box">
            <span class="label">Apellido</span>
            <div class=" flex-r input">
              <input name="apellido" id="apellido" value="<?= ($alumno['apellido']) ?>" type="text" placeholder="">
              <i class="fa fa-user-circle"></i>
            </div>
          </div>
          <div class="input-box">
              <span class="label">E-mail</span>
              <div class=" flex-r input">
                <input name="email" id="email" value="<?= ($alumno['email']) ?>" type="email" placeholder="user@uni.eus" pattern=".+@uni\.eus" required>
                <i class="fas fa-at"></i>
              </div>  
          </div>
          <div class="input-box">
            <span class="label">Edad</span>
            <div class=" flex-r input">
              <input type="text" name="edad" id="edad" value="<?= ($alumno['edad']) ?>" type="number" placeholder="" min=0 max=100>
              <i class="fa-solid fa-cake-candles"></i>
            </div>
          </div>

          <input name="submit" type="submit" class="btn_input" value="Cambiar">
          <span class="extra-line">
            <a href="administrazioa.php">Regresar atras</a>
          </span>
        </form>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php require "../templates/footer.php"; ?>