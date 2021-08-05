<div class="middle fullheight">
	<div class="container">
		<?php
		if (isset($_POST['est_active']) && $_POST['est_active']) {
		?>
			<div class="row">
				<div class="col-4"></div>
				<div class="col-4 center">
					<div class="segment <?php echo $_POST['div']; ?> elevated">
						<h3 class="texte <?php echo $_POST['couleur']; ?>"><?php echo $_POST['message']; ?></h3>
					</div>
				</div>
				<div class="col-4"></div>
			</div>
			<br />
		<?php
		}
		?>
		<div class="row">
			<div class="col-4"></div>
			<div class="col-4 center">
				<div class="segment turquoise elevated info">
					<h1 class="texte souligne-turquoise">Se connecter</h1>
					<br />
					<br />
					<br />
					<form id="formulaire_inscription" method="POST" action="/se-connecter">
						<div class="row">
							<div class="col-12">
								<input class="input turquoise-clair fluide" placeholder="<?= LANG["inscription"]["email"] ?>" type="mail" id="email" name="email">
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-12">
								<input class="input turquoise-clair fluide" placeholder="<?= LANG["inscription"]["password"] ?>" type="password" id="pwd1" name="pwd1" require>
							</div>
						</div>
						<br />
						<div class="row">
							<input id="bouton_connexion" class="bouton turquoise-clair arrondi inverse" type="button" value="Se connecter">
							<!-- bouton rouge inverse info arrondi -->
						</div>
						<br />
						<div class="row">
							<a href="/forgotten" id="mdp_oubli" class="tres-petit texte souligne-jaune"><?= LANG["connexion"]["forgot_password"] ?></a>
						</div>
						<div class="row">
							<a href="/s-inscrire" class="tres-petit texte souligne-bleu italic"><?= LANG["connexion"]["no_account"] ?></a>
						</div>
						<br />
						<div id="ligne_erreur" class="row">
						</div>
						<?php if (!isset($_POST['est_active'])) { ?>
							<div hidden>
								<p id="json_cache"><?php echo json_encode($_POST); ?></p>
							</div>
						<?php } ?>
					</form>
				</div>
			</div>
			<div class="col-4"></div>
		</div>
	</div>
</div>
<script src="../assets/js/login.js"></script>