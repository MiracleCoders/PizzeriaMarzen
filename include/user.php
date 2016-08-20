<?php

//Wykonywanie operacji na użytkownikach
class user {

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
    public function insertNewUser(user $user) {
        try {
            global $db;
            $login = $user->login;

            //hashujemy hasło
            $password = password_hash($user->password, PASSWORD_DEFAULT);

            //przypisujemy zmiennym dane z pól, które zostały przekazane w obiekcie
            $name = $user->name;
            $lastName = $user->lastName;
            $privilages = $user->privileges;

            //przygotowujemy zapytanie
            $query = $db->prepare('INSERT INTO users (login, password, name, lastName, privileges) VALUES (?,?,?,?,?)');

            //pod pytajniki podstawiane są po kolei dane użytkownika
            $query->bindValue(1, $login);
            $query->bindValue(2, $password);
            $query->bindValue(3, $name);
            $query->bindValue(4, $lastName);
            $query->bindValue(5, $privilages);

            //wykonanie zapytania
            $query->execute();

            return $query->fetch();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    //USUWANIE UŻYTKOWNIKA
    public function deleteUser(user $user) {
        try {
            global $db;
            $id = $user->id;

            $query = $db->prepare('DELETE FROM users WHERE id_user=?');
            $query->bindValue(1, $id);

            $query->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

}