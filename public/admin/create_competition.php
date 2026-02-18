<?php
$title = "Créer compétition";

require __DIR__ . "/../../includes/header.php";
require __DIR__ . "/../../includes/db.php";

$message = "";

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titleComp = $_POST["title"] ?? "";
    $date = $_POST["event_date"] ?? "";
    $city = $_POST["city"] ?? "";
    $description = $_POST["description"] ?? "";
    $box_id = $_POST["box_id"] ?? "";

    if ($titleComp && $date && $city && $box_id) {

        $stmt = $pdo->prepare("
            INSERT INTO competitions (title, event_date, city, description, box_id)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $titleComp,
            $date,
            $city,
            $description,
            $box_id
        ]);

        $message = "✅ Compétition ajoutée avec succès !";

    } else {
        $message = "❌ Merci de remplir les champs obligatoires.";
    }
}

// Récupérer les box pour la liste déroulante
$boxes = $pdo->query("SELECT * FROM boxes")->fetchAll();
?>

<section class="hero hero-competitions">
  <div class="container-xxl hero__content">

    <h1 class="hero__title">Créer une compétition</h1>

    <div class="glass" style="max-width:700px;">

        <?php if ($message): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label>Titre *</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Date *</label>
                <input type="date" name="event_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Ville *</label>
                <input type="text" name="city" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Box *</label>
                <select name="box_id" class="form-control" required>
                    <option value="">Choisir une box</option>
                    <?php foreach ($boxes as $box): ?>
                        <option value="<?= $box["id"] ?>">
                            <?= htmlspecialchars($box["name"]) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button class="pill-btn" type="submit">
                Ajouter compétition
            </button>

        </form>

    </div>

  </div>
</section>

<?php require __DIR__ . "/../../includes/footer.php"; ?>