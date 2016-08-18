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
        $db = new PDO('mysql:host=mysql.hostinger.pl; dbname=u463957321_666', 'u463957321_666', 'witchery11!');
//        $db = new PDO("mysql:host=$host;dbname=$dbName",$user,$psw);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        echo 'lol';
    } catch (Exception $ex) {
        echo 'Błąd połączenia z db';
    }