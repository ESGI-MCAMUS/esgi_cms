<div class="container">
  <!-- Section page d'accueil en full screen -->
  <section id="home">
    <div class="row middle fullheight">
      <img src=" assets/images/background.jpg"
        class="banner"
        alt="banner-home" />
      <div style="padding-top: 75px;">
        <div class="col-3"></div>
        <div class="col-6 center">
          <img class="website-logo"
            src="assets/images/logo.png"
            alt="logo-<?= LANG["general"]["website_title"] ?>">
          <h1 class="texte blanc en-majuscule enormissime"><?= LANG["general"]["website_title"] ?></h1>
          </br></br>
          <h2 class="texte petit blanc epaisseur-moyen"><?= LANG["general"]["website_description"] ?></h2>
          </br></br>
          <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
              <a class="bouton inverse arrondi info"
                href="#feature"><?= strtoupper(LANG["accueil"]["button_main"]) ?></a>
            </div>
            <div class="col-3"></div>
          </div>

        </div>
        <div class="col-3"></div>
      </div>
    </div>
  </section>

  <!-- Section fonctionnalités -->
  <section id="feature">
    <div class="row">
      <div class="col-3"></div>
      <div class="col-6 center">
        <h1 class="texte souligne-bleu"><?= LANG["accueil"]["feature_title"] ?> <?= LANG["general"]["website_title"] ?>
        </h1>
        </br>
        </br>
        <p><?= LANG["accueil"]["feature_desc"] ?></p>
      </div>
      <div class="col-3"></div>
    </div>
    <div style="padding-left:10%; padding-right:10%;">
      <div class="row">
        <div class="col-9"
          style="display: flex; flex-direction: row; align-items: center;">
          <lottie-player src="https://assets10.lottiefiles.com/private_files/lf30_ed0cbs0y.json"
            background="transparent"
            speed="1"
            style="width: 200px; height: 200px;"
            loop
            autoplay></lottie-player>
          <p class="texte epaisseur-gras"><?= LANG["accueil"]["feature1"] ?></p>
        </div>
        <div class="col-3"></div>
      </div>
      <div class="row">
        <div class="col-3"></div>
        <div class="col-9"
          style="display: flex; flex-direction: row-reverse; align-items: center;">
          <lottie-player src="https://assets1.lottiefiles.com/temp/lf20_W5bxHx.json"
            background="transparent"
            speed="1"
            style="width: 200px; height: 200px;"
            loop
            autoplay></lottie-player>
          <p class="texte epaisseur-gras"><?= LANG["accueil"]["feature2"] ?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-9"
          style="display: flex; flex-direction: row; align-items: center;">
          <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_g3ki3g0v.json"
            background="transparent"
            speed="0.5"
            style="width: 200px; height: 200px;"
            loop
            autoplay></lottie-player>
          <p class="texte epaisseur-gras"><?= LANG["accueil"]["feature3"] ?></p>
        </div>
        <div class="col-3"></div>
      </div>
    </div>
  </section>

  <!-- Section contactez-nous -->
  <section id="contact">
    <div class="row middle">
      <img src="assets/images/contact.jpg"
        class="banner"
        alt="banner-contact" />
      <div class="col-4"></div>
      <div class="col-4 center breath">
        <h1 class="texte blanc tres-gros souligne-bleu"><?= LANG["accueil"]["contact"] ?></h1>
        </br></br>
        <p class="texte blanc"><?= LANG["accueil"]["contact_hint"] ?></p>
        </br>
        </br>
        <form action=""
          method="post">
          <input type="text"
            class="input tres-epais fluide bleu"
            name="fullname"
            placeholder="<?= LANG["accueil"]["fullname"] ?>">
          </br>
          </br>
          <input type="email"
            class="input tres-epais fluide bleu"
            name="email"
            placeholder="<?= LANG["accueil"]["email"] ?>">
          </br>
          </br>
          <textarea name="message"
            id=""
            cols="30"
            rows="10"
            class="input tres-epais fluide bleu"
            style="resize: none;"
            placeholder="<?= LANG["accueil"]["message"] ?>"></textarea>
          </br></br>
          <button class="bouton inverse arrondi turquoise-fonce"
            type="submit"><?= LANG["accueil"]["btn_submit"] ?></button>
        </form>

      </div>
      <div class="col-4"></div>
    </div>
  </section>
</div>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>