<?php

include_once 'settings/errorTypes.php';

//Klasa do obsługi:
//1. Logowania
//2. Sprawdzania poprawnności danych
class userService {

    protected $login;
    protected $password;
    protected $name;
    protected $lastName;
    
    public function userService(userData $userData) {
        $this->login = $userData->login;
        $this->password = $userData->password;
        $this->name = $userData->name;
        $this->lastName = $userData->lastName;
    }

    public function userLoginCheck() {
        if ($this->login != "" && $this->password != "") {
            if (!isset($_SESSION['userLogin'])) {
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
                            $_SESSION['name'] = $this->name;
                            $_SESSION['lastName'] = $this->lastName;
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
                return $errType = 103;
            }
        } else {
            return $errType = 102;
        }
    }

    public function checkLoginState($login) {
        if ($login != "") {
            return true;
        } else {
            return false;
        }
    }
    
    public function logout() {
        unset($_SESSION['userLogin']);
    }
    
    public function getUserData(userData $user) {
        $fullUserName = sprintf("%s %s", $user->name, $user->lastName);
        return $fullUserName;
    }

}
