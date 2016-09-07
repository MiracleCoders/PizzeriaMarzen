<?php
include_once $_SERVER['DOCUMENT_ROOT']."/PizzeriaMarzen/init/dbConnect.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PizzeriaMarzen/settings/errorTypes.php";

class ProductMgmt {

    public $name;

    public function __construct($name) {
        $this->name = $name;
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

    public function insertProduct() {
        try {
            global $db;
            $name = $this->name;

            //przygotowujemy zapytanie
            $query = $db->prepare('INSERT INTO products (name) VALUES (?)');

            //pod pytajniki podstawiane są po kolei dane użytkownika
            $query->bindValue(1, $name);

            //wykonanie zapytania
            $query->execute();

            return $query->fetch();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

}
