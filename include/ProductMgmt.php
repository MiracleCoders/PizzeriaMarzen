<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/init/dbConnect.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/settings/errorTypes.php";

class ProductMgmt {

    public $name;
    public $price;
    public $description;
    public $ingredients;

    public function __construct($name, $price, $description) {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }

    public function fetchProducts() {
        try {
            global $db;
            $query = $db->prepare("SELECT * FROM products");
            $query->execute();

            //zwrócenie pobranych użytkowników
            return $query->fetchAll();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function fetchIngredients() {
        try {
            global $db;
            $query = $db->prepare("SELECT * FROM ingredients");
            $query->execute();

            return $query->fetchAll();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function fetchProductIngredients($id) {
        try {
            global $db;
            $query = $db->prepare('SELECT i.name FROM products p, ingredients i, product_ingredient pr '
                    . 'WHERE pr.id_product = p.id_product '
                    . 'AND pr.id_ingredient = i.id_ingredient AND p.id_product=?');
            $query->bindValue(1, $id);
            $query->execute();

            return $query->fetchAll();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getIngredients() {
        $i = 0;
        if (!empty($_POST['check_ingredients'])) {
            foreach ($_POST['check_ingredients'] as $check) {
                $this->ingredients[$i++] = $check;
            }
        } else {
            die("BRAK SKŁADNIKóW");
        }
    }

    public function insertIngredient() {
        $name = $this->name;
        $price = $this->price;

        if ($name != "" && $price != "") {
            try {
                global $db;
                $query = $db->prepare('INSERT INTO ingredients (name, price) VALUES (?,?)');

                $query->bindValue(1, $name);
                $query->bindValue(2, $price);

                //wykonanie zapytania
                $query->execute();
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
        } else {
            echo "Nie dodano składnika";
        }
    }

    public function insertProduct() {
        $name = $this->name;
        $price = $this->price;
        $description = $this->description;

        if ($name != "" && $price != "" && $description != "") {
            try {
                global $db;
                //Wstawienie produktu
                //przygotowujemy zapytanie
                $query = $db->prepare('INSERT INTO products (name, price, description) VALUES (?,?,?)');

                $query->bindValue(1, $name);
                $query->bindValue(2, $price);
                $query->bindValue(3, $description);

                //wykonanie zapytania
                $query->execute();
                $lastId = $db->lastInsertId();

                //Wstawienie składników do product_ingredient
                $ingredients = $this->ingredients;
                $i = 0;
                foreach ($ingredients as $ingredient) {
                    $query = $db->prepare('INSERT INTO product_ingredient (id_product, id_ingredient) VALUES (?,?)');
                    $query->bindValue(1, $lastId);
                    $query->bindValue(2, $ingredient);

                    $query->execute();

                    echo "WSTAWIONO SKŁADNIK" . $ingredient[0];
                }
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
        } else {
            $errType = 300;
        }
    }

}
