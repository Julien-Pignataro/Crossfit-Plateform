<?php

$host = '127.0.0.1';
$db   = 'crossfit';
$user = 'root';
$pass = ''; // ton mot de passe MySQL

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
    die('Erreur connexion BDD : ' . $e->getMessage());
}