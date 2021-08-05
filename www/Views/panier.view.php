<?php

use App\Core\Helpers;
?>
<section id="backoffice-container">

  <p class="texte miette-de-pain tres-petit"
    id="breadcrumb"><i class="fas fa-home"></i>/Utilisateur/Panier</p>

  <div class="row">
    <div class="col-1 center"></div>
    <div class="col-10 center">
      <h1 class="texte moyen souligne-bleu"><?= LANG["admin"]["basket_title"] ?></h1>
      <br>
      <br>
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
          $items = [];
          $total = 0;
          foreach ($_POST['listBasket'] as $key => $value) {
            array_push($items, intval($value["id_livre"]));
            $total += $value["prix_livre"];
            $toReplace = array(".", " ", "&");
            $id = str_replace($toReplace, '-', strtolower($value["id"] . '_' . Helpers::unaccent($value["name"])));
            array_push($allIds, $id);

            echo '
						<tr id="' . $id . '">
							<td colspan="1">' . $value["id_livre"] . '</td>
							<td colspan="2"><a href="/book/' . $value["id_livre"] . '">' . $value["titre_livre"] . '</a></td>
							<td colspan="2"><a href="/author/' . $value["id_auteur"] . '">' . $value["nom_auteur"] . '</a></td>
                            <td colspan="2"><a href="/categorie/' . $value["id_categorie"] . '">' . $value["description_livre"] . '</a></td>
							<td colspan="1">' . $value["prix_livre"] . ' €</td>
							<td colspan="1">
                <form class="inline-form bouton invisible" method="post" action="/admin/delete/item-pannier">
									<input type="hidden" name="id_livre_remove" value="' . $value["id_livre"] . '"/>
									<input type="hidden" name="table" value="user"/>
									<input type="hidden" name="origin" value="/utilisateur/panier"/>
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
            <td style="padding-top: 10px;padding-bottom: 10px;"
              colspan="7"></td>
            <td style="padding-top: 10px;padding-bottom: 10px;"
              colspan="1"><?= $total ?> €</td>
            <td style="padding-top: 10px;padding-bottom: 10px;"
              colspan="1">Total (€)</td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="col-1 center"></div>
  </div>
  <?php
  if ($total > 0) {
  ?>
  <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <div class="row">
    <div class="col-4"></div>
    <div class="col-4">
      <div class="segment bleu elevated info">
        <h1 class="texte gros middle"><?= $total ?> €</h1>
        <form action="/utilisateur/checkout"
          method="post">
          <input type="hidden"
            name="price"
            value="<?= $total ?>">
          <input type="hidden"
            name="items"
            value='<?= json_encode($items) ?>'>
          <div class="row">
            <div class="col-4"></div>
            <div class="col-4"><button class="bouton inverse info middle fluide"><?= LANG["profil"]["buy"] ?></button>
            </div>
            <div class="col-4"></div>
          </div>
        </form>
        <p class="texte aide tres-petit middle"><?= LANG["profil"]["stripe_secured"] ?></p>
      </div>
    </div>
    <div class="col-4"></div>
  </div>

  <?php } ?>
</section>