<?php

//Połączenie z bazą danych
//    $user = "u848159436_mcadm";
//    $psw = "MCode1234";
//    $dbName = "u848159436_mcpiz";
//    $host = "mysql.hostinger.pl";
//    
$user = "u463957321_666";
$psw = "witchery11!";
$dbName = "u463957321_666";
$host = "mysql.hostinger.pl";
try {
    $db = new PDO('mysql:host=localhost; dbname=pizzeria', 'root', '',
            //ustawiamy utf8 -> polskie znaki!
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
//        $db = new PDO("mysql:host=$host;dbname=$dbName",$user,$psw);
    //Ustawiamy wyświetlanie błędów
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Zabezpieczamy db przed atakami typu sql injection
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    echo 'lol';
} catch (PDOException $ex) {
    echo 'Błąd połączenia z db';
    echo $ex->getMessage();
}