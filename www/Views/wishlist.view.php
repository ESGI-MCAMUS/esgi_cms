<?php

use App\Core\Helpers;
?>
<section id="backoffice-container">

  <p class="texte miette-de-pain tres-petit" id="breadcrumb"><i class="fas fa-home"></i>/Utilisateur/Liste de souhaits</p>

  <div class="row">
    <div class="col-1 center"></div>
    <div class="col-10 center">
      <h1 class="texte moyen souligne-bleu"><?= LANG["admin"]["wishlist_title"] ?></h1>
      <br>
      <br>
      <div class="scrollable-view">
        <table style="text-align: center;">
          <thead>
            <tr>
              <th colspan="1"><?= LANG["admin"]["id"] ?></th>
              <th colspan="2"><?= LANG["admin"]["book_title"] ?></th>
              <th colspan="2"><?= LANG["admin"]["book_author"] ?></th>
              <th colspan="2"><?= LANG["admin"]["book_category"] ?></th>
              <th colspan="1"><?= LANG["admin"]["price"] ?></th>
              <th colspan="1"><?= LANG["admin"]["actions"]["title"] ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $allIds = [];
            foreach ($_POST['listWishlist'] as $key => $value) {
              $toReplace = array(".", " ", "&");
              $id = str_replace($toReplace, '-', strtolower($value["id"] . '_' . Helpers::unaccent($value["name"])));
              array_push($allIds, $id);

              echo '
						<tr id="' . $id . '">
							<td colspan="1">' . $value["id_livre"] . '</td>
							<td colspan="2"><a href="/book/' . $value["id_livre"] . '">' . $value["titre_livre"] . '</a></td>
							<td colspan="2"><a href="/author/' . $value["id_auteur"] . '">' . $value["nom_auteur"] . '</a></td>
              <td colspan="2"><a href="/categorie/' . $value["id_category"] . '">' . $value["category"] . '</a></td>
							<td colspan="1">' . $value["prix_livre"] . ' €</td>
							<td colspan="1">
                ';

              if (!$value["pending"]) {
                echo '<form class="inline-form bouton invisible" method="post" action="/utilisateur/basket/add">
									<input type="hidden" name="id_livre_ajout" value="' . $value["id_livre"] . '"/>
                  <input type="hidden" name="route" value="/utilisateur/wishlist"/>
									<button title="' . LANG["admin"]["actions"]["add_basket"] . '" style="background-color: transparent; border: none; cursor: pointer;">🛒</button>
							  </form>';
              }

              echo '<form class="inline-form bouton invisible" method="post" action="/admin/delete">
									<input type="hidden" name="id" value="' . $value["id"] . '"/>
									<input type="hidden" name="table" value="wishlist"/>
									<input type="hidden" name="origin" value="/utilisateur/wishlist"/>
									<button title="' . LANG["admin"]["actions"]["delete_book"]  . '" style="background-color: transparent; border: none; cursor: pointer;">🗑</button>
								</form>
						</tr>
						';
            }
            echo '<div style="display: none" id="json_category">' . json_encode($allIds) . '</div>';
            ?>
          </tbody>
          <tfoot style="background-color: #45B0E5; color: #fff;">
            <tr>
              <td style="padding-top: 10px;padding-bottom: 10px;" colspan="7"></td>
              <td style="padding-top: 10px;padding-bottom: 10px;" colspan="1"><?php echo $_POST['prix_wishlist'] ?> €</td>
              <td style="padding-top: 10px;padding-bottom: 10px;" colspan="1">Total (€)</td>
            </tr>
          </tfoot>
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