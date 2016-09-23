<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductOrder.php";

if (isset($_POST['btn-changeOrderStatus']) && $_POST['value-orderID'] != "" && $_POST['value-statusID'] != "") {
    $orderID = $_POST['value-orderID'];
    $statusID = $_POST['value-statusID'];

    $productOrder = new ProductOrder();
    $productOrder->changeStatus($orderID, $statusID);
}