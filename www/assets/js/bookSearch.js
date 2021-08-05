var ids = JSON.parse($("#json_book").html());

$("#s").keyup(() => {
  var query = $("#s").val().replace(".", "-").replace(" ", "-").toLowerCase();
  ids.map((u) => {
    if (query === "") {
      document.getElementById(u).style.display = "";
    } else if (u.includes(query)) {
      document.getElementById(u).style.display = "";
    } else {
      document.getElementById(u).style.display = "none";
    }
  });
});
