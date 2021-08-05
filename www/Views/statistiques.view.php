<script src="assets/js/dashboard.js"></script>
<section id="backoffice-container">

  <br />
  <p class="texte miette-de-pain tres-petit" id="breadcrumb"><i class="fas fa-home"></i>/Admin/Statistiques</p>

  <!-- ligne stats categories -->
  <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
      <div class="segment elevated info center">
        <div class="row">
          <div class="col-6">
            <div class="row">
              <h1 class="texte normal epaisseur-gras en-majuscule">Statistiques generales sur les
                categories</h1>
            </div>
            <br>
            <br>
            <div class="row">
              <div class="col-12">
                <div class="row">
                  <h1 id="valeur-categories" class="texte gros epaisseur-gras"></h1>
                </div>
                <div class="row">
                  <h1 class="texte moyen epaisseur-gras">Categories</h1>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <canvas id="chartCategories"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-1"></div>
  </div>

  <!-- ligne stats categories -->
  <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
      <div class="segment elevated info center">
        <div class="row">
          <div class="col-6">
            <div class="row">
              <h1 class="texte normal epaisseur-gras en-majuscule">Statistiques generales sur les
                livres</h1>
            </div>
            <br>
            <br>
            <div class="row">
              <div class="col-6">
                <div class="row">
                  <h1 id="valeur-livres" class="texte gros epaisseur-gras"></h1>
                </div>
                <div class="row">
                  <h1 class="texte moyen epaisseur-gras">Livres</h1>
                </div>
              </div>
              <div class="col-6">
                <div class="row">
                  <h1 id="valeur-livres-semaine" class="texte gros epaisseur-gras"></h1>
                </div>
                <div class="row">
                  <h1 class="texte moyen epaisseur-gras">Livres vendus cette semaine</h1>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class='row'>
              <br>
              <br>
              <h1 id="valeur-livres-semaine-vente" class="texte gros epaisseur-gras"></h1>
            </div>
            <br>
            <br>
            <br>
            <div class='row'>
              <h1 class="texte moyen epaisseur-gras">Recettes des ventes de cette semaine</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-1"></div>
  </div>

  <!-- ligne stats utilisateur -->
  <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
      <div class="segment elevated info center">
        <div class="row">
          <div class="col-6">
            <div class="row">
              <h1 class="texte normal epaisseur-gras en-majuscule">Statistiques generales sur les
                utilisateurs</h1>
            </div>
            <br>
            <br>
            <div class="row">
              <div class="col-6">
                <div class="row">
                  <h1 id="valeur-utlisateurs" class="texte gros epaisseur-gras"></h1>
                </div>
                <div class="row">
                  <h1 class="texte moyen epaisseur-gras">Utilisateurs</h1>
                </div>
              </div>
              <div class="col-6">
                <div class="row">
                  <h1 id="valeur-utilisateurs-qutotidien" class="texte gros epaisseur-gras"></h1>
                </div>
                <div class="row">
                  <h1 class="texte moyen epaisseur-gras">Nouveaux utilisateurs</h1>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class='row'>
              <br>
              <br>
              <h1 id="valeur-panier-moyen" class="texte gros epaisseur-gras"></h1>
            </div>
            <br>
            <br>
            <br>
            <div class='row'>
              <h1 class="texte moyen epaisseur-gras">Prix moyen des commandes des utilisateurs</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-1"></div>
  </div>

</section>