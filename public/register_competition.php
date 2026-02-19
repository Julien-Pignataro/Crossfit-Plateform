<?php
session_start();
require __DIR__ . "/../includes/db.php";

$competition_id = $_GET["competition_id"] ?? null;

if (!$competition_id) {
    header("Location: /competitions.php");
    exit;
}

if (!isset($_SESSION["user"])) {
    header("Location: /login.php");
    exit;
}

$user_id = $_SESSION["user"]["id"];

$stmt = $pdo->prepare("INSERT INTO inscriptions (user_id, competition_id) VALUES (?, ?)");

try {
    $stmt->execute([$user_id, $competition_id]);
    header("Location: /competitions.php?msg=inscription_ok");
    exit;
} catch (Exception $e) {
    header("Location: /competitions.php?msg=deja_inscrit");
    exit;
}