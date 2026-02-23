<?php
$title = "Competitions";
require __DIR__ . "/../includes/header.php";
require __DIR__ . "/../includes/db.php";

$msg = $_GET["msg"] ?? null;

$stmt = $pdo->query("
  SELECT id, title, description, event_date, wod_rx, wod_intermediate, wod_scaled
  FROM competitions
  ORDER BY event_date ASC
");
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

            <div class="btn-row">
              <button
                type="button"
                class="pill-btn"
                data-bs-toggle="modal"
                data-bs-target="#wodModal"
                data-title="<?= htmlspecialchars($c["title"]) ?>"
                data-description="<?= htmlspecialchars($c["description"] ?? "") ?>"
                data-wod-rx="<?= htmlspecialchars($c["wod_rx"] ?? "WOD RX non défini") ?>"
                data-wod-int="<?= htmlspecialchars($c["wod_intermediate"] ?? "WOD Intermédiaire non défini") ?>"
                data-wod-scaled="<?= htmlspecialchars($c["wod_scaled"] ?? "WOD Scaled non défini") ?>"
              >
                <i class="fa-solid fa-eye"></i> Voir fiche
              </button>

              <a class="pill-btn"
                 href="/inscriptions.php?competition_id=<?= (int)$c["id"] ?>">
                 <i class="fa-solid fa-user-plus"></i>
                 S'inscrire
              </a>
            </div>

            <?php if (isset($_SESSION["user"]) && $_SESSION["user"]["role"] === "admin"): ?>
              <div class="btn-row btn-row-admin">
                <a class="pill-btn pill-btn-admin"
                   href="/admin/edit_competition.php?id=<?= (int)$c["id"] ?>">
                   <i class="fa-solid fa-pen"></i> Modifier
                </a>

                <a class="pill-btn pill-btn-admin"
                   href="/admin/participants.php?competition_id=<?= (int)$c["id"] ?>">
                   <i class="fa-solid fa-users"></i> Participants
                </a>

                <a class="pill-btn pill-btn-danger"
                   href="/admin/delete_competition.php?id=<?= (int)$c["id"] ?>"
                   onclick="return confirm('Supprimer cette compétition ?')">
                   <i class="fa-solid fa-trash"></i> Supprimer
                </a>
              </div>
            <?php endif; ?>

          </div>
        <?php endforeach; ?>

      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ✅ MODAL WOD (UNE SEULE FOIS) -->
<div class="modal fade" id="wodModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="wodModalTitle">Fiche WOD</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>

      <div class="modal-body">

        <!-- ✅ description placée ici (propre) -->
      <div id="wodInfo" class="wod-info mb-3" style="display:none;">
        <div class="wod-info__badge">ℹ️ Infos</div>
        <div id="wodDesc" class="wod-info__text"></div>
      </div>

        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pane-rx" type="button" role="tab">
              Rx
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pane-int" type="button" role="tab">
              Intermédiaire
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pane-scaled" type="button" role="tab">
              Scaled
            </button>
          </li>
        </ul>

        <div class="tab-content pt-3">
          <div class="tab-pane fade show active" id="pane-rx" role="tabpanel">
            <div id="wodRx" class="wod-box wod-box--rx"></div>
          </div>
          <div class="tab-pane fade" id="pane-int" role="tabpanel">
            <div id="wodInt" class="wod-box wod-box--int"></div>
          </div>
          <div class="tab-pane fade" id="pane-scaled" role="tabpanel">
            <div id="wodScaled" class="wod-box wod-box--scaled"></div>
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="pill-btn" data-bs-dismiss="modal">Fermer</button>
      </div>

    </div>
  </div>
</div>

<?php require __DIR__ . "/../includes/footer.php"; ?>