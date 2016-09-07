<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductMgmt.php";
if (isset($_POST['btn-addProduct']) && $_POST['productName'] != "") {
    $name = $_POST['productName'];
    $product = new ProductMgmt($name);
    
    $product->insertProduct();
    
    header("Location:  ./index.php");
}