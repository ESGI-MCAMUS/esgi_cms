$(document).ready(() => {
  console.log("coucou");

  $(".bouton_wishlist").on("click", function () {
    console.log($(this).val());

    $.ajax({
      method: "POST",
      url: "/routeTest",
      data: {
        id_bouton: $(this).val(),
      },
    }).done(function (msg) {
      alert("Data Saved: " + msg);
    });
  });
});
