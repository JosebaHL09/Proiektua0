<?php
include('../Model/conexion.php');
include ('../Model/funciones.php');
include('../Model/config.php');

$query = $connection->prepare("SELECT id, concat(nombre, ' ', apellido) as nombre FROM alumnos; ");
$query ->execute();
$ikasleak = $query->fetchAll();

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
  if ($_POST['password'] != $_POST['password2']){ 
    echo '<script>alert("Las contraseñas no son iguales")</script>';
    $validado = false;
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
  <div class=" flex-r container">
    <div class="flex-r login-wrapper">
      <div class="login-text">
        <div class="logo">
          <span><img src="../Images/logo.png" alt="" class="imgLogo"></span>
        </div>
        <h1>Erregistratu</h1>
        <p>Erregistratu gure web-orrian</p>
        <form action="" method="post" name="login_form" class="flex-c">
            <div class="input-box">
                <span class="label">Erabiltzaile izena</span>
                <div class=" flex-r input">
                    <input name="username" type="text" placeholder="XxByErabiltzailexX" required>
                    <i class="fa fa-user-circle"></i>
                </div>
            </div> 

            <div class="input-box">
                <span class="label">E-mail</span>
                <div class=" flex-r input">
                    <input name="mail" type="email" placeholder="erabiltzailea@uni.eus" pattern=".+@uni\.eus" required>
                    <i class="fas fa-at"></i>
                </div>  
            </div>

            <div class="input-box">
            <span class="label">Pasahitza</span>
                <div class="flex-r input">
                    <input name="password" type="password" placeholder="" required>
                    <i class="fas fa-lock"></i>
                </div>
            </div>

            <div class="input-box">
            <span class="label">Pasahitza errepikatu</span>
                <div class="flex-r input">
                    <input name="password2" type="password" placeholder="" required>
                    <i class="fas fa-lock"></i>
                </div>
            </div>

            <div class="input-box">
            <span class="label">Ikaslea</span>
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
            <input type="checkbox" name="admin" id="">
          </div>

          <input name="submit" type="submit" class="btn" value="Erabiltzailea sortu">
          <span class="extra-line">
            <span></span>
            <a href="login.php">Erabiltzaile bat duzu? Saioa hasi</a>
          </span>
          <span class="extra-line">
            <a href="index.php">Hasierako orrira bueltatu</a>
          </span>
        </form>
      </div>
    </div>
  </div>
</body>
</html>