<?php

use LDAP\Result;

include('../Model/conexion.php');
include ('../Model/funciones.php');
include('../Model/config.php');

$query = $connection->prepare("SELECT id, concat(nombre, ' ', apellido) as nombre FROM alumnos; ");
$query ->execute();
$ikasleak = $query->fetchAll();
$error = '';

if (isset($_POST['submit'])) {
  $config = include '../Model/config.php';
  try {
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
    
    $adminvalue = 0;
    if (isset($_POST['admin'])) {
      $adminvalue = 1;
    }
    if(isset($_POST['admin']) && 
      $_POST['admin'] == '1') {
        $adminvalue = 1;
    }

    $alumno = array(
      "username"   => $_POST['username'],
      "mail" => $_POST['mail'],
      "password" =>  $hashed_password,
      "admin" => $adminvalue,
      "ikasleid" => $_POST['ikaslea'],
    );

    if(validar()){
      $consultaSQL = "INSERT INTO users (username, mail, password, admin,ikasleid) values (:" . implode(", :", array_keys($alumno)) . ")";

      $sentencia = $conexion->prepare($consultaSQL);
      $sentencia->execute($alumno);

      header("Location:index.php");
    }
  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}

function validar(){
  $validado = true;
  if (isset($_POST['password']) && isset($_POST['password2'])){
    if ($_POST['password'] != $_POST['password2']){ 
      $validado = false;
    }
  }
  return $validado;
}
?>
<html>
    <head>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
        <link rel="stylesheet" href="../Styles/login.css">      
      </head>
<!-- icons  -->
<body>
<?php 
  if($error != ''){
    $error = '';
?> 

<div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger" role="alert">
        <h4>El nombre de usuario, alumno, o email estan en uso</h4>
      </div>
    </div>
  </div>
<?php
  
  }
?>

  <div class=" flex-r container">
    <div class="flex-r login-wrapper">
      <div class="login-text">
        <div class="logo">
          <span><img src="../Images/logo.png" alt="" class="imgLogo"></span>
        </div>
        <h1>Registro</h1>
        <p>Crear un usuario para nuestra página</p>
        <form action="" method="post" name="login_form" class="flex-c">
            <div class="input-box">
                <span class="label">Usuario</span>
                <div class=" flex-r input">
                    <input name="username" type="text" placeholder="ElChetos" required>
                    <i class="fa fa-user-circle"></i>
                </div>
            </div> 

            <div class="input-box">
                <span class="label">E-mail</span>
                <div class=" flex-r input">
                    <input name="mail" type="email" placeholder="user@uni.eus" pattern=".+@uni\.eus" required>
                    <i class="fas fa-at"></i>
                </div>  
            </div>

            <div class="input-box">
            <span class="label">Contraseña</span>
                <div class="flex-r input" style="<?php if(!validar()){echo "border-color:red;";} ?>">
                    <input name="password" type="password" placeholder="<?php if(!validar()){echo "Las contraseñas no son iguales";} ?>" required>
                    <i class="fas fa-lock"></i>
                </div>
            </div>

            <div class="input-box">
            <span class="label">Repetir contraseña</span>
                <div class="flex-r input" style="<?php if(!validar()){echo "border-color:red;";} ?>">
                    <input name="password2" type="password" placeholder="<?php if(!validar()){echo "Las contraseñas no son iguales";} ?>" required>
                    <i class="fas fa-lock"></i>
                </div>
            </div>

            <div class="input-box">
            <span class="label">Alumno</span>
                <select name="ikaslea" id="ikaslea" class="ikaslea" required>
                <option value=""></option>
                    <?php
                    foreach ($ikasleak as $x){
                        echo "<option value= '$x[id]' >$x[nombre]</option>";
                    }
                    ?>
                    
                </select>
            </div>
          <span class="label">Admin</span>
          <div class="check">
            <input type="checkbox" name="admin" id="" value="1">
          </div>

          <input name="submit" type="submit" class="btn" value="Crear usuario">
          <span class="extra-line">
            <span></span>
            <a href="login.php">¿Ya tienes un usuario? Iniciar sesión</a>
          </span>
          <span class="extra-line">
            <a href="index.php">Pagina principal</a>
          </span>
        </form>
      </div>
    </div>
  </div>
</body>
</html>