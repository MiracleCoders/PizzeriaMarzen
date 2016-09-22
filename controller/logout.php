<?php

// Obsługa przycisku wylogowania
if (isset($_POST['btn-Logout'])) {
    if (isset($_SESSION['loggedUserID']) && $_SESSION['loggedUserID'] != "") {
        $loggedUser->logoutUser();
        //header("Location: " . $root . "./index.php");
    } else {
        $errType = 210; // Nie można wylogować
    } 
}