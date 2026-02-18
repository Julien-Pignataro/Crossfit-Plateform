<?php
$title = "Competitions";
require __DIR__ . "/../includes/header.php";

require __DIR__ . "/../includes/db.php";

$stmt = $pdo->query("SELECT id, title, event_date, city FROM competitions ORDER BY event_date ASC");
$competitions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="hero hero-competitions">
  <div class="container-xxl hero__content">
    <h1 class="hero__title">Compétitions Organisées</h1>

    <div class="comp-grid">

      <?php if (empty($competitions)): ?>
        <div class="glass">
          Aucune compétition pour le moment. Ajoute-en dans la base de données.
        </div>
      <?php else: ?>

        <?php foreach ($competitions as $competition): ?>
          <div class="comp-card">
            <h3 style="font-weight:800;">
              <?= htmlspecialchars($competition["title"]) ?>
            </h3>

            <p style="font-weight:700;">
              Compétition du<br>
              <?= $competition["event_date"] ? date("d/m/Y", strtotime($competition["event_date"])) : "Date à venir" ?>
            </p>

            <div class="pill-row">
              <a class="pill-btn" href="/competition.php?id=<?= (int)$competition["id"] ?>">Voir fiche Wod</a>
              <a class="pill-btn" href="/inscriptions.php?competition_id=<?= (int)$competition["id"] ?>">Inscriptions</a>
              <a class="pill-btn" href="/admin/delete_competition.php?id=<?= $competition["id"] ?>"onclick="return confirm('Supprimer cette compétition ?')">Supprimer</a>
            </div>
          </div>
        <?php endforeach; ?>

      <?php endif; ?>

    </div>
  </div>
</section>

<?php require __DIR__ . "/../includes/footer.php"; ?>