<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductOrder.php";

if (isset($_POST['btn-addToCart']) && $_POST['value-productID'] != "") {
    $productID = $_POST['value-productID'];
    $order = new ProductOrder();
    $order->getCart();
    $order->addToCart($productID);
}

if (isset($_POST['btn-deleteFromCart']) && $_POST['value-productID'] != "") {
    $productID = $_POST['value-productID'];
    $order = new ProductOrder();
    $order->deleteFromCart($productID);
}