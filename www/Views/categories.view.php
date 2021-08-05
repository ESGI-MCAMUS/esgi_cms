<div class="container">
  <!-- Section page d'accueil en full screen -->
  <section id="categories-container"
    style="margin: 7%;">
    <div class="row">
      <?php
      foreach ($_POST["categories"] as $key => $value) {
      ?>

      <div class="col-4">
        <a href="/categorie/<?= $value["id"] ?>">
          <div class="segment bleu elevated info"
            style="height: 350px;">
            <img src="assets/images/categories/<?= $value["image"] ?>"
              alt="<?= $value["name"] ?>-banner"
              style="width: 100%; height: 200px; border-radius: 10px; object-fit:cover"">
            <h1 class="
              texte
              normal
              middle"
              style="text-align: center;"><?= $value["name"] ?></h1>
            <p class="texte petit middle"><?= $value["shortDescription"] ?></p>
          </div>
        </a>
      </div>

      <?php
      }

      ?>
    </div>
  </section>
</div>