<?php
$title = "Mes inscriptions";

require __DIR__ . "/../includes/header.php";
require __DIR__ . "/../includes/db.php";

// Sécurité : user connecté obligatoire
if (!isset($_SESSION["user"])) {
    header("Location: /login.php");
    exit;
}

$user_id = $_SESSION["user"]["id"];

// Récupère les compétitions liées à l'utilisateur
$stmt = $pdo->prepare("
    SELECT c.id, c.title, c.event_date, c.city, i.created_at
    FROM inscriptions i
    JOIN competitions c ON c.id = i.competition_id
    WHERE i.user_id = ?
    ORDER BY c.event_date ASC
");
$stmt->execute([$user_id]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="hero hero-competitions">
  <div class="container-xxl hero__content">
    <h1 class="hero__title">Mes inscriptions</h1>

    <?php if (empty($rows)): ?>
      <div class="glass" style="max-width:700px;">
        Vous n’êtes inscrit à aucune compétition pour le moment.
        <div class="mt-3">
          <a class="pill-btn" href="/competitions.php">Voir les compétitions</a>
        </div>
      </div>
    <?php else: ?>

      <div class="comp-grid">
        <?php foreach ($rows as $r): ?>

  <div class="comp-card">

      <h3><?= htmlspecialchars($r["title"]) ?></h3>

      <p>
          Date : <?= date("d/m/Y", strtotime($r["event_date"])) ?><br>
          Ville : <?= htmlspecialchars($r["city"]) ?>
      </p>

      <div class="btn-row">

          <a class="pill-btn"
             href="/competition.php?id=<?= (int)$r["id"] ?>">
             Voir fiche Wod
          </a>

          <a class="pill-btn pill-btn-danger"
             href="/unsubscribe.php?competition_id=<?= (int)$r["id"] ?>"
             onclick="return confirm('Se désinscrire ?')">
             Se désinscrire
          </a>

      </div>

  </div>

<?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<?php require __DIR__ . "/../includes/footer.php"; ?>