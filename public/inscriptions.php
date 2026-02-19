<?php
$title = "Inscriptions";

require __DIR__ . "/../includes/header.php";
require __DIR__ . "/../includes/db.php";

$competition_id = $_GET["competition_id"] ?? null;
$message = "";

/*
|--------------------------------------------------------------------------
| TRAITEMENT FORMULAIRE
|--------------------------------------------------------------------------
*/
if ($_SERVER["REQUEST_METHOD"] === "POST" && $competition_id) {

    if (!isset($_SESSION["user"])) {
        header("Location: /login.php");
        exit;
    }

    $user_id = $_SESSION["user"]["id"];

    $firstname = $_POST["firstname"] ?? "";
    $lastname  = $_POST["lastname"] ?? "";
    $category  = $_POST["category"] ?? "";

    $stmt = $pdo->prepare("
        INSERT INTO inscriptions (user_id, competition_id, firstname, lastname, category)
        VALUES (?, ?, ?, ?, ?)
    ");

    try {
        $stmt->execute([
            $user_id,
            $competition_id,
            $firstname,
            $lastname,
            $category
        ]);

        header("Location: /competitions.php?msg=inscription_ok");
        exit;

    } catch (Exception $e) {
        $message = "⚠️ Vous êtes déjà inscrit.";
    }
}
?>

<section class="hero hero-inscriptions">
  <div class="container-xxl hero__content">

<?php if ($competition_id): ?>

    <!-- =============================
         FORMULAIRE INSCRIPTION COMPETITION
    ============================== -->

    <h1 class="hero__title">Inscription à la compétition</h1>

    <div class="glass" style="max-width:600px;">

        <?php if ($message): ?>
            <div class="alert alert-warning"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label>Nom</label>
                <input type="text" name="lastname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Prénom</label>
                <input type="text" name="firstname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Nom d'équipe</label>
                <input type="text" name="firstname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Adresse mail</label>
                <input type="text" name="firstname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Catégorie</label>
                <select name="category" class="form-control" required>
                    <option value="">Choisir...</option>
                    <option value="Rx">Rx</option>
                    <option value="Intermédiaire">Intermédiaire</option>
                    <option value="Scaled">Scaled</option>
                </select>
            </div>

            <button class="pill-btn" type="submit">
                Valider l'inscription
            </button>

        </form>

    </div>

<?php else: ?>

    <!-- =============================
         PAGE INSCRIPTIONS GENERALE (MENU)
    ============================== -->

    <h1 class="hero__title">Inscriptions</h1>

    <div class="glass" style="max-width:700px; text-align:center;">

        <p style="font-size:18px;">
            Vous souhaitez participer à une compétition ?
        </p>

        <p>
            Rendez-vous sur la page compétitions pour vous inscrire à un événement.
        </p>

        <a class="pill-btn" href="/competitions.php">
            Voir les compétitions
        </a>

    </div>

<?php endif; ?>

  </div>
</section>

<?php require __DIR__ . "/../includes/footer.php"; ?>