<?php session_start(); /* Starts the session */
        
        /* Check Login form submitted */        
        if(isset($_POST['Submit'])){
                /* Define username and associated password array */
                $logins = array('admin' => '123','username1' => 'password1','username2' => 'password2');
                
                /* Check and assign submitted Username and Password to new variable */
                $Username = isset($_POST['Username']) ? $_POST['Username'] : '';
                $Password = isset($_POST['Password']) ? $_POST['Password'] : '';
                
                /* Check Username and Password existence in defined array */            
                if (isset($users[$_POST["Username"]])) {
                    if ($users[$_POST["Username"]] == $_POST["Password"]) {
                      $_SESSION["Username"] = $_POST["Username"];
                    }
                }
                if (!isset($_SESSION["Username"])) { $failed = true; }

                if (isset($_SESSION["Username"])) {
                    header("Location: index.php"); // SET YOUR OWN HOME PAGE!
                    exit();
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
        <h1>Saioa hasi</h1>
        <p>Saioa hasi gure web-orrian</p>

        <form action="" method="POST" name="login_form" class="flex-c">
          <div class="input-box">
            <span class="label">E-mail</span>
            <div class=" flex-r input">
              <input name="Username" type="text" placeholder="erabiltzailea@uni.eus">
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
          <!--
          <div class="check">
            <input type="checkbox" name="" id="">
            <span>I've read and agree with T&C</span>
          </div>-->

          <input name="Submit" type="submit" class="btn" value="Saioa hasi">
          <span class="extra-line">
            <span>Erabiltzaile berria?</span>
            <a href="#">Sortu erabiltzailea</a>
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