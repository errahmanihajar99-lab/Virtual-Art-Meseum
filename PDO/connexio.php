<?php

$host = "localhost";
$port = "3307";
$dbname = "prjf01_hajar_errahmani";
$username = "root";
$password = "";

try{
    $connexio = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
            $username,
            $password
    );

    $connexio->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    echo "Connexion réussie";
}catch(PDOException $e){
    exit("problème de connexion");
}
?>