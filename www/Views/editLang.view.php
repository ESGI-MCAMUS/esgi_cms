<section id="backoffice-container">
  <br />
  <p class="texte miette-de-pain tres-petit"
    id="breadcrumb"><i class="fas fa-home"></i>/Admin/<?= LANG["admin"]["lang_breadcrum"] ?></p>

  <div class="row">
    <div class="col-1 center"></div>
    <div class="col-10 center">
      <h1 class="texte souligne-bleu"><?= LANG["admin"]["lang_title"] ?></h1>
      <hr>
      <div class="row left">
        <div class="col-12">
          <div class="langEditor"
            id="langEditor"
            name="langEditor"
            style="height: 500px;">
            <pre id="jsonContent"></pre>
          </div>
          <br>
          <button class="bouton info inverse middle"
            id="btnSubmitLang"><?= LANG["admin"]["button_edit"] ?></button>
        </div>
      </div>
    </div>
    <div class="col-1 center"></div>
  </div>
</section>

<script>
$(document).ready(() => {
  var jqxhr = $.getJSON(
      "http://<?= $_SERVER['SERVER_NAME'] ?>:<?= $_SERVER['SERVER_PORT'] ?>/assets/json/lang.json",
      function(json) {
        $('#jsonContent').html(JSON.stringify(json, undefined, 2));
      })
    .fail(function(jqXHR, textStatus, errorThrown) {
      console.log("error =>" + jqXHR.responseText);
    })

  const editor = tinymce.init({
    selector: '#langEditor',
    menubar: '',
    toolbar: ''
  });

  $('#btnSubmitLang').click(() => {
    const lang = JSON.parse(tinymce.get("langEditor").getContent({
      format: "text"
    }));
    const langString = tinymce.get("langEditor").getContent({
      format: "text"
    });
    $.post("http://<?= $_SERVER['SERVER_NAME'] ?>:<?= $_SERVER['SERVER_PORT'] ?>/admin/lang", {
      langData: langString,
    }).done(function(data) {
      document.location.reload();
    }).fail(function(e) {
      alert("error" + e);
    });
    console.log(langString);
  })
})
</script>
<script src="https://cdn.tiny.cloud/1/c5tj8x89gqyqzsg7j4gkz0rpqjdutb26qqt0hs72iwfqe966/tinymce/5/tinymce.min.js"
  referrerpolicy="origin"></script>
</script>
<script>

</script>