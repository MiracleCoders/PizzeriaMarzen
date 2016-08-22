<?php

include_once 'settings/errorTypes.php';

//Klasa do obsługi:
//1. Logowania
//2. Sprawdzania poprawnności danych
class userService {

    protected $login;
    protected $password;

    public function userService(userData $userData) {
        $this->login = $userData->login;
        $this->password = $userData->password;
    }

    public function userLoginCheck() {
        if ($login != "" && $password != "") {
            try {
                global $db;
                $query = $db->prepare("SELECT login FROM users WHERE login = ?");
                $query->bindValue(1, $this->login);

                $query->execute();

                if ($query->rowCount() > 0) {
                    $query = $db->prepare("SELECT password FROM users WHERE login=? AND password=?");
                    $query->bindValue(1, $this->login);
                    $query->bindValue(2, $this->password);

                    $query->execute();

                    if ($query->rowCount() > 0) {
                        $_SESSION['userLogin'] = $this->login;
                    } else {
                        return $errType = 101;
                    }
                } else {
                    return $errType = 100;
                }
            } catch (PDOException $ex) {
                $ex->getMessage();
            }
        } else {
            return $errType = 102;
        }
    }

}
