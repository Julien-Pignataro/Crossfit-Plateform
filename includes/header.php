<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($title) ? htmlspecialchars($title) : 'Crossfit' ?></title>
  <link rel="icon" href="/favicon.ico?v=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!-- Bootstrap (simple + rapide) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<header class="topbar">
  <div class="container-xxl topbar__inner">

    <!-- LOGO (chemin absolu + pas de "=") -->
    <a class="topbar__logo" href="/index.php" aria-label="Accueil">
      <img src="/assets/css/img/C175DA62-A353-4EA3-9C65-9C86E1E6B492.PNG" alt="Logo">
    </a>

    <!-- NAV (desktop) -->
    <nav class="topbar__nav topbar__nav--desktop">
      <a href="/index.php" class="<?= ($_SERVER['SCRIPT_NAME']==='/index.php')?'is-active':'' ?>">HOME</a>
      <a href="/competitions.php" class="<?= ($_SERVER['SCRIPT_NAME']==='/competitions.php')?'is-active':'' ?>">COMPETITIONS</a>
      <a href="/inscriptions.php" class="<?= ($_SERVER['SCRIPT_NAME']==='/inscriptions.php')?'is-active':'' ?>">INSCRIPTIONS</a>
    </nav>

    <!-- BURGER (mobile) -->
    <button class="burger" type="button" aria-label="Menu" aria-expanded="false" aria-controls="mobileMenu">
      <span></span><span></span><span></span>
    </button>

    <!-- ZONE COMPTE (1 seule fois) -->
    <?php if (isset($_SESSION["user"])): ?>
      <div class="topbar__account">
        <a class="topbar__user" href="/mes_inscriptions.php" aria-label="Mon compte">
          <span>Mon compte</span>
          <i class="fa-solid fa-dumbbell"></i>
        </a>

        <a class="topbar__logout" href="/logout.php" aria-label="Déconnexion" title="Déconnexion">
          <i class="fa-solid fa-right-from-bracket"></i>
        </a>
      </div>
    <?php else: ?>
      <a class="topbar__user" href="/login.php" aria-label="Compte">
        <span>Mon compte</span>
        <i class="fa-solid fa-dumbbell"></i>
      </a>
    <?php endif; ?>

  </div>

  <!-- NAV (mobile) -->
  <nav class="topbar__nav topbar__nav--mobile" id="mobileMenu">
    <a href="/index.php" class="<?= ($_SERVER['SCRIPT_NAME']==='/index.php')?'is-active':'' ?>">HOME</a>
    <a href="/competitions.php" class="<?= ($_SERVER['SCRIPT_NAME']==='/competitions.php')?'is-active':'' ?>">COMPETITIONS</a>
    <a href="/inscriptions.php" class="<?= ($_SERVER['SCRIPT_NAME']==='/inscriptions.php')?'is-active':'' ?>">INSCRIPTIONS</a>
  </nav>
</header>

<main>