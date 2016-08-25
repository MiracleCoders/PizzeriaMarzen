<?php
include_once "./include/userService.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'init/dbConnect.php';
include_once 'include/userData.php';

// Funkcja wyświetlająca alert z tekstem
function msgBox($txt) {
    echo sprintf("<script type=\"text/javascript\">alert(\"%s\");</script>", $txt);
}

function msgBox2($txt) {
    echo sprintf("<script type=\"text/javascript\">debug=\"%s\";</script>", $txt);
}

// Jeżeli użytkownik jest zalogowany to trzeba stworzyć obiekt user i loggedUser
// bo przy każdym odświeżeniu strony znika
if (isset($_SESSION['userLogin']) && $_SESSION['userLogin'] != "") {
    $user = new userData();
    $user->id = $_SESSION['userId'];
    $user->login = $_SESSION['userLogin'];
    $loggedUser = new userService($user);
}

// Obsługa przycisku logowania
if (isset($_POST['btn-Login'])) {
    // Tworzymy zmienną z obiektem typu danych użytkownika (klasa user)
    // Zbieramy z pól filtrowane dane
    $user = new userData();
    $user->login = filter_input(INPUT_POST, 'login');
    $user->password = filter_input(INPUT_POST, 'password');
    // Tworzymy zmienną obiektową dla zalogowanego użytkownika
    if ($user->login != "") {
        // Jest login
        if ($user->password != "") {
            // Jest login i jest hasło
            $loggedUser = new userService($user);
            $errType = $loggedUser->userLoginCheck();
            //msgBox("Login: " . $user->login . "\\n" . $allErrors[$errType]); // wyświetl wprowadzone dane
            if ($errType != 0) {
                // Błąd logowania
                echo "<br />" . $allErrors[$errType] . ' (Error: ' . $errType . ')';
            } else {
                // Logowanie zakończone sukcesem
                $_SESSION['userId'] = $user->id;
                $_SESSION['userLogin'] = $user->login;
                //header("Location: index.php");
            }
        } else {
            $errType = 202; // Jest login, nie ma hasła
        }
    } else {
        $errType = 202; // Nie ma loginu (i hasła)
}
}

if (isset($_POST['btn-Logout'])) {
    if (isset($_SESSION['userLogin']) && $_SESSION['userLogin'] != "") {
        $loggedUser->logout();
    } else {
        $errType = 210; // Nie można wylogować
    }
}
//usuwanie użytkownika
if (isset($_POST['btn-deleteUser'])) {
    $user = new userData();
    $user->id = filter_input(INPUT_POST, 'idUser');
    $user->deleteUser($user);
}

//filter_input używamy w celu przefiltrowania danych znajdujących się z zmiennej superglobalnej POST.
if (isset($_POST['btn-Register'])) {
    //tworzymy nowy obiekt typu user, przypisujemy mu następnie poszczególne wartości z formularza
    $user = new userData();
    $user->login = trim(filter_input(INPUT_POST, 'login'));
    $user->password = trim(filter_input(INPUT_POST, 'password'));
    $user->name = trim(filter_input(INPUT_POST, 'name'));
    $user->lastName = trim(filter_input(INPUT_POST, 'lastName'));
    $user->email = trim(filter_input(INPUT_POST, 'email'));
    $user->privileges = trim(filter_input(INPUT_POST, 'privileges'));
    //używając metody insertNewUser wstawiamy nowego użytkownika
    $user->insertNewUser($user);

    //Musimy zapobiec ponownemu przesłaniu formularza (klawisz f5)
    header("Location: index.php");
}

//do zmiennej $allUsers przypisujemy wartość pochodzącą z wywołania metody pobierającej dane wszystkich użytkowników
$user = new userData();
$allUsers = $user->fetchAllUsers();
?>

<!DOCTYPE html>
<!--

Baza:       u848159436_mcpiz
Użytkownik: u848159436_mcadm
Hasło:      MCode1234

Host SQL:   mysql.hostinger.pl

-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <script type="text/javascript">
            debug = 0;
            debugTimer = setInterval(function () {
                if (debug != 0) {
                    alert(debug);
                    debug = 0;
                }
            }, 100);
        </script>
        <?php
        if (!isset($_SESSION['userLogin'])) {
//        if (!$loggedUser->checkLoginState($_SESSION['userLogin'])) {
//            
//        }
            ?>           
            <form action="index.php" method="POST" enctype="multipart/form-data">
                Login <input type="text" name="login"/>
                Hasło <input type="password" name="password"/>

                <input type="submit" name="btn-Login" value="Zaloguj się"/>
            </form>
            <?php
        } else {
            ?>
            Zalogowany użytkownik: <?php echo $_SESSION['userLogin']; ?>
            <form action="index.php" method="POST" enctype="multipart/form-data">
                <input type="submit" name="btn-Logout" value="Wyloguj się"/>
            </form>
            <?php
        }
        ?>

        Rejestracja
        <form action = "index.php" method = "POST" enctype = "multipart/form-data">
            Login <input type = "text" name = "login"/>
            Imię <input type = "text" name = "name"/>
            Nazwisko <input type = "text" name = "lastName"/>
            Hasło <input type = "password" name = "password"/>
            Email <input type = "text" name = "privileges"/>

            <input type = "submit" name = "btn-Register" value = "Zarejestruj się"/>
        </form>

        <?php
        //dla każdego użytkownika utwórz jego wiersz z danymi i wypisz wartości z kolumny login
        foreach ($allUsers as $rowUser) {
            echo '<br/>';
            echo $rowUser['login'];
            ?>

            <form action="index.php" method="POST" enctype="multipart/form-data">
                Login <input type="hidden" value="<?php echo $rowUser['id_user']; ?>" name="idUser"/>
                <input type="submit" name="btn-deleteUser" value="Usuń użytkownika"/>
            </form>
            <?php
        }
        ?>
    </body>
</html>