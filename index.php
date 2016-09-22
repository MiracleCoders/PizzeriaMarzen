<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['mainPage'])) {
    $_SESSION['mainPage']=true;
}

include_once "./init/loader.php";

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

?>

<!--<!DOCTYPE html>


Baza:       u848159436_mcpiz
Użytkownik: u848159436_mcadm
Hasło:      MCode1234

Host SQL:   mysql.hostinger.pl


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <script type="text/javascript">
            
        </script>-->

        <?php
        //require './view/mainTemplate.php';
        