<?php
     session_start();
     unset($_SESSION['User_id']);
     unset($_SESSION['First_Name']);
     unset($_SESSION['Username']);
     unset($_SESSION['Password']);
     unset($_SESSION);
      // $directory = __DIR__;
	header("Location: ./login.php" );
?>
