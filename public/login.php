<?php $title="Connexion"; require __DIR__."/../includes/header.php"; ?>

<section class="hero hero-login">

<section class="hero">
  <div class="container-xxl hero__content">
    <h1 class="hero__title" style="text-align:left;">Connexion</h1>

    <div class="glass" style="max-width:780px;">
      <form>
        <div class="mb-4">
          <label class="form-label">Adresse mail :</label>
          <input type="email" class="form-control form-control-lg" placeholder="ex: julien@mail.com">
        </div>
        <div class="mb-4">
          <label class="form-label">Mot de passe :</label>
          <input type="password" class="form-control form-control-lg">
        </div>

        <div class="d-flex gap-3 justify-content-center mt-4">
          <button class="pill-btn" type="submit">Connexion</button>
          <a class="pill-btn" href="#">Créer un compte</a>
        </div>
      </form>
    </div>

  </div>
</section>


<?php require __DIR__."/../includes/footer.php"; ?>