<section id="backoffice-container">
  <br />
  <p class="texte miette-de-pain tres-petit"
    id="breadcrumb"><i class="fas fa-home"></i>/Admin/Gestion des livres</p>

  <div class="row">
    <div class="col-1 center"></div>
    <div class="col-10 center">
      <div class="row">
        <div class="col-10">
          <input type="text"
            class="input fluide tres-epais bleu"
            id="s"
            placeholder="<?= LANG["admin"]["search_book"] ?>">
        </div>
        <div class="col-2">
          <button onclick="location.href = '/admin/books/editor'"
            class="bouton fluide info inverse"
            type="button"><?= LANG["admin"]["button_book_add"] ?></button>
        </div>
      </div>
      </br></br>
      <div class="scrollable-view">
        <table>
          <thead>
            <tr>
              <th colspan="1"><?= LANG["admin"]["id"] ?></th>
              <th colspan="2"><?= LANG["admin"]["book_title"] ?></th>
              <th colspan="1.5"><?= LANG["admin"]["book_author"] ?></th>
              <th colspan="2"><?= LANG["admin"]["book_category"] ?></th>
              <th colspan="0.5"><?= LANG["admin"]["actions"]["title"] ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $allIds = [];
            foreach ($_POST['listBooks'] as $key => $value) {
              $toReplace = array(".", " ");
              $id = str_replace($toReplace, '-', strtolower($value["id"] . '_' . $value["title"] . '_' . $value["firstname"] . '-' . $value["lastname"]));
              array_push($allIds, $id);

              echo '
						<tr id="' . $id . '">
							<td colspan="1">' . $value["id"] . '</td>
							<td colspan="2">' . $value["title"] . '</td>
							<td colspan="1.5">' . $value["firstname"] . ' ' . $value["lastname"] . '</td>
							<td colspan="2">' . $value["categoryName"] . '</td>
							<td colspan="0.5">
							<form class="inline-form bouton invisible" method="post" action="/admin/delete">
									<input type="hidden" name="id" value="' . $value["id"] . '"/>
									<input type="hidden" name="table" value="article"/>
									<input type="hidden" name="origin" value="/admin/books"/>
									<button title="' . LANG["admin"]["actions"]["delete_book"]  . ' `' . $value["name"] . '`" style="background-color: transparent; border: none; cursor: pointer;">🗑</button>
							</form>
							 • 
							 <form class="inline-form bouton invisible" method="post" action="/admin/book/edit">
									<input type="hidden" name="id" value="' . $value["id"] . '"/>
									<button title="' . LANG["admin"]["actions"]["edit_book"]  . ' `' . $value["title"] . '`" style="background-color: transparent; border: none; cursor: pointer;">✏️</button>
							</form>
						</tr>
						';
            }
            echo '<div style="display:none" id="json_book">' . json_encode($allIds) . '</div>';
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-1 center"></div>
  </div>
</section>
<script src="/assets/js/bookSearch.js"></script>