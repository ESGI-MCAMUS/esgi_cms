<div class="container">
  <!-- Section page d'accueil en full screen -->
  <section id="categorie-header"
    style="margin-top: 2.5%;">
    <div class="row middle"
      style="height: 500px; width: 100%; background-color: black;">
      <img src="../assets/images/books/<?= $_POST["book"][0]["image_header"] ?>"
        class="banner"
        alt="banner-contact"
        style="opacity: 60%;filter: blur(5px);" />
      <h1 class="texte blanc enorme middle"
        style="display: block;"><?= $_POST["book"][0]["title"] ?>
      </h1>
    </div>
  </section>
  <section id="books"
    style="padding: 5%;">
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <?= str_replace("\\", "", html_entity_decode($_POST["book"][0]["content"])) ?>
        <br>
        <br>
        <p class="text tres-petit noir">Tags :</p>
        <?php
        foreach (json_decode($_POST["book"][0]["keywords_json"]) as $key => $value) {
        ?>
        <div style="
        background-color: white; 
        border-radius: 5px; 
        padding: 5px; 
        display: inline-block;
        -webkit-box-shadow: 0px 0px 8px 0px rgba(0,0,0,.1);
    -moz-box-shadow: 0px 0px 8px 0px rgba(0,0,0,.1);
    box-shadow: 0px 0px 8px 0px rgba(0,0,0,.1);
        "><?= $value ?>
        </div>
        <?php
        }
        ?>
        <br><br>
        <p class="text tres-petit noir">Prix :</p>
        <div style="
        background-color: white; 
        border-radius: 5px; 
        padding: 5px; 
        display: inline-block;
        -webkit-box-shadow: 0px 0px 8px 0px rgba(0,0,0,.1);
    -moz-box-shadow: 0px 0px 8px 0px rgba(0,0,0,.1);
    box-shadow: 0px 0px 8px 0px rgba(0,0,0,.1);
        "><?= $_POST["book"][0]["price"] ?>€
        </div>
        <br>
        <br>
        <?php
        if (!isset($_POST['wishlist_choisi']) || !in_array($_POST['id'], $_POST['wishlist_choisi'])) {
        ?>
        <button id="bouton_wishlist_<?= $_POST['id'] ?>"
          class="bouton_wishlist bouton rouge"
          value="<?= $_POST['id'] ?>"><?= LANG["general"]["categories"]["wishlist"] ?></button>
        <?php } else { ?>
        <button class="bouton  rouge inverse"
          value="<?= $_POST['id'] ?>"><?= LANG["general"]["categories"]["wishlist_already"] ?></button>
        <?php } ?>
        <?php
        if (!isset($_POST['panier_choisi']) || !in_array($_POST['id'], $_POST['panier_choisi'])) {
        ?>
        <button id="bouton_basket_<?= $_POST['id'] ?>"
          class="bouton_basket bouton  vert"
          value="<?= $_POST['id'] ?>"><?= LANG["general"]["categories"]["basket"] ?>
          (<?= $_POST["book"][0]["price"] ?>€)</button>
        <?php } else { ?>
        <button class="bouton vert inverse"
          value="<?= $_POST['id'] ?>"><?= LANG["general"]["categories"]["basket_already"] ?></button>
        <?php } ?>
      </div>
      <div class="col-2"></div>
    </div>
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <div class="row">
          <?php
          if (isset($_SESSION["id"])) {
          ?>
          <form action="/user/comment"
            method="post">
            <input type="hidden"
              name="back"
              value="/book/<?= $_POST["id"] ?>">
            <input type="hidden"
              name="user"
              value="<?= $_SESSION["id"] ?>">
            <input type="hidden"
              name="book"
              value="<?= $_POST["id"] ?>">
            <div class="col-10">
              <input class="input bleu-clair tres-epais fluide"
                type="text"
                name="comment"
                id="comment"
                required
                placeholder="<?= LANG["general"]["book"]["comment_ph"] ?>">
            </div>
            <div class="col-2">
              <button class="bouton inverse info"><?= LANG["general"]["book"]["comment_button"] ?></button>
            </div>
          </form>
          <?php
          }
          ?>
        </div>
        <?php
        $left = true;
        foreach ($_POST["comments"] as $key => $value) {
          if ($left) {
        ?>
        <div class="row">
          <div class="col-8">
            <div class="segment bleu elevated info"
              style="box-sizing: border-box;overflow-wrap: break-word;">
              <p class="texte petit"
                style="word-wrap: break-word;">❝ <?= $value["comment"] ?> ❞</p>
              <br>
              <i>
                <p class="texte tres-petit right italique"><?= $value["userFirstname"] ?> <?= $value["userLastname"] ?>
                  (<?= substr($value["created_at"], 0, -3) ?>)
                </p>
              </i>
              <?php
                  if ($value["userId"] == $_SESSION["id"] || $_SESSION["role"] == 1) {
                  ?>

              <form class="inline-form bouton invisible"
                method="post"
                action="/admin/delete">
                <input type="hidden"
                  name="id"
                  value="<?= $value ?>" />
                <input type="hidden"
                  name="table"
                  value="comment" />
                <input type="hidden"
                  name="origin"
                  value="/book/<?= $_POST["book"][0]["id"] ?>" />
                <button title="Supprimer"
                  style="background-color: transparent; border: none; cursor: pointer;">🗑</button>
              </form>
              <?php
                  }
                  ?>
            </div>
          </div>
          <div class="col-4"></div>
        </div>
        <?php
          } else {
          ?>
        <div class="row">
          <div class="col-4"></div>
          <div class="col-8">
            <div class="segment bleu elevated info"
              style="overflow-wrap: break-word;">
              <p class="texte petit">❝ <?= $value["comment"] ?> ❞</p>
              <br>
              <i>
                <p class="texte tres-petit right italique"><?= $value["userFirstname"] ?> <?= $value["userLastname"] ?>
                  (<?= substr($value["created_at"], 0, -3) ?>)</p>
              </i>
              <?php
                  if ($value["userId"] == $_SESSION["id"] || $_SESSION["role"] == 1) {
                  ?>

              <form class="inline-form bouton invisible"
                method="post"
                action="/admin/delete">
                <input type="hidden"
                  name="id"
                  value="<?= $value ?>" />
                <input type="hidden"
                  name="table"
                  value="comment" />
                <input type="hidden"
                  name="origin"
                  value="/book/<?= $_POST["book"][0]["id"] ?>" />
                <button title="Supprimer"
                  style="background-color: transparent; border: none; cursor: pointer;">🗑</button>
              </form>
              <?php
                  }
                  ?>
            </div>
          </div>

        </div>
        <?php
          }
          $left = !$left;
        }
        ?>
      </div>
      <div class="col-2"></div>
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