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

    if (!$_SESSION['Is_Admin']) {
        redirectTo("./Views/Template/logout.php");
    }
}

?>
