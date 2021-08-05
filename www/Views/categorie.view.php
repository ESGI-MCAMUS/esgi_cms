<div class="container">
  <!-- Section page d'accueil en full screen -->
  <section id="categorie-header" style="margin-top: 2.5%;">

    <div class="row middle" style="height: 400px; width: 100%; background-color: black;">
      <img src="../assets/images/categories/<?= $_POST["categorie"][0]["image"] ?>" class="banner" alt="banner-contact" style="opacity: 60%;filter: blur(5px);" />
      <div>
        <div class="col-2"></div>
        <div class="col-8">
          <h1 class="texte blanc enorme middle"><?= $_POST["categorie"][0]["name"] ?></h1>
          <br>
          <p class="texte petit blanc"><?= $_POST["categorie"][0]["description"] ?></p>
        </div>
        <div class="col-2"></div>
      </div>
    </div>
  </section>
  <section id="books" style="padding: 5%;">
    <div class="row">
      <?php
      foreach ($_POST["books"] as $key => $value) {
      ?>
        <div class="col-4">
          <div class="segment bleu elevated info">
            <img src="../assets/images/books/<?= $value["image_header"] ?>" alt="<?= $value["name"] ?>-banner" style="width: 100%; height: 200px; border-radius: 10px; object-fit:cover">
            <h1 class="texte normal middle" style="text-align: center;"><?= $value["title"] ?></h1>
            <p class="texte petit middle"><?= substr(strip_tags(html_entity_decode($value["content"])), 0, 100) . "..." ?>
            </p>
            <a href="/author/<?= $value["authorId"] ?>" class="texte souligne-bleu "><?= $value["authorFirstname"] ?>
              <?= $value["authorLastname"] ?></a>
            <form action="" method="post">
              <input type="hidden" name="id" value="<?= $value["id"] ?>">
              <button class="bouton fluide info" type="button" onclick="window.location.href='http://<?= $_SERVER['SERVER_NAME'] ?>:<?= $_SERVER['SERVER_PORT'] ?>/book/<?= $value['id'] ?>'"><?= LANG["general"]["categories"]["more"] ?></button>
            </form>
            <?php
            if (!isset($_POST['wishlist_choisi']) || !in_array($value['id'], $_POST['wishlist_choisi'])) {
            ?>
              <button id="bouton_wishlist_<?= $value["id"] ?>" class="bouton_wishlist bouton fluide rouge" value="<?= $value["id"] ?>"><?= LANG["general"]["categories"]["wishlist"] ?></button>
            <?php } else { ?>
              <button class="bouton fluide rouge inverse" value="<?= $value["id"] ?>"><?= LANG["general"]["categories"]["wishlist_already"] ?></button>
            <?php } ?>
            <?php
            if (!isset($_POST['panier_choisi']) || !in_array($value['id'], $_POST['panier_choisi'])) {
            ?>
              <button id="bouton_basket_<?= $value["id"] ?>" class="bouton_basket bouton fluide vert" value="<?= $value["id"] ?>"><?= LANG["general"]["categories"]["basket"] ?> (<?= $value['price'] ?>€)</button>
            <?php } else { ?>
              <button class="bouton fluide vert inverse" value="<?= $value["id"] ?>"><?= LANG["general"]["categories"]["basket_already"] ?></button>
            <?php } ?>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </section>
</div>
<script>
  $(document).ready(() => {
    console.log("coucou");

    $(".bouton_wishlist").on("click", function() {
      console.log($(this).val());
      let id_bouton = $(this)[0].id;

      $.ajax({
        method: "POST",
        url: "<?= URLSITE ?>/search/wishlist/add",
        data: {
          id_livre_ajout: $(this).val(),
        },
      }).done(function(data) {
        // alert("Data Saved: " + msg);
        let json = JSON.parse(data);
        console.log(json);

        if (json.success) {
          $("#" + id_bouton).addClass('inverse');
          $("#" + id_bouton).text('Livre ajouté à la liste de souhaits');
          $("#" + id_bouton).attr('disabled', true)
        }
      });
    });

    $(".bouton_basket").on("click", function() {
      console.log($(this).val());
      let id_bouton = $(this)[0].id;

      $.ajax({
        method: "POST",
        url: "<?= URLSITE ?>/search/basket/add",
        data: {
          id_livre_ajout: $(this).val(),
        },
      }).done(function(data) {
        // alert("Data Saved: " + msg);
        let json = JSON.parse(data);
        console.log(json);

        if (json.success) {
          $("#" + id_bouton).addClass('inverse');
          $("#" + id_bouton).text('Livre ajouté au panier');
          $("#" + id_bouton).attr('disabled', true)
        }
      });
    });
  });
</script>