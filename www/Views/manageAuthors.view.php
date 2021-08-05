<?php

use App\Core\Helpers;
?>
<section id="backoffice-container">

  <p class="texte miette-de-pain tres-petit" id="breadcrumb"><i class="fas fa-home"></i>/Admin/<?= LANG["navigation"]["authors"] ?></p>

  <div class="row">
    <div class="col-1 center"></div>
    <div class="col-10 center">
      <h1 class="texte souligne-bleu gros en-majuscule"><?= LANG["admin"]["author_search"] ?></h1>
      <br>
      <br>
      <div class="row">
        <div class="col-10">
          <input type="text" class="input fluide tres-epais bleu" id="s" placeholder="<?= LANG["admin"]["author_search_ph"] ?>">
        </div>
        <div class="col-2">
          <button onclick="location.href = '/admin/authors/add'" class="bouton fluide info inverse" type="button"><?= LANG["admin"]["button_add"] ?></button>
        </div>
      </div>
      </br></br>
      <div class="scrollable-view">
        <table style="text-align: center;">
          <thead>
            <tr>
              <th colspan="1"><?= LANG["admin"]["id"] ?></th>
              <th colspan="2"><?= LANG["admin"]["author_name"] ?></th>
              <th colspan="1"><?= LANG["admin"]["actions"]["title"] ?></th>
            </tr>
          </thead>
          <?php
          $allIds = [];
          foreach ($_POST['listAuthors'] as $key => $value) {
            $toReplace = array(".", " ", "&");
            $id = str_replace($toReplace, '-', strtolower($value["id"] . '_' . Helpers::unaccent($value["firstname"]) . '-' . Helpers::unaccent($value["lastname"])));
            array_push($allIds, $id);

            echo '
						<tr id="' . $id . '">
							<td colspan="1">' . $value["id"] . '</td>
							<td colspan="2">' . $value["firstname"] . ' ' . $value["lastname"] . '</td>
							<td colspan="1">
              <form class="inline-form bouton invisible" method="post" action="/admin/delete">
									<input type="hidden" name="id" value="' . $value["id"] . '"/>
									<input type="hidden" name="table" value="author"/>
									<input type="hidden" name="origin" value="/admin/authors"/>
									<button title="' . LANG["admin"]["actions"]["delete_book"]  . ' `' . $value["name"] . '`" style="background-color: transparent; border: none; cursor: pointer;">🗑</button>
							</form>
							 • 
							 <form class="inline-form bouton invisible" method="post" action="/admin/authors/edit">
									<input type="hidden" name="id" value="' . $value["id"] . '"/>
									<button title="' . LANG["admin"]["actions"]["edit_book"]  . ' `' . $value["title"] . '`" style="background-color: transparent; border: none; cursor: pointer;">✏️</button>
							</form>
              </td>
						</tr>
						';
          }
          echo '<div style="display: none" id="json_authors">' . json_encode($allIds) . '</div>';
          ?>
          <tbody>

          </tbody>

        </table>
      </div>
    </div>
    <div class="col-1 center"></div>
  </div>
</section>
<script src="/assets/js/authorSearch.js"></script>
<script>
  function changeEditValues(title, description, id) {
    $('#edit_categoryName').val(title);
    $('#edit_categoryDesc').val(description);
    $('#id').val(id);
    document.getElementById('modalEdit').style.display = 'block';
  }
</script>