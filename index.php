<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'init/dbConnect.php';
include_once 'include/user.php';

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

//usuwanie użytkownika
if (isset($_POST['btn-deleteUser'])) {
    $user = new user();
    $user->id = filter_input(INPUT_POST, 'idUser');
    $user->deleteUser($user);
}

//filter_input używamy w celu przefiltrowania danych znajdujących się z zmiennej superglobalnej POST.
if (isset($_POST['btn-Register'])) {
    //tworzymy nowy obiekt typu user, przypisujemy mu następnie poszczególne wartości z formularza
    $user = new user();
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
$user = new user();
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
        <?php if (isset($errMsg)) echo $errMsg; ?>
        <form action="index.php" method="POST" enctype="multipart/form-data">
            Login <input type="text" name="login"/>
            Hasło <input type="password" name="password"/>

            <input type="submit" name="submitLogin" value="Zaloguj się"/>
        </form>


        Rejestracja
        <form action="index.php" method="POST" enctype="multipart/form-data">
            Login <input type="text" name="login"/>
            Imię <input type="text" name="name"/>
            Nazwisko <input type="text" name="lastName"/>
            Hasło <input type="password" name="password"/>
            Email <input type="text" name="privileges"/>

            <input type="submit" name="btn-Register" value="Zarejestruj się"/>
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