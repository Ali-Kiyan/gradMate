<?php
//setting up the session
session_start();
function redirectTo($new_location) {
    header("Location: " . $new_location );
    exit;
}

function confirmLoggedIn () {
    if (!isset($_SESSION['Username']) && !isset($_SESSION['Password'])) {
      redirectTo("./Views/Template/logout.php");
    }
}
function confirmAdmin () {

    if (!$_SESSION['Is_Admin'] || !isset($_SESSION['Username']) || !isset($_SESSION['Password'])) {
        redirectTo("./Views/Template/logout.php");

    }
}
function authRedirect(){
  if($_SESSION['Is_Admin'] && isset($_SESSION['Username']) && isset($_SESSION['Password']))
  {
    redirectTo("./adminDashboard.php");
  }
  else if($_SESSION['Is_Admin']==0 && isset($_SESSION['Username']) && isset($_SESSION['Password']))
  {
    redirectTo("./Dashboard.php");
  }
}

?>
