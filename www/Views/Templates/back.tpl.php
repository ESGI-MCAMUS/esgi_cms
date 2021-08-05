<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title><?= LANG["general"]["website_title"] ?> - <?= LANG["general"]["backoffice_title"] ?></title>
  <link rel="icon"
    type="image/png"
    href="/assets/images/logo.png" />
  <meta name="description"
    content="description de la page de back">
  <link rel="stylesheet"
    href="/assets/css/main.css">
  <link rel="stylesheet"
    href="/assets/css/components/typographie/typographie.css">
  <link rel="stylesheet"
    href="/assets/css/components/boutons/boutons.css">
  <link rel="stylesheet"
    href="/assets/css/components/segments/segments.css">
  <link rel="stylesheet"
    href="/assets/css/components/inputs/inputs.css">
  <link rel="stylesheet"
    href="/assets/css/components/tables/table.css">
  <link rel="stylesheet"
    href="/assets/css/components/header/header-dashboard.css">
  <script src="https://kit.fontawesome.com/0b6e0cf598.js"
    crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
    integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
    crossorigin="anonymous"></script>
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css"
    integrity="sha512-C7hOmCgGzihKXzyPU/z4nv97W0d9bv4ALuuEbSf6hm93myico9qa0hv4dODThvCsqQUmKmLcJmlpRmCaApr83g=="
    crossorigin="anonymous" />

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
  <script src="/assets/js/back.js"></script>
</head>

<body>
  <section id="header">
    <div class="navImg center">
      <img src="/assets/images/user.webp" />
    </div>
    </br>
    <div class="center">
      <h1 class="texte petit epaisseur-normal">
        <?= LANG["admin"]["hello"] ?> <span
          class="texte epaisseur-gras"><?php echo ucfirst($_SESSION['firstname']) . " " . ucfirst($_SESSION['lastname']) ?></span>
        !
      </h1>
    </div>
    <nav>
      <div class="divider"></div>
      <a href="/utilisateur"
        class="<?= $_SERVER['REQUEST_URI'] === '/utilisateur' ? 'active' : '' ?>"><i class="fas fa-chart-pie"></i>
        <?= LANG["navigation"]["profile"] ?></a>
      <div class="divider"></div>
      <a href="/utilisateur/order"
        class="<?= $_SERVER['REQUEST_URI'] === '/utilisateur/order' ? 'active' : '' ?>"><i class="fas fa-bookmark"></i>
        <?= LANG["navigation"]["orders"] ?></a>
      <div class="divider"></div>
      <a href="/utilisateur/panier"
        class="<?= $_SERVER['REQUEST_URI'] === '/utilisateur/panier' ? 'active' : '' ?>"><i class="fas fa-book"></i>
        <?= LANG["navigation"]["basket"] ?></a>
      <div class="divider"></div>
      <a href="/utilisateur/wishlist"
        class="<?= $_SERVER['REQUEST_URI'] === '/utilisateur/wishlist' ? 'active' : '' ?>"><i
          class="fas fa-feather"></i> <?= LANG["navigation"]["wish_list"] ?></a>
      <div class="divider"></div>
      <?php
      if (strcmp($_SESSION["role"], "1") == 0) {
      ?>
      <div class="divider"></div>
      <a href="/admin"
        class="<?= $_SERVER['REQUEST_URI'] === '/admin' ? 'active' : '' ?>"><i class="fas fa-chart-pie"></i>
        <?= LANG["navigation"]["stats"] ?></a>
      <div class="divider"></div>
      <a href="/admin/categories"
        class="<?= $_SERVER['REQUEST_URI'] === '/admin/categories' ? 'active' : '' ?>"><i class="fas fa-bookmark"></i>
        <?= LANG["navigation"]["categories"] ?></a>
      <div class="divider"></div>
      <a href="/admin/books"
        class="<?= $_SERVER['REQUEST_URI'] === '/admin/books' ? 'active' : $_SERVER['REQUEST_URI'] === '/admin/books' ? 'active' : '' ?>"><i
          class="fas fa-book"></i> <?= LANG["navigation"]["books"] ?></a>
      <div class="divider"></div>
      <a href="/admin/authors"
        class="<?= $_SERVER['REQUEST_URI'] === '/admin/authors' ? 'active' : '' ?>"><i class="fas fa-feather"></i>
        <?= LANG["navigation"]["authors"] ?></a>
      <div class="divider"></div>
      <a href="/admin/users"
        class="<?= $_SERVER['REQUEST_URI'] === '/admin/users' ? 'active' : '' ?>"><i class="fas fa-users"></i>
        <?= LANG["navigation"]["users"] ?></a>
      <div class="divider"></div>
      <a href="/admin/lang"
        class="<?= $_SERVER['REQUEST_URI'] === '/admin/lang' ? 'active' : '' ?>"><i class="fas fa-language"></i>
        <?= LANG["navigation"]["lang"] ?></a>
      <?php
      }
      ?>
    </nav>

    <div class="bottomButtons center">
      <button class="bouton petit noir texte majuscule souligne"
        id="back-to-index"><?= LANG["admin"]["back"] ?></button>
      <button class="bouton rouge-clair majuscule inverse arrondi"
        id="disconnect-btn"><?= LANG["navigation"]["logout"] ?></button>
    </div>
  </section>

  <section id="header-mobile">
    <nav>
      <a href="/admin"
        class="texte minuscule <?= $_SERVER['REQUEST_URI'] === '/admin' ? 'active' : '' ?>"><?= LANG["navigation"]["stats"] ?></a>
      <i>•</i>
      <a href="/admin/categories"
        class="texte minuscule <?= $_SERVER['REQUEST_URI'] === '/admin/categories' ? 'active' : '' ?>"><?= LANG["navigation"]["categories"] ?></a>
      <i>•</i>
      <a href="/admin/books"
        class="texte minuscule <?= $_SERVER['REQUEST_URI'] === '/admin/books' ? 'active' : $_SERVER['REQUEST_URI'] === '/admin/books' ? 'active' : '' ?>"><?= LANG["navigation"]["books"] ?></a>
      <i>•</i>
      <a href="#"
        class="texte minuscule"><?= LANG["navigation"]["authors"] ?></a>
      <i>•</i>
      <a href="/admin/users"
        class="texte minuscule <?= $_SERVER['REQUEST_URI'] === '/admin/users' ? 'active' : '' ?>"><?= LANG["navigation"]["users"] ?></a>
    </nav>

    <div class="navImg">
      <img src="/assets/images/user.webp" />
    </div>
  </section>
  <!-- afficher la vue -->
  <?php include $this->view ?>

</body>

</html>