<?php

use App\Core\Helpers;
?>
<section id="backoffice-container">

  <p class="texte miette-de-pain tres-petit"
    id="breadcrumb"><i class="fas fa-home"></i>/Utilisateur/<?= LANG["navigation"]["order"] ?></p>

  <div class="row">
    <div class="col-1 center"></div>
    <div class="col-10 center">
      <h1 class="texte moyen souligne-bleu"><?= LANG["navigation"]["order"] ?></h1>
      <br>
      <br>
      <table style="text-align: center;">
        <thead>
          <tr>
            <th colspan="1"><?= LANG["admin"]["id_command"] ?></th>
            <th colspan="2"><?= LANG["admin"]["order_date"] ?></th>
            <th colspan="1"><?= LANG["admin"]["order_nb_books"] ?></th>
            <th colspan="1"><?= LANG["admin"]["price"] ?></th>
            <th colspan="1"><?= LANG["admin"]["order_status"] ?></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $allIds = [];
          $total = 0;
          foreach ($_POST['listOrder'] as $key => $value) {
            $total += $value["prix_livre"];
            $toReplace = array(".", " ", "&");
            $id = str_replace($toReplace, '-', strtolower($value["id"] . '_' . Helpers::unaccent($value["name"])));
            array_push($allIds, $id);
            $status = $value["status"] == 0 ? '<p class="texte rouge petit epais">' . LANG["admin"]["order"]["order_status_refused"] . '</p>' : '<p class="texte petit vert">' . LANG["admin"]["order"]["order_status_delivered"] . '</p>';

            echo '
						<tr id="' . $id . '">
							<td colspan="1">' . $value["id"] . '</td>
                            <td colspan="2">' . $value["date_creation"] . '</td>
                            <td colspan="1">' . $value["nb_items"] . '</td>
                            <td colspan="1">' . $value["total_amount"] . ' €</td>
                            <td colspan="1">' . $status . '</td>
						</tr>
						';
          }
          echo '<div style="display: none" id="json_category">' . json_encode($allIds) . '</div>';
          ?>
        </tbody>
      </table>
    </div>
    <div class="col-1 center"></div>
  </div>
</section>