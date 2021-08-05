<section id="backoffice-container">
  <br />
  <p class="texte miette-de-pain tres-petit"
    id="breadcrumb"><i class="fas fa-home"></i>/Admin/Gestion des utilisateurs</p>

  <div class="row">
    <div class="col-1 center"></div>
    <div class="col-10 center">
      <input type="text"
        class="input fluide tres-epais bleu"
        id="s"
        placeholder="<?= LANG["admin"]["search"] ?>">
      </br></br>
      <table style="text-align: center;">
        <thead>
          <tr>
            <th colspan="1"><?= LANG["admin"]["id"] ?></th>
            <th colspan="3"><?= LANG["admin"]["identity"] ?></th>
            <th colspan="3"><?= LANG["admin"]["email"] ?></th>
            <th colspan="2"><?= LANG["admin"]["actions"]["title"] ?></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $allIds = [];
          foreach ($_POST['listUsers'] as $key => $value) {
            $id = str_replace('.', '-', strtolower($value["id"] . '_' . $value["firstname"] . '_' . $value["lastname"] . '_' . $value["email"]));
            array_push($allIds, $id);
            $adminAction = $value["role"] != 1 ? '
             <input name="value" value="1" type="hidden" />
             <button title="' . LANG["admin"]["actions"]["set_admin"] . '" style="background-color: transparent; border: none; cursor: pointer;">⚙️</button>'
              :
              '<input name="value" value="0" type="hidden" />
              <button title="' . LANG["admin"]["actions"]["remove_admin"] . '" style="background-color: transparent; border: none; cursor: pointer;">👨‍</button>';
            $activeAccount = $value["state"] != 1 ? '
            <input name="value" value="1" type="hidden" />
            <button href="" title="' . LANG["admin"]["actions"]["enable_account"] . '" style="background-color: transparent; border: none; cursor: pointer;">✔️</button>'
              :
              '<input name="value" value="0" type="hidden" />
            <button href="" title="' . LANG["admin"]["actions"]["disable_account"] . '" style="background-color: transparent; border: none; cursor: pointer;">🚧</button>';

            echo '
						<tr id="' . $id . '">
							<td colspan="1">' . $value["id"] . '</td>
							<td colspan="3">' . $value["firstname"] . ' ' . $value["lastname"] . '</td>
							<td colspan="3">' . $value["email"] . '</td>
							<td colspan="2">
							<form class="inline-form bouton invisible" method="post" action="/admin/delete">
									<input type="hidden" name="id" value="' . $value["id"] . '"/>
									<input type="hidden" name="table" value="user"/>
									<input type="hidden" name="origin" value="/admin/users"/>
									<button title="' . LANG["admin"]["actions"]["delete"]  . '" style="background-color: transparent; border: none; cursor: pointer;">🗑</button>
							</form>
							•
              <form action="/admin/user/edit" method="post" class="inline-form bouton invisible">
              <input name="id" value="' . $value["id"] . '" type="hidden" />
              <input name="attribute" value="role" type="hidden" />
              ' . $adminAction . '
              </form> • 
              <form action="/admin/user/edit" method="post" class="inline-form bouton invisible">
              <input name="id" value="' . $value["id"] . '" type="hidden" />
              <input name="attribute" value="state" type="hidden" />
              ' . $activeAccount . '
              </form>
              </td>
						</tr>
						';
          }
          echo '<div style="display:none" id="json_user">' . json_encode($allIds) . '</div>';
          ?>
        </tbody>
      </table>
    </div>
    <div class="col-1 center"></div>
  </div>
</section>
<script src="/assets/js/userSearch.js"></script>