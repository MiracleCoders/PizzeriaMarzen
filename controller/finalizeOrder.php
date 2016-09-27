<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductOrder.php";

if (isset($_POST['btn-finalizeOrder'])) {
    $order = new ProductOrder();
    $products = $order->getCart();

    if (empty($products)) {
        echo "Twój koszyk jest pusty.";
    } else {
        $userData = new userData();


        $userData->id = $_SESSION['userId'];
        if ($_POST['txt-name'] != "") {
            $userData->name = $_POST['txt-name'];
        }

        if ($_POST['txt-lastName'] != "") {
            $userData->lastName = $_POST['txt-lastName'];
        }

        $userService = new userService($userData);
        $userService->updateUserData();

        $order->finalizeOrder($products);
        echo "OK";
    }
}            