<?php

use App\Core\Helpers;
?>
<section id="backoffice-container">
  <link rel="stylesheet"
    href="https://www.w3schools.com/w3css/4/w3.css">
  <div id="modalEdit"
    class="w3-modal">
    <div class="w3-modal-content middle">
      <div class="w3-container">
        <span onclick="document.getElementById('modalEdit').style.display='none'"
          class="w3-button w3-display-topright">&times;</span>
        <br>

        <h1 class="texte moyen souligne-bleu"><?= LANG["admin"]["category_edit"] ?></h1>
        <br>
        <form method="post"
          action="/admin/categories/edit">
          <input type="text"
            id="edit_categoryName"
            name="edit_categoryName"
            required
            class="input fluide epais bleu"
            placeholder="<?= LANG["admin"]["category_name"] ?>...">
          <input type="text"
            name="edit_categoryDesc"
            id="edit_categoryDesc"
            required
            class="input fluide epais bleu"
            placeholder="<?= LANG["admin"]["category_desc"] ?>...">
          <input type="hidden"
            name="id"
            id="id"
            value="" />
          <br>
          <br>
          <button class="bouton fluide inverse info"
            type="submit"><?= LANG["admin"]["button_edit"] ?>
          </button>
          <br>
          <br>

        </form>
      </div>
    </div>
  </div>
  <p class="texte miette-de-pain tres-petit"
    id="breadcrumb"><i class="fas fa-home"></i>/Admin/Gestion des catégories</p>

  <div class="row">
    <div class="col-1 center"></div>
    <div class="col-10 center">
      <h1 class="texte moyen souligne-bleu"><?= LANG["admin"]["category_add"] ?></h1>
      <br><br>
      <div class="row">
        <form action="/admin/categories"
          method="post"
          enctype="multipart/form-data">
          <div class="col-3">
            <input type="text"
              name="add_categoryName"
              required
              class="input fluide epais bleu"
              placeholder="<?= LANG["admin"]["category_name"] ?>...">
          </div>
          <div class="col-5">
            <input type="text"
              name="add_categoryDesc"
              required
              class="input fluide epais bleu"
              placeholder="<?= LANG["admin"]["category_desc"] ?>...">
          </div>
          <div class="col-2">
            <input type="file"
              required
              style="display: none;"
              name="add_categoryImage"
              id="add_categoryImage">
            <button class="bouton fluide inverse info"
              type="button"
              onclick="$('#add_categoryImage').click()"><?= LANG["admin"]["button_add_image"] ?></button>
          </div>
          <div class="col-2">
            <button class="bouton fluide info"
              type="submit"><?= LANG["admin"]["button_add"] ?></button>
          </div>
        </form>
      </div>
      <?php
      $errors = $_POST["imgErrors"];
      if (!empty($errors)) {
        foreach ($errors as $key => $value) {
          echo '<p class="texte rouge petit">' . LANG["general"]["errors"]["upload"][$value] . '</p><br>';
        }
      }
      ?>
      <br><br>
      <h1 class="texte moyen souligne-bleu"><?= LANG["admin"]["category_search"] ?></h1>
      <br>
      <br>
      <input type="text"
        class="input fluide tres-epais bleu"
        id="s"
        placeholder="<?= LANG["admin"]["category_search_button"] ?>">
      </br></br>
      <div class="scrollable-view">
        <table style="text-align: center;">
          <thead>
            <tr>
              <th colspan="1"><?= LANG["admin"]["id"] ?></th>
              <th colspan="2"><?= LANG["admin"]["category_name"] ?></th>
              <th colspan="2"><?= LANG["admin"]["category_short_desc"] ?></th>
              <th colspan="1"><?= LANG["admin"]["category_book_count"] ?></th>
              <th colspan="1"><?= LANG["admin"]["actions"]["title"] ?></th>
            </tr>
          </thead>
          <?php
          $allIds = [];
          foreach ($_POST['listCategories'] as $key => $value) {
            $toReplace = array(".", " ", "&");
            $id = str_replace($toReplace, '-', strtolower($value["id"] . '_' . Helpers::unaccent($value["name"])));
            array_push($allIds, $id);

            echo '
						<tr id="' . $id . '">
							<td colspan="1">' . $value["id"] . '</td>
							<td colspan="2">' . $value["name"] . '</td>
							<td colspan="2">' . $value["shortDescription"] . '</td>
							<td colspan="1">' . $value["nbBooks"] . '</td>
							<td colspan="1">
								<form class="inline-form bouton invisible" method="post" action="/admin/delete">
									<input type="hidden" name="id" value="' . $value["id"] . '"/>
									<input type="hidden" name="table" value="category"/>
									<input type="hidden" name="origin" value="/admin/categories"/>
									<button title="' . LANG["admin"]["actions"]["delete_book"]  . ' `' . $value["name"] . '`" style="background-color: transparent; border: none; cursor: pointer;">🗑</button>
								</form>
								• 
								<button onclick="changeEditValues(`' . $value["name"] . '`, `' . $value["description"] . '`,`' . $value["id"] . '`)" title="' . LANG["admin"]["actions"]["edit_book"] . ' `' . $value["name"] . '`" style="background-color: transparent; border: none; cursor: pointer;">✏️</button></td>
						</tr>
						';
          }
          echo '<div style="display: none" id="json_category">' . json_encode($allIds) . '</div>';
          ?>
          <tbody>

          </tbody>

        </table>
      </div>
    </div>
    <div class="col-1 center"></div>
  </div>
</section>
<script src="/assets/js/categorySearch.js"></script>
<script>
function changeEditValues(title, description, id) {
  $('#edit_categoryName').val(title);
  $('#edit_categoryDesc').val(description);
  $('#id').val(id);
  document.getElementById('modalEdit').style.display = 'block';
}
</script>