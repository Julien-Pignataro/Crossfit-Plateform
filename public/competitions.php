<?php
$title = "Competitions";
require __DIR__ . "/../includes/header.php";
require __DIR__ . "/../includes/db.php";

$msg = $_GET["msg"] ?? null;

$stmt = $pdo->query("SELECT id, title, event_date FROM competitions ORDER BY event_date ASC");
$competitions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="hero hero-competitions">
  <div class="container-xxl hero__content">
    <h1 class="hero__title">Compétitions Organisées</h1>

    <?php if ($msg === "inscription_ok"): ?>
      <div class="alert alert-success">✅ Inscription réussie !</div>
    <?php elseif ($msg === "deja_inscrit"): ?>
      <div class="alert alert-warning">⚠️ Vous êtes déjà inscrit.</div>
    <?php endif; ?>

    <div class="comp-grid">
      <?php if (empty($competitions)): ?>
        <div class="glass">
          Aucune compétition pour le moment. Ajoute-en dans la base de données.
        </div>
      <?php else: ?>

        <?php foreach($competitions as $c): ?>
          <div class="comp-card">

            <h3 style="font-weight:800;">
              <?= htmlspecialchars($c["title"]) ?>
            </h3>

            <p style="font-weight:700;">
              Compétition du<br>
              <?= $c["event_date"] ? date("d/m/Y", strtotime($c["event_date"])) : "Date à venir" ?>
            </p>

            <!-- Boutons utilisateur -->
            <div class="btn-row">

              <a class="pill-btn"
                 href="/competition.php?id=<?= (int)$c["id"] ?>">
                 <i class="fa-solid fa-eye"></i>
                 Voir fiche
              </a>

              <a class="pill-btn"
                 href="/inscriptions.php?competition_id=<?= (int)$c["id"] ?>">
                 <i class="fa-solid fa-user-plus"></i>
                 S'inscrire
              </a>

            </div>

            <!-- Boutons admin -->
            <?php if (isset($_SESSION["user"]) && $_SESSION["user"]["role"] === "admin"): ?>

              <div class="btn-row btn-row-admin">

                <a class="pill-btn pill-btn-admin"
                   href="/admin/edit_competition.php?id=<?= (int)$c["id"] ?>">
                   <i class="fa-solid fa-pen"></i>
                   Modifier
                </a>

                <a class="pill-btn pill-btn-admin"
                   href="/admin/participants.php?competition_id=<?= (int)$c["id"] ?>">
                   <i class="fa-solid fa-users"></i>
                   Participants
                </a>

                <a class="pill-btn pill-btn-danger"
                   href="/admin/delete_competition.php?id=<?= (int)$c["id"] ?>"
                   onclick="return confirm('Supprimer cette compétition ?')">
                   <i class="fa-solid fa-trash"></i>
                   Supprimer
                </a>

              </div>

            <?php endif; ?>

          </div>
        <?php endforeach; ?>

      <?php endif; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . "/../includes/footer.php"; ?>