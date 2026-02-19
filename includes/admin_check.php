<?php

if (!isset($_SESSION["user"])) {
    header("Location: /login.php");
    exit;
}

if ($_SESSION["user"]["role"] !== "admin") {
    die("Accès refusé");
}