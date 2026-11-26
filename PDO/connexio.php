<?php

$host = "localhost";
$port = "3307";
$dbname = "prjf01_hajar_errahmani";
$dbUsername = "root";
$password = "";

try{
    $connexio = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
            $dbUsername,
            $password
    );

    $connexio->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

}catch(PDOException $e){
    exit("problème de connexion");
}
?>