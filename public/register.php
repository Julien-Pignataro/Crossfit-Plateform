<?php
$title = "Inscription";

require __DIR__ . "/../includes/header.php";
require __DIR__ . "/../includes/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    if ($email && $password) {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("
            INSERT INTO users (email, password)
            VALUES (?, ?)
        ");

        try {
            $stmt->execute([$email, $hash]);
            $message = "✅ Compte créé ! Vous pouvez vous connecter.";
        } catch (Exception $e) {
            $message = "❌ Email déjà utilisé.";
        }

    } else {
        $message = "❌ Merci de remplir tous les champs.";
    }
}
?>

<section class="hero hero-login">
  <div class="container-xxl hero__content">

    <h1 class="hero__title">Créer un compte</h1>

    <div class="glass" style="max-width:600px;">

        <?php if ($message): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button class="pill-btn" type="submit">
                Créer un compte
            </button>

        </form>

    </div>

  </div>
</section>

<?php require __DIR__ . "/../includes/footer.php"; ?>