<?php
     session_start();
      $_SESSION = array();
      $_SESSION['User_id'] = null;
      $_SESSION['First_Name'] = null;
      $_SESSION['Username'] = null;
      $_SESSION['Password'] = null;
      unset($_SESSION);
      $directory = __DIR__;
	header("Location: ../../login.php" );
?>
