<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title><?= LANG["general"]["website_title"] ?></title>
  <meta name="description"
    content="<?= LANG["general"]["website_description"] ?>">
  <link rel="icon"
    type="image/png"
    href="/assets/images/logo.png" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"
    href="/../assets/css/main.css">
  <link rel="stylesheet"
    href="/../assets/css/components/typographie/typographie.css">
  <link rel="stylesheet"
    href="/../assets/css/components/boutons/boutons.css">
  <link rel="stylesheet"
    href="/../assets/css/components/segments/segments.css">
  <link rel="stylesheet"
    href="/../assets/css/components/inputs/inputs.css">
  <link rel="stylesheet"
    href="/assets/css/components/header/header-main.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
</head>

<body>
  <section id="header">
    <div class="container">
      <div class="row"
        style="display: flex; align-items: center; justify-content: center;">
        <div class="col-3">
          <nav class="left">
            <a href="/"
              class="<?= $_SERVER['REQUEST_URI'] === '/' ? 'active' : '' ?>"><?= LANG["navigation"]["home"] ?></a>
            <i>•</i>
            <a href="/categories"
              class="<?= $_SERVER['REQUEST_URI'] === '/categories' ? 'active' : '' ?>"><?= LANG["navigation"]["browse"] ?></a>
          </nav>
        </div>
        <div class="col-4">
          <div class="formContainer center">
            <form method="POST"
              action="/search">
              <input class="input bleu-clair tres-epais fluide"
                type="text"
                name="search"
                id="searchbar"
                placeholder="<?= LANG["navigation"]["search"] ?>" />
              <button><i class="fas fa-search"></i></button>
            </form>
          </div>
        </div>
        <div class="col-5"
          style="display: flex; align-items: center; justify-content: center;">
          <?php
          // var_dump($_SESSION);
          if (isset($_SESSION["id"])) {
          ?>
          <div class="col-8"
            style="display: flex; align-items: center; justify-content: center;">
            <nav class="left">
              <a href="/utilisateur/wishlist"
                class=""><?= LANG["navigation"]["wishlist"] ?></a>
              <i>•</i>
              <a href="/utilisateur/order"
                class=""><?= LANG["navigation"]["order"] ?></a>
              <i>•</i>
              <a href="/utilisateur/panier"
                class=""><?= LANG["navigation"]["pannier"] ?></a>
            </nav>
          </div>
          <div class="right navImg"
            style="display: flex; justify-content: flex-end;">
            <a href="/<?php echo ((strcmp($_SESSION["id"], "0") == 0) ? 'utilisateur' : 'admin'); ?>"
              style="display: flex; align-items: center">
              <img src="/assets/images/user.webp" />
              <p class="texte epaisseur-moyen souligne-turquoise"
                style="margin-left: 10px;">
                <?php echo ucfirst($_SESSION['firstname']) . " " . substr(ucfirst($_SESSION['lastname']), 0, 1) . "." ?>
              </p>
            </a>
          </div>
          <?php
          } else {
          ?>
          <div class="right">
            <a href="/s-inscrire"
              class="petit texte souligne-turquoise"><?= LANG["navigation"]["signup"] ?></a>
            <a href="/se-connecter"
              class="petit texte souligne-turquoise"><?= LANG["navigation"]["signin"] ?></a>
          </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </section>

  <?php include $this->view ?>

  <section id="footer">
    <div class="row">
      <div class="col-3 center"></div>
      <div class="col-6 center">
        <p class="texte blanc petit">
          <?= LANG["general"]["copyright"] ?> - <?= LANG["general"]["website_title"] ?>
        </p>
      </div>
      <div class="col-3 center"></div>
    </div>
  </section>
</body>

</html>