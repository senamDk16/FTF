<?php
    try{
        $host = 'localhost';
        $user = "root";
        $pwd = "";
        $dbname = "data_arbitres";
        $pdo = new PDO("mysql:host=$host; dbname=$dbname", $user, $pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
        die('ERROR' + $e->getMessage());
    }
?>