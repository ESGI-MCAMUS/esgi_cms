$(document).ready(() => {
  console.log("dashboard");

  $.ajax({
    method: "POST",
    url: "/fetch/categories",
  }).done(function (data) {
    let json = JSON.parse(data);
    let nb_cat = json[0][0].id;

    let tab_nom_cat = [];

    json[1].forEach((e) => {
      tab_nom_cat.push(e[0]);
    });

    let tab_nb_cat = [];

    json[1].forEach((e) => {
      tab_nb_cat.push(e[1]);
    });

    $("#valeur-categories").text(nb_cat);

    var ctx = $("#chartCategories");
    var myChart = new Chart(ctx, {
      type: "pie",
      data: {
        datasets: [
          {
            data: tab_nb_cat,
            backgroundColor: [
              "rgba(255, 99, 132)",
              "rgba(54, 162, 235)",
              "rgba(255, 206, 86)",
              "rgba(75, 192, 192)",
              "rgba(153, 102, 255)",
              "rgba(255, 159, 64)",
              "rgba(255, 99, 132)",
              "rgba(54, 162, 235)",
              "rgba(255, 206, 86)",
              "rgba(75, 192, 192)",
              "rgba(153, 102, 255)",
              "rgba(255, 159, 64)",
              "rgba(255, 99, 132)",
              "rgba(54, 162, 235)",
              "rgba(255, 206, 86)",
              "rgba(75, 192, 192)",
              "rgba(153, 102, 255)",
              "rgba(255, 159, 64)",
            ],
            borderColor: [
              "rgba(255, 99, 132)",
              "rgba(54, 162, 235)",
              "rgba(255, 206, 86)",
              "rgba(75, 192, 192)",
              "rgba(153, 102, 255)",
              "rgba(255, 159, 64)",
              "rgba(255, 99, 132)",
              "rgba(54, 162, 235)",
              "rgba(255, 206, 86)",
              "rgba(75, 192, 192)",
              "rgba(153, 102, 255)",
              "rgba(255, 159, 64)",
              "rgba(255, 99, 132)",
              "rgba(54, 162, 235)",
              "rgba(255, 206, 86)",
              "rgba(75, 192, 192)",
              "rgba(153, 102, 255)",
              "rgba(255, 159, 64)",
            ],
            borderWidth: 1,
          },
        ],
        labels: tab_nom_cat,
      },
      options: {
        legend: {
          display: false,
        },
        title: {
          display: true,
          text: "Repartitions des livres dans les categories",
          position: "bottom",
        },
      },
    });
  });

  $.ajax({
    method: "POST",
    url: "/fetch/livres",
  }).done(function (data) {
    let json = JSON.parse(data);

    $("#valeur-livres").text(json[0][0].id);
    $("#valeur-livres-semaine").text(json[1][0].nb_orders_weekly);
    $("#valeur-livres-semaine-vente").text(
      json[2][0][0].split(".")[0] +
        (json[2][0][0].split(".").length == 2
          ? "." + json[2][0][0].split(".")[1].substring(0, 2)
          : "") +
        " €"
    );
    $("#valeur-panier-moyen").text(
      json[3][0][0].split(".")[0] +
        (json[3][0][0].split(".").length == 2
          ? "." + json[3][0][0].split(".")[1].substring(0, 2)
          : "") +
        " €"
    );
  });

  $("#valeur-utlisateurs").text(genereData());
  $("#valeur-utilisateurs-qutotidien").text(genereData());

  function genereData(max = 100) {
    return Math.floor(Math.random() * max) + 1;
  }
});
