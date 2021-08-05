var ids = JSON.parse($("#json_user").html());

$("#s").keyup(() => {
  var query = $("#s").val().replace(".", "-").toLowerCase();
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
