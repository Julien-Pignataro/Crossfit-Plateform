<?php
$title = "Modifier compétition";

require __DIR__ . "/../../includes/header.php";
require __DIR__ . "/../../includes/db.php";
require __DIR__ . "/../../includes/admin_check.php";

$id = $_GET["id"] ?? null;

if (!$id) {
    die("Compétition introuvable");
}

// Récupérer compétition
$stmt = $pdo->prepare("SELECT * FROM competitions WHERE id = ?");
$stmt->execute([$id]);
$competition = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$competition) {
    die("Compétition introuvable");
}

$message = "";

// Traitement formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titleComp = $_POST["title"] ?? "";
    $date = $_POST["event_date"] ?? "";
    $city = $_POST["city"] ?? "";
    $wod_rx = $_POST["wod_rx"] ?? "";
    $wod_intermediate = $_POST["wod_intermediate"] ?? "";
    $wod_scaled = $_POST["wod_scaled"] ?? "";

    if ($titleComp && $date && $city) {

        $stmt = $pdo->prepare("
            UPDATE competitions
            SET title = ?, event_date = ?, city = ?
            wod_rx = ?, wod_intermediate = ?, wod_scaled = ?
            WHERE id = ?
        ");

       $stmt->execute([
            $titleComp,
            $date,
            $city,
            $wod_rx,
            $wod_intermediate,
            $wod_scaled,
            $id
         ]);

        $message = "✅ Compétition modifiée avec succès";

        // Recharger les données
        $competition["title"] = $titleComp;
        $competition["event_date"] = $date;
        $competition["city"] = $city;
    }
}
?>

<section class="hero hero-competitions">
  <div class="container-xxl hero__content">

    <h1 class="hero__title">Modifier compétition</h1>

    <div class="glass" style="max-width:700px;">

        <?php if ($message): ?>
            <div class="alert alert-success"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label>Titre</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       value="<?= htmlspecialchars($competition["title"]) ?>"
                       required>
            </div>

            <div class="mb-3">
                <label>Date</label>
                <input type="date"
                       name="event_date"
                       class="form-control"
                       value="<?= htmlspecialchars($competition["event_date"]) ?>"
                       required>
            </div>

            <div class="mb-3">
                <label>Ville</label>
                <input type="text"
                       name="city"
                       class="form-control"
                       value="<?= htmlspecialchars($competition["city"]) ?>"
                       required>
            </div>

            <div class="mb-3">
               <label>WOD RX</label>
               <textarea name="wod_rx" class="form-control" rows="3"><?= htmlspecialchars($competition["wod_rx"] ?? "") ?></textarea>
            </div>

            <div class="mb-3">
               <label>WOD Intermédiaire</label>
               <textarea name="wod_intermediate" class="form-control" rows="3"><?= htmlspecialchars($competition["wod_intermediate"] ?? "") ?></textarea>
            </div>

            <div class="mb-3">
               <label>WOD Scaled</label>
               <textarea name="wod_scaled" class="form-control" rows="3"><?= htmlspecialchars($competition["wod_scaled"] ?? "") ?></textarea>
            </div>

            <button class="pill-btn" type="submit">
                Enregistrer
            </button>

            <a class="pill-btn" href="/competitions.php">
                Retour
            </a>

        </form>

    </div>

  </div>
</section>

<?php require __DIR__ . "/../../includes/footer.php"; ?>