<?php
include_once "./include/userService.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'init/dbConnect.php';
include_once 'include/userData.php';

//var_dump($_SESSION);
// POSTY
//Tutaj z formularza przekazujemy dane. Pochodzą one z inputów o określonej nazwie (np. login).
//isset sprawdza, czy dana zmienna istnieje.
if (isset($_POST['login']) && $_POST['login'] != "") {
    if (isset($_POST['password']) && $_POST['password'] != "") {
        $login = $_POST['login'];
        $password = $_POST['password'];
    } else {
        $errMsg = "Brakuje hasła!";
    }
} else {
    $errMsg = "Login nie może być pusty.";
}

if (isset($_POST['submitLogin'])) {
    $user = new userData();
    $user->id = filter_input(INPUT_POST, 'login');
    $user->login = filter_input(INPUT_POST, 'login');
    $user->password = filter_input(INPUT_POST, 'password');
    $loggedUser = new userService($user);
    $flag = $loggedUser->userLoginCheck();
    if ($flag != NULL)
        echo "<br />" . $allErrors[$flag] . ' (Error: ' . $flag . ')';
    if ($flag == 103)
        echo "<br />" . $_SESSION['userLogin'];
    //var_dump($_SESSION['userLogin']);
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
        <?php
        if (isset($errMsg)) {
            echo $errMsg;
        }

        if (!isset($loggedUser)) {
//        if (!$loggedUser->checkLoginState($_SESSION['userLogin'])) {
//            
//        }
            ?>           
            <form action="index.php" method="POST" enctype="multipart/form-data">
                Login <input type="text" name="login"/>
                Hasło <input type="password" name="password"/>

                <input type="submit" name="submitLogin" value="Zaloguj się"/>
            </form>
            <?php
        } else {
            ?>
            Zalogowany użytkownik: <?php echo $loggedUser->getUserData($user); ?>
            <form action="index.php" method="POST" enctype="multipart/form-data">
                <input type="submit" name="submitLogout" value="Wyloguj się"/>
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