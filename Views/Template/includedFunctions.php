<?php
session_start();
function redirect_to($new_location) {
    header("Location: " .$new_location );
    exit;
}

function confirm_logged_in () {

    if (!isset($_SESSION['Username']) && !isset($_SESSION['Password'])) {
        redirect_to("./index.php");
    }
}

?>
