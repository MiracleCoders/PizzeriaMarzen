<?php

include_once 'settings/userDataSettings.php';

//Wykonywanie operacji na użytkownikach
class userData {

    public $id;
    public $login;
    public $password;
    public $name;
    public $lastName;
    public $email;
    public $privileges;

    //POBRANIE UŻYTKOWNIKÓW
    public function fetchAllUsers() {
        try {

            global $db;
            $query = $db->prepare("SELECT * FROM users");
            $query->execute();

            //zwrócenie pobranych użytkowników
            return $query->fetchAll();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    //REJESTRACJA UŻYTKOWNIKA
    //do metody przekazujemy obiekt user, zawierający dane użytkownika
    public function insertNewUser(userData $user) {
        try {
            global $db;
            $login = $this->login;

            //hashujemy hasło
            //$password = password_hash($this->password, HASH);
            $password = $this->password;

            //przypisujemy zmiennym dane z pól, które zostały przekazane w obiekcie
            $name = $this->name;
            $lastName = $this->lastName;
            $email = $this->email;
            $privilages = $this->privileges;

            //przygotowujemy zapytanie
            $query = $db->prepare('INSERT INTO users (login, password, name, lastName, email, privileges) VALUES (?,?,?,?,?,?)');

            //pod pytajniki podstawiane są po kolei dane użytkownika
            $query->bindValue(1, $login);
            $query->bindValue(2, $password);
            $query->bindValue(3, $name);
            $query->bindValue(4, $lastName);
            $query->bindValue(5, $email);
            $query->bindValue(6, $privilages);

            //wykonanie zapytania
            $query->execute();

            return $query->fetch();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    //USUWANIE UŻYTKOWNIKA
    public function deleteUser(userData $user) {
        try {
            global $db;

            $query = $db->prepare('DELETE FROM users WHERE id_user=?');
            $query->bindValue(1, $this->id);

            $query->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    //WYBIERANIE UŻYTKOWNIKA
    public function selectUser($id) {
        
    }
}
