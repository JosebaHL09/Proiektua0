<?php
 session_start();
 $_SESSION['user_id'] = 0;
 $_SESSION['username'] = '';
 $_SESSION['mail'] = '';
 $_SESSION['admin'] = '';
 $_SESSION['id_curso'] = null;
 $_SESSION['ikasleid'] = null;

 header("Location:../Templates/index.php");
?>