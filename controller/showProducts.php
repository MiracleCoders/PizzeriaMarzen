<?php

require_once "./include/ProductMgmt.php";

if (isset($_POST['btn-showProducts'])) {
    if (!isset($_SESSION['showProducts'])) {
        $_SESSION['showProducts'] = true;
    } else {
        $_SESSION['showProducts'] = $_SESSION['showProducts'] == true ? false : true;
    }
}