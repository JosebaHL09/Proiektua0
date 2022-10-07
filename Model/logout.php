<?php
 session_start();
 $_SESSION['user_id'] = 0;
 $_SESSION['username'] = '';
 $_SESSION['mail'] = '';

 header("Location:../Templates/index.php");
?>