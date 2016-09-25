<?php

//Połączenie z bazą danych
//    $user = "u848159436_mcadm";
//    $psw = "MCode1234";
//    $dbName = "u848159436_mcpiz";
//    $host = "mysql.hostinger.pl";
//    
$dbcDBUser = "u463957321_666";
$dbcDBPsw = "witchery11!";
$dbcDBName = "u463957321_666";
$dbcDBHost = "mysql.hostinger.pl";

try {
    $db = new PDO('mysql:host=localhost; dbname=pizzeria', 'root', '',
            //ustawiamy utf8 -> polskie znaki!
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'", PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
//        $db = new PDO("mysql:host=$dbcDBHost;dbname=$dbcDBName",$dbcDBUser,$dbcDBPsw);
    //Ustawiamy wyświetlanie błędów
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Zabezpieczamy db przed atakami typu sql injection
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $ex) {
    echo $ex->getMessage();
    return $errType = 100; // Błąd połączenia z bazą
}