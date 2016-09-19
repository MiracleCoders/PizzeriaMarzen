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

}
