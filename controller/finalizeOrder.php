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

        if ($_POST['txt-phoneNumber'] != "") {
            $userData->phoneNumber = $_POST['txt-phoneNumber'];
        }

        if ($_POST['txt-city'] != "") {
            $userData->city = $_POST['txt-city'];
        }

        if ($_POST['txt-postalCode'] != "") {
            $userData->postalCode = $_POST['txt-postalCode'];
        }

        if ($_POST['txt-street'] != "") {
            $userData->street = $_POST['txt-street'];
        }

        if ($_POST['txt-flatNumber'] != "") {
            $userData->flatNumber = $_POST['txt-flatNumber'];
        }

        if ($_POST['txt-houseNumber'] != "") {
            $userData->houseNumber = $_POST['txt-houseNumber'];
        }

        $userService = new userService($userData);
        $userService->updateUserData();

        $order->finalizeOrder($products);
        echo "OK";
    }
}            