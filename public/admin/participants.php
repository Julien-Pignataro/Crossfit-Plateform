<?php
$title = "Participants";

require __DIR__ . "/../../includes/header.php";
require __DIR__ . "/../../includes/db.php";
require __DIR__ . "/../../includes/admin_check.php";

$competition_id = $_GET["competition_id"] ?? null;

if (!$competition_id || !is_numeric($competition_id)) {
    die("Compétition introuvable");
}


// Récupérer infos compétition
$stmt = $pdo->prepare("SELECT * FROM competitions WHERE id = ?");
$stmt->execute([$competition_id]);
$competition = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$competition) {
    die("Compétition introuvable");
}

// Récupérer participants
$stmt = $pdo->prepare("
    SELECT u.email, i.created_at
    FROM inscriptions i
    JOIN users u ON u.id = i.user_id
    WHERE i.competition_id = ?
");
$stmt->execute([$competition_id]);
$participants = $stmt->fetchAll();
?>

<section class="hero hero-competitions">
  <div class="container-xxl hero__content">

    <h1 class="hero__title">
        Participants — <?= htmlspecialchars($competition["title"]) ?>
    </h1>

    <div class="glass" style="max-width:800px;">

        <?php if (empty($participants)): ?>

            <p>Aucun participant pour le moment.</p>

        <?php else: ?>

            <table class="table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Date inscription</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach ($participants as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p["email"]) ?></td>
                        <td><?= date("d/m/Y H:i", strtotime($p["created_at"])) ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>

        <?php endif; ?>

        <a class="pill-btn mt-3" href="/competitions.php">
            Retour
        </a>

    </div>

  </div>
</section>

<?php require __DIR__ . "/../../includes/footer.php"; ?>