<?php
include_once "./include/userService.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'init/dbConnect.php';
include_once 'include/userData.php';

$dir = '//' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

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


//usuwanie użytkownika
if (isset($_POST['btn-deleteUser'])) {
    $user = new userData();
    $user->id = filter_input(INPUT_POST, 'idUser');
    $user->deleteUser($user);
    header("Location: " . basename(__FILE__));
}

//filter_input używamy w celu przefiltrowania danych znajdujących się z zmiennej superglobalnej POST.
//if (isset($_POST['btn-Register'])) {
//    //tworzymy nowy obiekt typu user, przypisujemy mu następnie poszczególne wartości z formularza
//    $user = new userData();
//    $user->login = trim(filter_input(INPUT_POST, 'login'));
//    $user->password = trim(filter_input(INPUT_POST, 'password'));
//    $user->name = trim(filter_input(INPUT_POST, 'name'));
//    $user->lastName = trim(filter_input(INPUT_POST, 'lastName'));
//    $user->email = trim(filter_input(INPUT_POST, 'email'));
//    $user->privileges = trim(filter_input(INPUT_POST, 'privileges'));
//    //używając metody insertNewUser wstawiamy nowego użytkownika
//    $user->insertNewUser($user);
//
//    //Musimy zapobiec ponownemu przesłaniu formularza (klawisz f5)
//    header("Location: " . basename(__FILE__));
//}

//do zmiennej $allUsers przypisujemy wartość pochodzącą z wywołania metody pobierającej dane wszystkich użytkowników
$user = new userData();
$allUsers = $user->fetchAllUsers();

$tmp = new userData();
$tmp->login = "test4";
$tmp->password = "pass4";


$tmp2 = new userService($tmp);
echo "Test: " . $tmp2->checkUserExist($tmp);
if ($tmp2->checkUserExist($tmp) == 0) {
    $tmp2->registerUser($tmp);
}
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
        require './view/mainTemplate.php';
        