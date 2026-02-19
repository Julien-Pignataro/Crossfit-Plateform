<?php
session_start();
require __DIR__ . "/../includes/db.php";

if (!isset($_SESSION["user"])) {
    header("Location: /login.php");
    exit;
}

$user_id = $_SESSION["user"]["id"];
$competition_id = $_GET["competition_id"] ?? null;

if ($competition_id) {

    $stmt = $pdo->prepare("
        DELETE FROM inscriptions
        WHERE user_id = ? AND competition_id = ?
    ");

    $stmt->execute([$user_id, $competition_id]);
}

header("Location: /mes_inscriptions.php");
exit;