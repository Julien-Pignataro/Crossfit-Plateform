<?php

$host = "mysql-julienp.alwaysdata.net";
$port = 3306;

$dbname = "julienp_crossfit";
$user = "julienp";
$pass = "CrossFitDB20"; 

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Erreur connexion BDD : " . $e->getMessage());
}