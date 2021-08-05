<link rel="stylesheet"
  href="https://cdn.quilljs.com/1.3.6/quill.core.css">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css"
  rel="stylesheet">


<section id="backoffice-container">
  <br />
  <p class="texte miette-de-pain tres-petit"
    id="breadcrumb"><i class="fas fa-home"></i>/Admin/Livres/Ajouter un auteur</p>

  <div class="row">
    <div class="col-1 center"></div>
    <div class="col-10 center">
      <h1 class="texte souligne-bleu gros en-majuscule">
        Ajouter un auteur
      </h1>
      <form method="post"
        action="/admin/authors/add"
        enctype="multipart/form-data">
        <br><br>
        <div class="row">
          <div class="col-2"><button onclick="location.href = '/admin/authors'"
              class="bouton fluide info inverse"
              type="button"><?= LANG["admin"]["button_back"] ?></button></div>
          <div class="col-3"><input type="text"
              class="input tres-epais bleu fluide"
              name="authorFirstname"
              placeholder="<?= LANG["admin"]["author_firstname"] ?>"></div>
          <div class="col-3"><input type="text"
              class="input tres-epais bleu fluide"
              name="authorLastname"
              placeholder="<?= LANG["admin"]["author_lastname"] ?>"></div>
          <div class="col-2">
            <input type="file"
              style="display: none;"
              name="add_authorImage"
              id="add_authorImage">
            <button class="bouton fluide info"
              type="button"
              onclick="$('#add_authorImage').click()"><?= LANG["admin"]["button_add_photo"] ?></button>
          </div>
          <div class="col-2">
            <input type="file"
              style="display: none;"
              name="add_authorBanner"
              id="add_authorBanner">
            <button class="bouton fluide info"
              type="button"
              onclick="$('#add_authorBanner').click()"><?= LANG["admin"]["button_add_couverture"] ?></button>
          </div>
        </div>
        <br>

        <textarea id="authorEditor"
          name="authorEditor"
          style="height: 500px;">
				</textarea>
        <br>
        <div class="row">
          <div class="col-5"></div>
          <div class="col-2">
            <button class="bouton bleu fluide info inverse"><?= LANG["admin"]["button_add"] ?></button>
          </div>
          <div class="col-5"></div>
        </div>
      </form>
    </div>
    <div class="col-1 center"></div>
    <?php
    $errors = $_POST["imgErrors"];
    if (!empty($errors)) {
      foreach ($errors as $key => $value) {
        echo '<p class="texte rouge petit">' . LANG["general"]["errors"]["upload"][$value] . '</p><br>';
      }
    }
    ?>
  </div>
</section>

<script src="https://cdn.tiny.cloud/1/c5tj8x89gqyqzsg7j4gkz0rpqjdutb26qqt0hs72iwfqe966/tinymce/5/tinymce.min.js"
  referrerpolicy="origin"></script>
</script>
<script>
tinymce.init({
  selector: '#authorEditor',
  plugins: 'preview searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars',
  menubar: 'file edit view insert format tools table tc help',
});
</script>