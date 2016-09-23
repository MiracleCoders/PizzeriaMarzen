<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/init/dbConnect.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/settings/errorTypes.php";

class ProductOrder {

    public $order = array();

    public function getCart() {
        if (isset($_SESSION['order'])) {
            $this->order = $_SESSION['order'];
            $products = $this->order;
            try {
                $order = array();
                global $db;
                foreach ($products as $product) {
                    $query = $db->prepare("SELECT id_product, name, description, price FROM products WHERE id_product = ?");
                    $query->bindValue(1, $product);
                    $query->execute();
                    array_push($order, $query->fetchAll());
                }
                return $order;
            } catch (PDOException $ex) {
                $ex->getMessage();
            }
            return $this->order;
        }
    }

    public function addToCart($productID) {
        if ($productID != "") {
            if (!isset($_SESSION['order'])) {
                $_SESSION['order'] = array();
            }
            array_push($_SESSION['order'], $productID);
        }
    }

    public function flushCart() {
        unset($this->order);
        unset($_SESSION['order']);
    }

    public function deleteFromCart($productID) {
        $key = array_search($productID, $_SESSION['order']);
        if ($key !== false)
            unset($_SESSION['order'][$key]);
        $_SESSION['order'] = array_values($_SESSION['order']);
    }

    public function finalizeOrder($products) {
        $date = date("Y-m-d H:i:s");
        $userID = $_SESSION['userId'];
        //Insert order into db
        try {
            global $db;
            $query = $db->prepare("INSERT INTO orders (id_user, date) VALUES (?,?)");
            $query->bindValue(1, $userID);
            $query->bindValue(2, $date);
            $query->execute();
            $orderID = $db->lastInsertId();

            //Insert order detalis into db
            foreach ($products as $product) {
                foreach ($product as $specifiedProduct) {
                    try {
                        global $db;
                        $query = $db->prepare("INSERT INTO order_product (id_order, id_product, price) VALUES (?,?,?)");
                        $query->bindValue(1, $orderID);
                        $query->bindValue(2, $product[0]['id_product']);
                        $query->bindValue(3, $product[0]['price']);
                        $query->execute();
                    } catch (PDOException $ex) {
                        echo $ex->getMessage();
                    }
                }
            }
            // return $order;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function showPendingOrders() {
        try {
            global $db;
            $query = $db->prepare("SELECT * FROM orders");
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
//    public function getProductName() {
//        try {
//            global $db;
//            $query = $db->prepare("SELECT * FROM products WHERE ");
//            $query->execute();
//            return $query->fetchAll();
//        } catch (PDOException $ex) {
//            echo $ex->getMessage();
//        }
//    }
    
    public function changeStatus($orderID, $statusID) {
        try {
            global $db;
            $nextStatus = $statusID + 1;
            $query = $db->prepare("UPDATE orders SET id_status=? WHERE id_order=?");
            $query->bindValue(1, $nextStatus);
            $query->bindValue(2, $orderID);
            $query->execute();
            
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

}
