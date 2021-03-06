<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/PizzeriaMarzen/settings/errorTypes.php';
//Klasa do obsługi:
//1. Logowania
//2. Sprawdzania poprawnności danych
class userService {

    protected $id;
    protected $login;
    protected $password;
    public $errType;
    //user_details
    public $name;
    public $lastName;
    public $phoneNumber;
    public $city;
    public $postalCode;
    public $street;
    public $flatNumber;
    public $houseNumber;

    public function userService(userData $userData) {
        $this->id = $userData->id;
        $this->login = $userData->login;
        $this->password = $userData->password;
        $this->name = $userData->name;
        $this->lastName = $userData->lastName;
        $this->phoneNumber = $userData->phoneNumber;
        $this->city = $userData->city;
        $this->postalCode = $userData->postalCode;
        $this->street = $userData->street;
        $this->flatNumber = $userData->flatNumber;
        $this->houseNumber = $userData->houseNumber;
    }

    public function loginUser() {
        if (isset($_SESSION['userLogin'])) {
            return $errType = 203; // Jest już zalogowany
        } else {
            if ($this->login != "") {
                if ($this->password != "") {
                    try {
                        global $db;
                        $query = $db->prepare("SELECT login FROM users WHERE login = ?");
                        $query->bindValue(1, $this->login);
                        $query->execute();

                        if ($query->rowCount() > 0) {
                            $query = $db->prepare("SELECT id_user, password FROM users WHERE login=? AND password=?");
                            $query->bindValue(1, $this->login);
                            $query->bindValue(2, $this->password);
                            $query->execute();


                            if ($query->rowCount() > 0) {
                                $id = $query->fetch();
                                $this->id = $id['id_user'];
                                $_SESSION['userId'] = $id['id_user'];
                                $_SESSION['userLogin'] = $this->login;
                                $_SESSION['name'] = $this->name;
                                $_SESSION['lastName'] = $this->lastName;
                            } else {
                                return $errType = 201; // Nieprawidłowe hasło
                            }
                        } else {
                            return $errType = 200; // Brak konta o takim loginie/nieprawidłowe dane
                        }
                    } catch (PDOException $ex) {
                        return $errType = 299; // Nieznany błąd logowania
                    }
                } else {
                    return $errType = 202; // Jest login, brak hasła
                }
            } else {
                return $errType = 202; // Brak loginu
            }
            return $errType = 0;
        }
        /*
          if ($this->login != "" && $this->password != "") {
          if (!isset($_SESSION['userLogin'])) {
          try {
          global $db;
          $query = $db->prepare("SELECT login FROM users WHERE login = ?");
          $query->bindValue(1, $this->login);

          $query->execute();
          echo "login<br />".$query->rowCount();

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
         */
    }

    public function checkLoginState($login) {
        if ($login != "") {
            return true;
        } else {
            return false;
        }
    }

    public function logoutUser() {
        unset($this->id);
        unset($this->login);
        unset($_SESSION['userId']);
        unset($_SESSION['userLogin']);
        unset($_SESSION['order']);
        session_destroy();
    }

    public function checkUserExist(userData $user) {
        $userData = new userService($user);

        $query = $userData->getUserData($user);

        if ($query != NULL && is_object($query)) {
            return $query->rowCount();
        } else {
            return false;
        }
    }

    public function getUserData(userData $user) {
        // Gdy nie mamy loginu, ale mamy mail
        // LUB
        // Gdy mamy sam login
        try {

            $login = $user->login ? $user->login : NULL;
            $email = $user->email ? $user->email : NULL;

            if (!$login && !$email) {
                return $errType = 202; // Nie podano loginu i emaila
            }
            $query1 = "SELECT * FROM users WHERE ";
            $query2 = $user->login ? sprintf("login = \"%s\"", $user->login) : "";
            $query3 = $user->email ? sprintf("email = \"%s\"", $user->email) : "";
            $query = $query1 . $query2 . ($query2 && $query3 ? " OR " : "") . $query3;

            global $db;
            $query = $db->prepare($query);
            $query->execute();

            return $query;
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function getUserDetails($userID) {
        try {
            global $db;
            $query = $db->prepare('SELECT * FROM user_details WHERE id_user = ?');

            $query->bindValue(1, $userID);
            $query->execute();

            return $query->fetchAll();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function registerUser(userData $user) {
        $userData = new userService($user);

        $testUser = $userData->checkUserExist($user);

        if ($testUser == 0 || $testUser == "" || $testUser == false) {
            $login = $user->login;
            $password = $user->password;
            global $db;
            try {
                $query = $db->prepare(sprintf("INSERT INTO users (login, password) VALUES (\"%s\", \"%s\");", $login, $password));
                $query->execute();
                //var_dump($query);
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
        } else {
            return $errType = 211;
        }
        // Sprawdzanie poprawności danych
        return 0;
    }

    public function updateUserData() {
        global $db;
        try {
            $query = $db->prepare("INSERT INTO user_details (id_user, name, lastName, phoneNumber, city, postalCode, street, flatNumber, houseNumber) "
                    . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) "
                    . "ON DUPLICATE KEY "
                    . "UPDATE name = ?, lastName = ?, phoneNumber = ?, city = ?, postalCode = ?, street = ?, flatNumber = ?, houseNumber = ?");

            $query->bindValue(1, $this->id);
            $query->bindValue(2, $this->name);
            $query->bindValue(3, $this->lastName);
            $query->bindValue(4, $this->phoneNumber);
            $query->bindValue(5, $this->city);
            $query->bindValue(6, $this->postalCode);
            $query->bindValue(7, $this->street);
            $query->bindValue(8, $this->flatNumber);
            $query->bindValue(9, $this->houseNumber);

            $query->bindValue(10, $this->name);
            $query->bindValue(11, $this->lastName);
            $query->bindValue(12, $this->phoneNumber);
            $query->bindValue(13, $this->city);
            $query->bindValue(14, $this->postalCode);
            $query->bindValue(15, $this->street);
            $query->bindValue(16, $this->flatNumber);
            $query->bindValue(17, $this->houseNumber);

            $query->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

}
