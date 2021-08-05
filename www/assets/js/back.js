$(document).ready(() => {
  console.log("on est dans le back");

  $("#back-to-index").on("click", () => {
    window.location.replace("/");
  });

  $("#disconnect-btn").on("click", () => {
    window.location.replace("/deconnexion");
  });
});
