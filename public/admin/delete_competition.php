<?php

require __DIR__ . "/../../includes/db.php";

$id = $_GET["id"] ?? null;

if ($id) {

    $stmt = $pdo->prepare("DELETE FROM competitions WHERE id = ?");
    $stmt->execute([$id]);
}

// Redirection vers la liste
header("Location: /competitions.php");
exit;