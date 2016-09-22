<?php

include_once 'settings/errorTypes.php';

//Klasa do obsługi:
//1. Logowania
//2. Sprawdzania poprawnności danych
class userService {

    public $login;
    public $password;
    public $name;
    public $lastName;
    public $errType;

    // Konstruktor w nowym stylu
    public function __construct(userData $userData) {
        $this->id = $userData->id;
        $this->login = $userData->login;
        $this->password = $userData->password;
        $this->name = $userData->name;
        $this->lastName = $userData->lastName;
    }

    public function loginUser() {
        if (isset($_SESSION['loggedUserID'])) {
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
                            $query = $db->prepare("SELECT * FROM users WHERE login=? AND password=?");
                            $query->bindValue(1, $this->login);
                            $query->bindValue(2, $this->password);
                            $query->execute();
                            $result=$query->fetch(PDO::FETCH_ASSOC);


                            if ($query->rowCount() > 0) {
                                $_SESSION['loggedUserID'] = $result['id_user'];
                                $_SESSION['loggedUserLogin'] = $result['login'];
                                $_SESSION['loggedUserName'] = $result['name'];
                                $_SESSION['loggedUserLastName'] = $result['lastName'];
                                $_SESSION['loggedUserPrivileges'] = $result['privileges'];
                                $this->id=$result['id_user'];
                                $this->login=$result['login'];
                                $this->password=$result['password'];
                                $this->name=$result['name'];
                                $this->lastName=$result['lastName'];
                                $this->privileges=$result['privileges'];
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
          if (!isset($_SESSION['loggedUserID'])) {
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
          $_SESSION['loggedUserID'] = $this->login;
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
        if (isset($_SESSION['loggedUserID'])) {
            $_SESSION['lastLoggedUserID'] = $_SESSION['loggedUserID'];
        }
        unset($_SESSION['loggedUserID']);
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
            $query = $db->prepare("INSERT INTO user_details (id_user, name, lastName) VALUES (?, ?, ?) "
                    . "ON DUPLICATE KEY "
                    . "UPDATE name = ?, lastName = ?");

            $query->bindValue(1, $this->id);
            $query->bindValue(2, $this->name);
            $query->bindValue(3, $this->lastName);

            $query->bindValue(4, $this->name);
            $query->bindValue(5, $this->lastName);

            $query->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

}
