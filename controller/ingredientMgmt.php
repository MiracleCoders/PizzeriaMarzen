<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductMgmt.php";

if (isset($_POST['btn-addIngredient'])) {
    $name = $_POST['ingredientName'];
    $price = $_POST['ingredientPrice'];
    $product = new ProductMgmt($name, $price, 0);

    $product->insertIngredient();

    header("Location:  ./index.php");
}