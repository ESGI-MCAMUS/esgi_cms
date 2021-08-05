<link rel="stylesheet"
  href="https://cdn.quilljs.com/1.3.6/quill.core.css">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css"
  rel="stylesheet">

<section id="backoffice-container">
  <br />
  <p class="texte miette-de-pain tres-petit"
    id="breadcrumb"><i class="fas fa-home"></i>/Admin/Livres/Editer "<?= $_POST["book"][0]["title"] ?>"</p>

  <div class="row">
    <div class="col-1 center"></div>
    <div class="col-10 center">
      <h1 class="texte souligne-bleu gros en-majuscule">
        <?= LANG["admin"]["book_editor"] ?>
      </h1>
      <form method="post"
        action="/admin/book/edit"
        enctype="multipart/form-data">
        <br><br>
        <div class="row">
          <div class="col-2"><button onclick="location.href = '/admin/books'"
              class="bouton fluide info inverse"
              type="button"><?= LANG["admin"]["button_back"] ?></button></div>
          <div class="col-8"><input type="text"
              class="input tres-epais bleu fluide"
              name="bookName"
              value="<?= $_POST["book"][0]["title"] ?>"
              placeholder="<?= LANG["admin"]["book_title"] ?>"></div>
          <div class="col-2"><input type="text"
              class="input tres-epais bleu fluide"
              name="price"
              type="number"
              value="<?= $_POST["book"][0]["price"] ?>"
              placeholder="<?= LANG["general"]["book"]["book_price"] ?>"></div>
        </div>
        <br><br>

        <textarea id="bookEditor"
          name="bookEditor"
          style="height: 500px">
        <?= $_POST["book"][0]["content"] ?>
				</textarea>
        <br>
        <div class="row">
          <div class="col-3">
            <select name="bookCategory"
              id="bookCategory"
              class="input fluide tres-epais bleu">
              <option value="-1"><?= LANG["admin"]["book_select_category"] ?></option>
              <?php
              foreach ($_POST["listCategories"] as $key => $value) {
                if ($value["id"] == $_POST["book"][0]["fk_category"]) {
                  $selected = "selected";
                } else {
                  $selected = "";
                }
                echo '<option value="' . $value["id"] . '" ' . $selected . '>' . $value["name"] . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="col-3">
            <select name="bookAuthor"
              id="bookAuthor"
              class="input fluide tres-epais bleu">
              <option value="-1"><?= LANG["admin"]["book_select_author"] ?></option>
              <?php
              foreach ($_POST["listAuthor"] as $key => $value) {
                if ($value["id"] == $_POST["book"][0]["fk_author"]) {
                  $selected = "selected";
                } else {
                  $selected = "";
                }
                echo '<option value="' . $value["id"] . '" ' . $selected . '>' . $value["firstname"] . ' ' . $value["lastname"] . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="col-3">
            <input type="file"
              style="display: none;"
              name="add_bookImage"
              id="add_bookImage">
            <button class="bouton fluide inverse info"
              type="button"
              onclick="$('#add_bookImage').click()"><?= LANG["admin"]["button_add_couverture"] ?></button>
          </div>
          <div class="col-3">
            <input type="text"
              class="input fluide tres-epais bleu"
              name="bookTags"
              value="<?php
                                                                                            $tags = "";
                                                                                            foreach (json_decode($_POST["book"][0]["keywords_json"]) as $key => $value) {
                                                                                              $tags .= $value . ",";
                                                                                            }
                                                                                            $tags = substr($tags, 0, -1);
                                                                                            echo $tags;
                                                                                            ?>"
              placeholder="<?= LANG["admin"]["book_tag"] ?>">
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-5"></div>
          <div class="col-2">
            <button class="bouton bleu fluide info inverse"><?= LANG["admin"]["button_send"] ?></button>
          </div>
          <div class="col-5"></div>
        </div>
        <input type="hidden"
          name="oldImage"
          id="oldImage"
          value="<?= $_POST["book"][0]["image_header"] ?>" />
        <input type="hidden"
          name="createdAt"
          id="createdAt"
          value="<?= $_POST["book"][0]["created_at"] ?>" />
        <input type="hidden"
          name="bookToUpdate"
          id="bookToUpdate"
          value="<?= $_POST["book"][0]["id"] ?>" />
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
  selector: '#bookEditor',
  plugins: 'preview searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars',
  menubar: 'file edit view insert format tools table tc help',
});
</script>