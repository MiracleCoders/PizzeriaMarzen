<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductMgmt.php";

if (isset($_POST['btn-addProduct'])) {
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];
    $description = $_POST['productDescription'];
    $product = new ProductMgmt($name, $price, $description);
    
    $product->getIngredients();
    $product->insertProduct();

    header("Location:  ./index.php");
}