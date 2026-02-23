<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function escapeHtml(str){
  return String(str).replace(/[&<>"']/g, (m) => ({
    "&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#039;"
  }[m]));
}

function renderWodList(containerId, text){
  const el = document.getElementById(containerId);
  const safe = escapeHtml(text || "");
  const lines = safe
    .split(/\r?\n/)
    .map(l => l.trim())
    .filter(l => l.length);

  if (!lines.length){
    el.innerHTML = "<div class='wod-empty'>WOD non défini</div>";
    return;
  }

  el.innerHTML = "<ul class='wod-list'>" + lines.map(l => `<li>${l}</li>`).join("") + "</ul>";
}

document.addEventListener("click", function(e){
  const btn = e.target.closest("[data-bs-target='#wodModal']");
  if(!btn) return;

  document.getElementById("wodModalTitle").textContent =
    "Fiche WOD — " + (btn.dataset.title || "");

  renderWodList("wodRx", btn.dataset.wodRx);
  renderWodList("wodInt", btn.dataset.wodInt);
  renderWodList("wodScaled", btn.dataset.wodScaled);
});
</script>

</main>

<footer class="footer">
  <div class="container-xxl footer__inner">
    <div class="footer__col">
      <div>Mentions légales</div>
      <div>Données personnelles</div>
      <div>Accessibilité</div>
      <div>Cookies</div>
    </div>

    <div class="footer__col footer__center">
      <div>88 rue Dupont</div>
      <div>33000 BORDEAUX</div>
      <div>FRANCE</div>
      <div>06 01 02 04 05</div>
    </div>

    <div class="footer__social">
      <a href="#" class="social-icon"><i class="fa-brands fa-x-twitter"></i></a>
    <a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
    <a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
    </div>
  </div>

  <div class="footer__copyright">Copyright 2026</div>
</footer>

<script src="/assets/js/main.js"></script>
</body>
</html>