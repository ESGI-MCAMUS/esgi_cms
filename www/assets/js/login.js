$(document).ready(() => {
  //console.log($('#json_cache').text());

  $.getJSON("assets/json/lang.json")
    .done(function (data) {
      //on traite les possibles erreurs lors de la tentative de connexion et on remet si besoin les champs
      let json_retour = JSON.parse($("#json_cache").text());
      if (json_retour !== null && json_retour.length != 0) {
        let json_erreurs = json_retour.errors;
        if (json_erreurs != undefined) {
          let cpt = 1;
          json_erreurs.forEach((e) => {
            $("#ligne_erreur").append(
              '<div class="row"><p id="erreur_' +
                cpt +
                '" class="petit aide texte rouge">' +
                data.connexion[e] +
                "</p></div>"
            );
            if (e === "wrong_credentials" || e === "empty_fields") {
              $("#email").removeClass("bleu-clair").addClass("rouge-clair");
              $("#pwd1").removeClass("bleu-clair").addClass("rouge-clair");
            }
          });

          for (const key in json_retour) {
            if (key !== "errors") {
              $("#" + key).val(json_retour[key]);
            }
          }
        }
      }
    })
    .fail(function (textStatus) {
      /*console.log("Impossible de charger le dico des erreurs");*/
    });

  $("#bouton_connexion").on("click", () => {
    let est_rempli = true;

    let id_balises_inscriptions = ["email", "pwd1"];

    id_balises_inscriptions.forEach((e) => {
      if ($("#" + e).val() == "") {
        //console.log(e + " vide");
        $("#" + e)
          .removeClass("bleu-clair")
          .addClass("rouge-clair");
        est_rempli = false;
      } else {
        $("#" + e)
          .removeClass("rouge-clair")
          .addClass("bleu-clair");
      }
    });

    if (!est_rempli) {
      //console.log("des champs ne sont pas remplis");
    } else {
      //console.log("on peut s'inscrire");

      $("#formulaire_inscription").submit();
    }
  });
});
