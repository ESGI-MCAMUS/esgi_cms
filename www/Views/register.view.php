<div class="middle fullheight">
	<div class="container">
		<div class="row">
			<div class="col-4"></div>
			<div class="col-4 center">
				<div class="segment elevated info">
					<h1 class="texte souligne-bleu"><?= LANG['inscription']['title'] ?></h1>

					<form id="formulaire_inscription" method="POST" action="/s-inscrire">
						<div class="row">
							<div class="col-6">
								<input class="focus_element input bleu-clair fluide" placeholder="<?= LANG['inscription']['firstname'] ?>" type="text" id="firstname" name="firstname" require>
							</div>
							<div class="col-6">
								<input class="focus_element input bleu-clair fluide" placeholder="<?= LANG['inscription']['lastname'] ?>" type="text" id="lastname" name="lastname" require>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<input class="focus_element input bleu-clair fluide" placeholder="<?= LANG['inscription']['email'] ?>" type="mail" id="email" name="email">
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<input class="focus_element input bleu-clair fluide" placeholder="<?= LANG['inscription']['password'] ?>" type="password" id="pwd1" name="pwd1" require>
							</div>
							<div class="col-6">
								<input class="focus_element input bleu-clair fluide" placeholder="<?= LANG['inscription']['passwordConfirm'] ?>" type="password" id="pwd2" name="pwd2" require>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<input class="focus_element input bleu-clair fluide" type="date" id="birthdate" name="birthdate" require>
							</div>
							<div class="col-6">
								<select name="country" id="country" class="input bleu-clair fluide">
									<option value=""><?= LANG['inscription']['country'] ?></option>
								</select>
							</div>
						</div>
						</br>
						<div class="row">
							<input id="bouton_inscription" class="bouton inverse info arrondi" type="button" value="<?= LANG['inscription']['title'] ?>">
						</div>
						<div class="row">
							<a href="/se-connecter" id="se_connecter" class="tres-petit texte souligne-bleu italic"><?= LANG['inscription']['already_account'] ?></a>
						</div>
						<br />
						<div id="ligne_erreur" class="row">
						</div>
						<div hidden>
							<p id="json_cache"><?php echo json_encode($_POST); ?></p>
						</div>
					</form>
				</div>
			</div>
			<div class="col-4"></div>
		</div>
	</div>
</div>
<script src="../assets/js/register.js"></script>