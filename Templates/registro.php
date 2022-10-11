<?php
include('../Model/conexion.php');
include '../Model/funciones.php';

$query = $connection->prepare("SELECT id, concat(nombre, ' ', apellido) as nombre FROM alumnos; ");
$query ->execute();
$ikasleak = $query->fetchAll();

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

        <form action="" method="POST" name="login_form" class="flex-c">
            <div class="input-box">
                <span class="label">Erabiltzaile izena</span>
                <div class=" flex-r input">
                    <input name="Username" type="text" placeholder="XxByErabiltzailexX">
                    <i class="fa fa-user-circle"></i>
                </div>
            </div> 

            <div class="input-box">
                <span class="label">E-mail</span>
                <div class=" flex-r input">
                    <input name="Mail" type="text" placeholder="erabiltzailea@uni.eus">
                    <i class="fas fa-at"></i>
                </div>  
            </div>

            <div class="input-box">
            <span class="label">Pasahitza</span>
                <div class="flex-r input">
                    <input name="Password" type="password" placeholder="">
                    <i class="fas fa-lock"></i>
                </div>
            </div>

            <div class="input-box">
            <span class="label">Pasahitza errepikatu</span>
                <div class="flex-r input">
                    <input name="Password2" type="password" placeholder="">
                    <i class="fas fa-lock"></i>
                </div>
            </div>

            <div class="input-box">
            <span class="label">Ikaslea</span>
                <select name="Ikaslea" id="ikaslea" class="ikaslea">
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
            <input type="checkbox" name="Admin" id="">
          </div>

          <input name="Submit" type="submit" class="btn" value="Erabiltzailea sortu">
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