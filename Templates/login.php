<?php

use LDAP\Result;

include('../Model/conexion.php');
session_start();

if($_SESSION['user_id'] != 0){
  header("Location:index.php");
}
 
if (isset($_POST['Submit'])) {
 
    $username = $_POST['Username'];
    $password = $_POST['Password'];
     
  
    $query = $connection->prepare("SELECT * FROM users WHERE USERNAME=:username");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if(!empty($result)){
      if(password_verify($password, $result['password'])) {
        if($result){
          $_SESSION['user_id'] = $result['id'];
          $_SESSION['username'] = $result['username'];
          $_SESSION['mail'] = $result['mail'];
          $_SESSION['admin'] = $result['Admin'];
          $_SESSION['id_curso'] = null;
          $_SESSION['ikasleid'] = null;
          if ($result['IkasleID'] != null){
            $_SESSION['ikasleid'] = $result['IkasleID'];
            
            $query1 = $connection->prepare("SELECT id_curso FROM alumnos WHERE id=:ikasleid");
            $query1->bindParam("ikasleid", $result['IkasleID'], PDO::PARAM_STR);
            $query1->execute();
            $result1 = $query->fetch(PDO::FETCH_ASSOC);
            if($result1){
              $_SESSION['id_curso'] = $result1['id_curso'];
            }
          }
          if ($result['Admin'] == 0){
            header("Location:index.php");
          }else if($result['Admin'] == 1){
            header("Location:administrazioa.php");
          }
          
        }
      }
  }
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
        <h1>Inicio de sesión</h1>
        <p>Inicia sesión en nuestra página</p>

        <form action="" method="POST" name="login_form" class="flex-c">
          <div class="input-box">
            <span class="label">Usuario</span>
            <div class=" flex-r input">
              <input name="Username" type="text" placeholder="Petxa011">
              <i class="fa fa-user-circle"></i>
            </div>
          </div>

          <div class="input-box">
            <span class="label">Contraseña</span>
            <div class="flex-r input">
              <input name="Password" type="password" placeholder="">
              <i class="fas fa-lock"></i>
            </div>
          </div>

          <input name="Submit" type="submit" class="btn" value="Iniciar sesión">
          <span class="extra-line">
            <span>¿Nuevo usuario?</span>
            <a href="registro.php">Crear usuario</a>
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