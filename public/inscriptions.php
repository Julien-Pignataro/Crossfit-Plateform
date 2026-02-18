<?php $title="Inscriptions"; require __DIR__."/../includes/header.php"; ?>

<section class="hero hero-inscriptions">

<section class="hero">
  <div class="container-xxl hero__content">
    <h1 class="hero__title">Inscriptions<br>athlète / spectateur</h1>

    <div class="row g-5 mt-2">
      <div class="col-lg-6">
        <div class="glass">
          <h2 class="text-center mb-4">Formulaire d’inscription :</h2>
          <form>
            <div class="mb-3"><label class="form-label">Nom d’équipe :</label><input class="form-control"></div>
            <div class="mb-3"><label class="form-label">Compétition :</label><input class="form-control"></div>
            <div class="mb-3"><label class="form-label">Niveau / catégorie :</label><input class="form-control"></div>
            <div class="mb-3"><label class="form-label">Adresse mail :</label><input type="email" class="form-control"></div>
            <div class="text-center mt-4"><button class="pill-btn" type="submit">Inscription</button></div>
          </form>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="glass">
          <h2 class="text-center mb-4">Formulaire de réservation :</h2>
          <form>
            <div class="mb-3"><label class="form-label">Adresse mail :</label><input type="email" class="form-control"></div>
            <div class="mb-3"><label class="form-label">Nombre de place :</label><input type="number" class="form-control"></div>
            <div class="mb-3"><label class="form-label">Nom, Prénom :</label><input class="form-control"></div>
            <div class="text-center mt-4"><button class="pill-btn" type="submit">Réservation</button></div>
          </form>
        </div>
      </div>
    </div>

  </div>
</section>


<?php require __DIR__."/../includes/footer.php"; ?>