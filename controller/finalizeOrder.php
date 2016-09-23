<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductOrder.php";

if (isset($_POST['btn-finalizeOrder'])) {
    $order = new ProductOrder();
    $products = $order->getCart();

    if (empty($products)) {
        echo "Twój koszyk jest pusty.";
    } else {
        $order->finalizeOrder($products);
        echo "OK";
    }
}            