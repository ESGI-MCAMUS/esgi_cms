<div class="middle fullheight">
  <div class="container">
    <?php
    if (isset($_POST['est_active']) && $_POST['est_active']) {
    ?>
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4 center">
          <div class="segment <?php echo $_POST['div']; ?> elevated">
            <h3 class="texte <?php echo $_POST['couleur']; ?>"><?php echo $_POST['message']; ?></h3>
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
        <div class="segment avertissement elevated info">
          <h1 class="texte souligne-jaune">Mot de passe oublié</h1>
          <br />
          <br />
          <br />
          <form id="formulaire_reset" method="POST" action="/forgotten">
            <div class="row">
              <div class="col-12">
                <input class="input jaune fluide" placeholder="<?= LANG["inscription"]["email"] ?>" type="mail" id="email" name="email">
              </div>
            </div>
            <br />
            <div class="row">
              <input id="bouton_reset" class="bouton avertissement arrondi inverse" type="button" value="Réinitialiser mon mot de passe">
              <input class="bouton avertissement arrondi inverse" type="button" value="Réinitialiser mon mot de passe" hidden>
            </div>
            <br />
            <div class="row">
              <a href="/se-connecter" id="mdp_oubli" class="tres-petit texte souligne-turquoise">Je me rappel de mon mot de passe</a>
            </div>
            <div class="row">
              <a href="/s-inscrire" class="tres-petit texte souligne-bleu italic"><?= LANG["connexion"]["no_account"] ?></a>
            </div>
            <br />
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
<script src="../assets/js/forgotten.js"></script>