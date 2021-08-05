<div class="middle fullheight">
  <div class="container">
    <?php
    if (isset($_POST['est_active']) && $_POST['est_active']) {
    ?>
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4 center">
          <div class="segment <?php echo $_POST['div']; ?> elevated">
            <h3 class="texte <?php echo $_POST['couleur']; ?>"><?= LANG["inscription"][$_POST['message']]; ?></h3>
          </div>
        </div>
        <div class="col-4"></div>
      </div>
      <br />
    <?php
    }
    ?>
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4 center">
        <div class="segment turquoise elevated info">
          <h1 class="texte souligne-turquoise">Réinitialisation du mot de passe</h1>
          <br />
          <br />
          <br />
          <form id="formulaire_reset" method="POST" action="/update-pwd">
            <div class="row">
              <div class="col-12">
                <input class="input turquoise-clair fluide focus_element" placeholder="<?= LANG["inscription"]["password"] ?>" type="password" id="pwd1" name="pwd1">
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-12">
                <input class="input turquoise-clair fluide focus_element" placeholder="<?= LANG["inscription"]["passwordConfirm"] ?>" type="password" id="pwd2" name="pwd2" require>
              </div>
            </div>
            <br /><br />
            <div class="row">
              <input id="bouton_reset" class="bouton turquoise-clair arrondi inverse" type="button" value="Changer le mot de passe">
              <input type="text" id="clef" name="clef" value="<?= $_POST['id'] ?>" hidden>
              <!-- bouton rouge inverse info arrondi -->
            </div>
            <div id="ligne_erreur" class="row">
            </div>
            <?php if (!isset($_POST['est_active'])) { ?>
              <div hidden>
                <p id="json_cache"><?php echo json_encode($_POST); ?></p>
              </div>
            <?php } ?>
          </form>
        </div>
      </div>
      <div class="col-4"></div>
    </div>
  </div>
</div>
<script src="../assets/js/reset.js"></script>