$(document).ready(() => {
  console.log($("#json_cache").text());
  //   let json_retour = JSON.parse($("#json_cache").text());
  //   if (json_retour !== null && json_retour.length != 0) {
  let tableau_reference = [];

  let etat_supression = 0;

  $.getJSON("assets/json/lang.json")
    .done(function (data) {
      //on traite les possibles erreurs lors de la tentative de connexion et on remet si besoin les champs
      let json_retour = JSON.parse($("#json_cache").text());
      if (json_retour !== null && json_retour.length != 0) {
        if (json_retour.errors !== undefined) {
          let json_erreurs = json_retour.errors;
          let cpt = 1;
          json_erreurs.forEach((e) => {
            $("#ligne_erreur").append(
              '<div class="row"><p id="erreur_' +
                cpt +
                '" class="petit aide texte rouge">' +
                data.inscription[e] +
                "</p></div>"
            );
          });
        }

        // for (const key in json_retour) {
        //   if (key !== "errors") {
        //     $("#" + key).val(json_retour[key]);
        //   }
        // }

        if (json_retour !== null && json_retour.length != 0) {
          if (
            json_retour["informations_utilisateur"] !== null &&
            json_retour["informations_utilisateur"] !== undefined
          ) {
            for (const key in json_retour["informations_utilisateur"][0]) {
              if (key !== "errors") {
                $("#" + key).val(
                  json_retour["informations_utilisateur"][0][key]
                );
                tableau_reference[key] =
                  json_retour["informations_utilisateur"][0][key];
              }
            }
          }
        }
      }
    })
    .fail(function (textStatus) {
      console.log("Impossible de charger le dico des erreurs");
    });

  $("#bouton_modification_pwd").on("click", () => {
    console.log("clic");
    $("#bouton_modification_pwd").prop("disabled", true);
    $("#bouton_modification_pwd")
      .removeClass("avertissement")
      .addClass("default");

    $("#password").prop("disabled", false);
    $("#password").removeClass("turquoise-clair").addClass("rouge-clair");
    $("#password").val("");
    $("#password").focus();

    $("#password2").prop("disabled", false);
    $("#password2").removeClass("turquoise-clair").addClass("rouge-clair");

    $("#password3").prop("disabled", false);
    $("#password3").removeClass("turquoise-clair").addClass("rouge-clair");
  });

  $("#bouton_sauvegarde").on("click", () => {
    let est_rempli = false;

    if (
      $("#email").val().length !== 0 &&
      tableau_reference["email"] !== $("#email").val()
    ) {
      est_rempli = true;
    }

    if (
      $("#birthDate").val().length !== 0 &&
      tableau_reference["birthDate"] !== $("#birthDate").val()
    ) {
      est_rempli = true;
    }

    if (
      $("#bouton_modification_pwd").prop("disabled") &&
      $("#password").val().length !== 0 &&
      $("#password2").val().length !== 0 &&
      $("#password3").val().length !== 0
    ) {
      est_rempli = true;
    }

    if (est_rempli) {
      $("#formulaire_update_profil").submit();
    }
  });

  $("#bouton_supression").on("click", () => {
    if (etat_supression == 0) {
      etat_supression = 1;
      $("#bouton_supression")
        .removeClass("rouge-clair inverse")
        .addClass("rouge-fonce")
        .val("Êtes-vous sur ?");

      $("#colonneAnnulation").show();
    } else {
      console.log("Supression");
      $("#formulaire_update_profil").submit();
    }
  });

  $("#colonneAnnulation").on("click", () => {
    if (etat_supression == 1) {
      etat_supression = 0;

      $("#colonneAnnulation").hide();

      $("#bouton_supression")
        .removeClass("rouge-fonce")
        .addClass("rouge-clair inverse")
        .val("Supprimer mon compte");
    }
  });

  $(".focus_element").focusout(function () {
    if ($(this).val() == "") {
      $(this).removeClass("turquoise-clair").addClass("rouge-clair");
    } else {
      $(this).removeClass("rouge-clair").addClass("turquoise-clair");
    }
  });
});
