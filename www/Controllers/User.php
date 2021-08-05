<?php

namespace App\Controller;

use App\Core\View;
use App\Core\FormValidator;
use App\Core\Helpers;
use App\Core\Mailer;
use App\Core\Security;
use App\Models\User as UserModel;

class User {

	// Affichage pas d'accueil + gestion du changement d'information
	public function defaultAction() {
		print_r($_POST);
		if (isset($_SESSION["id"])) {
			unset($_POST["errors"]);

			$user = new UserModel();

			$ref = -1;

			if (!empty($_POST)) { // si le post n'est pas empty c'est qu'on veut MAJ des valeurs
				unset($_POST["errors"]);

				$errors = FormValidator::checkUpdateUser($_POST);

				if (empty($errors)) {
					$user->setId($_SESSION["id"]);
					if (strcmp($_SESSION["email"], $_POST["email"]) == 0) {
						$ref = 2;
						$user->setEmail($_POST['email']);
					} else if (strcmp($_SESSION["email"], $_POST["email"]) != 0 && !$user->verifieMailUnique()) { // on verifie que l'utilisateur a mis un mail different de celui qu'il possede deja
						$ref = 1;
						array_push($errors, 'mail_already_exist'); // et on regarde si le mail est unique
					} else { // il est unique et n'est pas celui qu'il avait avant
						// $nouveau_mail = $_POST["email"];
						$ref = 3;
						$user->setEmail($_POST["email"]);
						if (!$user->majUserMail()) {
							array_push($errors, 'cant_update_mail');
						} else {
							$_SESSION["email"] = $user->getEmail();
							$user->setEmail($user->getEmail());
						}
					}

					if (isset($_POST["pwd2"])) {
						$user->setPassword(Helpers::cryptPassword($_POST["pwd2"]));

						if (!$user->majUserPwd()) {
							array_push($errors, 'cant_update_pwd');
						} else {
							$_POST["password"] = Helpers::hidePassword();
						}
					}
				} else {
					$_POST["errors"] = $errors;
					$_POST["password"] = Helpers::hidePassword();
					unset($_POST["pwd1"]);
					unset($_POST["pwd2"]);
					unset($_POST["pwd3"]);

					$user->setEmail($_SESSION['email']);
				}
			} else {
				$user->setEmail(Helpers::cleanMail($_SESSION["email"]));
			}

			$user->reccupereInfoUser();

			$user->setPassword(Helpers::hidePassword());

			$_POST["informations_utilisateur"] = $user->retourneInformationsUser();

			$view = new View("user", "back");
		} else {
			header('Location: /se-connecter');
			exit;
		}
	}


	// Créer un compte à l'utilisateur
	public function registerAction() {
		if (!isset($_SESSION["id"])) {
			unset($_POST["errors"]);

			$user = new UserModel();

			if (!empty($_POST)) {
				$errors = FormValidator::check($_POST, 7);

				$user->setEmail(Helpers::cleanMail($_POST["email"]));
				if (!$user->verifieMailUnique()) {
					array_push($errors, 'email_already_in_use');
				}

				if (empty($errors)) {
					$user->setFirstname($_POST["firstname"]);
					$user->setLastname($_POST["lastname"]);
					$user->setBirthDate($_POST["birthdate"]);
					$user->setPassword(Helpers::cryptPassword($_POST["pwd1"]));
					$user->setCountry($_POST["country"]);
					$user->setState(0);
					$user->setRole(0);
					$user->setIsDeleted(0);
					$user->setCreatedAt(date('Y-m-d H:i:s'));
					$user->setUpdatedAt(date('Y-m-d H:i:s'));
					$user->setEmailKey(Helpers::keyGenerator());
					$id = $user->save();

					Mailer::envoieMail(
						$user->getEmail(),
						$user->getFirstname(),
						$user->getLastname(),
						'Vous venez de creer un compte !',
						'Bienvenue !<br /> Vous venez de creer un compte. Pour finaliser votre inscription, veuillez cliquer sur le lien suivant pour activer votre compte : <a href="' . URLSITE . '/activation/' . $id . '/' . $user->getEmailKey() . '">Lien d\'activation</a>'
					);


					header('Location: /se-connecter');
					// Security::connect();
					exit;
				} else {
					$_POST["errors"] = $errors;
					unset($_POST["pwd1"]);
					unset($_POST["pwd2"]);
				}
			}
			$view = new View("register");
		} else {
			header('Location: /utilisateur');
			exit;
		}
	}

	// Connecter l'utilisateur
	public function connectAction() {
		if (!isset($_SESSION["id"])) {
			unset($_POST["errors"]);

			$user = new UserModel();

			if (!empty($_POST)) {
				$user->setEmail(Helpers::cleanMail($_POST["email"]));
				$user->setPassword($_POST["pwd1"]);

				$errors = $user->tentativeConnexion();

				if (empty($errors)) {
					header('Location: /');
					exit;
				} else {
					$_POST["errors"] = $errors;
					unset($_POST["pwd1"]);
				}
			}

			$view = new View("login");
		} else {
			header('Location: /utilisateur');
			exit;
		}
	}

	// Deconnexion de l'utilisateur
	public function deconnexionAction() {
		Security::disconnect();
		header('Location: /');
	}

	// Mot de passe oublié + envoie mail
	public function forgottenPwdShowAction() {
		if (!isset($_SESSION["id"])) {
			if (!empty($_POST) && isset($_POST['email'])) {
				$user = new UserModel();

				if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					$_POST['est_active'] = true;
					$_POST["message"] = "Le mail n'est pas au bon format";
					$_POST["div"] = "echec";
					$_POST["couleur"] = "rouge";
				} else {
					$user->setEmail(Helpers::cleanMail($_POST["email"]));

					$new_key = Helpers::keyGenerator();

					if ($user->resetPassword($new_key)) {
						$_POST['est_active'] = true;
						$_POST["message"] = "Un mail vient d'être envoyé à cette adresse avec un lien de réinitialisation";
						$_POST["div"] = "succes";
						$_POST["couleur"] = "vert-clair";

						if ($user->verifieMailExiste()) {
							Mailer::envoieMail(
								$_POST["email"],
								"",
								"",
								'Réinitialisation de votre mot de passe sur ' . LANG["general"]["website_title"] . '!',
								'<p>Bonjour !</p>
							<p>Vous venez de faire une demande de réinitialisation de votre mot de passe.</p>
							<p>En cliquant sur le lien suivant, vous pourrez le modifier. <a href="' . URLSITE . '/password-reset/' . $new_key . '">Modifier mon mot de passe</a></p>
							<p>Si ce n\'est pas vous, changez votre mot de passe depuis votre dashboard le plus vite possible et contacter un administrateur du site.</p>
							<p>Bonne journée, l\'équipe ' . LANG["general"]["website_title"] . ' !</p>
							<p><small>Ce mail est automatique. Les messages envoyés à cette adresse ne seront pas lus.</small></p>'
							);
						}
					} else {
						$_POST['est_active'] = true;
						$_POST["message"] = "Il y a eu un probleme, veuillez reessayer.";
						$_POST["div"] = "echec";
						$_POST["couleur"] = "rouge";
					}
				}
				$view = new View("forgottenPwd");
			} else {
				$view = new View("forgottenPwd");
			}
			// header('Location: /forgottenPwd');
		} else {
			// header('Location: /');
		}
	}

	// Vue du mot de passe oublié
	public function showResetAction() {
		if (isset($_POST)) {
			$view = new View("resetPwd");
		} else {
			header('Location: /');
		}
	}

	// Changement de mot de passe
	public function updatePasswordAction() {

		if (isset($_POST)) {

			$err = FormValidator::checkPasswordFitAndMatch($_POST['pwd1'], $_POST['pwd2']);

			if (sizeof($err) == 0) {
				$user = new UserModel();

				if ($user->updatePassword(Helpers::cryptPassword($_POST["pwd2"]), $_POST["clef"])) {
					$_POST['est_active'] = true;
					$_POST["message"] = "Le mot de passe a été mis à jour";
					$_POST["div"] = "succes";
					$_POST["couleur"] = "vert";
					// $_POST["id"] = $_POST["clef"];

					$view = new View("login");
				} else {
					$_POST['est_active'] = true;
					$_POST["message"] = "Les mots de passent matchent";
					$_POST["div"] = "succes";
					$_POST["couleur"] = "vert";
					$_POST["id"] = $_POST["clef"];

					$view = new View("resetPwd");
				}

				// $2y$10$OxzJCmqp/er4OLlfEWO6weLwVDBMY5bqfkpFiBcnBQLA7lPdk4s9e
				// $2y$10$9PoAW9DKbqZHr3CCzNNT6u36xKe/tfCgH1zwMD1mZhdr/CeUtT7Ca

			} else {
				$_POST['est_active'] = true;
				$_POST["message"] = $err[0];
				$_POST["div"] = "echec";
				$_POST["couleur"] = "rouge";
				$_POST["id"] = $_POST["clef"];

				$view = new View("resetPwd");
			}
		} else {
			header('Location: /');
		}
	}

	//??
	public function forgottenPwdAction() {
		if (!isset($_SESSION["id"])) {
		} else {
			// header('Location: /');
		}
	}

	// Activation du compte d'un utilisateur
	public function activationAction($data) {
		if (sizeof($data) != 2) {
			header('Location: /404');
		}

		$user = new UserModel();

		$user->setId(intval($data[0]));
		$user->setEmailKey($data[1]);

		$t = $user->activationCompte();

		$_POST['est_active'] = true;

		if ($t == 1) {
			$_POST["message"] = "Votre compte est maintenant activé !";
			$_POST["div"] = "succes";
			$_POST["couleur"] = "vert-clair";
		} else if ($t == -1) {
			$_POST["message"] = "Il y a eu une erreur. Réessayez plus tard :(";
			$_POST["div"] = "echec";
			$_POST["couleur"] = "rouge-fonce";
		} else if ($t == -2 || $t ==  -4) {
			$_POST["message"] = "Il y a eu un problème avec l'activation. Si l'erreur persiste, contactez l'administration.";
			$_POST["div"] = "avertissement";
			$_POST["couleur"] = "orange-fonce";
		} else if ($t == -3) {
			$_POST["message"] = "Votre compte est déjà activé";
			$_POST["div"] = "avertissement";
			$_POST["couleur"] = "orange-fonce";
		}
		$view = new View("login");
	}

	/**
	 * PAGES POUR ADMINISTRATION
	 */

	// Page de statistiques
	public function statistiquesAction() {
		if (isset($_SESSION["id"])) {
			if (strcmp($_SESSION['role'], "0") == 0) {
				header('Location: /utilisateur');
			} else {
				$view = new View("statistiques", "back");
			}
		} else {
			header('Location: /');
		}
	}

	// Page de l'édition de la langue
	public function editLangAction() {
		if (isset($_POST["langData"])) {
			file_put_contents("assets/json/lang.json", $_POST["langData"]);
		} else if (isset($_SESSION["id"])) {
			if (strcmp($_SESSION['role'], "0") == 0) {
				header('Location: /utilisateur');
			} else {
				$view = new View("editLang", "back");
			}
		} else {
			header('Location: /');
		}
	}

	// Page de gestion des utilisateurs
	public function manageUsersAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			if (strcmp($_SESSION['role'], "0") == 0) {
				header('Location: /utilisateur');
			} else {
				unset($_POST["listUsers"]);
				$_POST["listUsers"] = $user->fetchUsersAdmin();
				$view = new View("manageUsers", "back");
			}
		} else {
			header('Location: /');
		}
	}

	// Edition d'un attribut de l'utilisateur
	public function editUserAttributeAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			if (strcmp($_SESSION['role'], "0") == 0) {
				header('Location: /utilisateur');
			} else {
				$user->editUserAttribute();
				header('Location: /admin/users');
			}
		} else {
			header('Location: /');
		}
	}

	// Supression de certaines données
	public function deleteAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			if (false) {
				header('Location: /utilisateur');
			} else {
				$user->delete();
				header('Location: ' . $_POST["origin"]);
			}
		} else {
			header('Location: /');
		}
	}

	// Supression de certaines données (soft)
	public function softDeleteAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			if (false) {
				header('Location: /utilisateur');
			} else {
				if ($user->softDelete()) {
					Security::disconnect();

					header('Location: ' . $_POST["origin"]);
				} else {
					header('Location: /utilisateur');
				}
			}
		} else {
			header('Location: /');
		}
	}

	public function showWishlistAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			$user->setId($_SESSION['id']);
			$_POST['listWishlist'] = $user->fetchWishlistUser($user->getId());
			$prix_wishlist = 0;
			foreach ($_POST['listWishlist'] as $key => $value) {
				$prix_wishlist += $value["prix_livre"];
			}
			$_POST['prix_wishlist'] = $prix_wishlist;

			$view = new View("wishlist", "back");
		} else {
			header('Location: /');
		}
	}

	public function ajoutWishlistSearchAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			$user->setId($_SESSION['id']);

			echo (json_encode([
				'message' => 'coucou, le bouton etait ' . $_POST['id_bouton'],
				'success' => $user->addWishlist()
			]));

			die();
		} else {
			header('Location: /');
		}
	}

	public function ajoutPanierSearchAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			$user->setId($_SESSION['id']);

			echo (json_encode([
				'message' => 'coucou, le bouton etait ' . $_POST['id_bouton'],
				'success' => $user->addBasket()
			]));

			die();
		} else {
			header('Location: /');
		}
	}

	public function addWishlistAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			$user->setId($_SESSION['id']);

			$user->addWishlist();

			if (isset($_POST['route'])) {
				$_POST['search'] = $_POST['params'];
				header('Location: ' . $_POST['route']);
			} else {
				header('Location: /utilisateur/wishlist');
			}
		} else {
			header('Location: /');
		}
	}

	public function addBasketAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			$user->setId($_SESSION['id']);

			$user->addBasket();

			if (isset($_POST['route'])) {
				header('Location: ' . $_POST['route']);
			} else {
				header('Location: /utilisateur/panier');
			}
		} else {
			header('Location: /');
		}
	}

	public function deleteItemAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			$user->setId($_SESSION['id']);
			if ($user->removeItemBasket($_POST['id_livre_remove'])) {
				header('Location: /utilisateur/panier');
			} else {
				header('Location: /utilisateur');
			}
		} else {
			header('Location: /');
		}
	}

	public function showOrderAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			$user->setId($_SESSION['id']);
			$_POST['listOrder'] = $user->fetchOrderUser($_SESSION['id']);
			$view = new View("order", "back");
		} else {
			header('Location: /');
		}
	}

	public function showPannierAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			$user->setId($_SESSION['id']);
			$_POST['listBasket'] = $user->fetchBasket($user->getId());

			// var_dump($_POST['listBasket']);

			$view = new View("panier", "back");
		} else {
			header('Location: /');
		}
	}

	public function checkoutAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"]) && $_POST["price"] > 0) {
			require_once('assets/Stripe/init.php');
			\Stripe\Stripe::setApiKey(STRIPE_SECRET);

			$_SESSION["items_order"] = $_POST["items"];
			$_SESSION["total_order"] = $_POST["price"];

			header('Content-Type: application/json');

			$YOUR_DOMAIN = URLSITE;

			$checkout_session = \Stripe\Checkout\Session::create([
				'payment_method_types' => ['card'],
				'line_items' => [[
					'price_data' => [
						'currency' => 'eur',
						'unit_amount' => $_POST["price"] * 100,
						'product_data' => [
							'name' => LANG["profil"]["order_from"] . ' ' . LANG["general"]["website_title"],
							'images' => ["https://i.ibb.co/NT48X70/logo.png"],
						],
					],
					'quantity' => 1,
				]],
				'mode' => 'payment',
				'success_url' => $YOUR_DOMAIN . '/utilisateur/checkout/success',
				'cancel_url' => $YOUR_DOMAIN . '/utilisateur/checkout/failed',
			]);
			header("HTTP/1.1 303 See Other");
			header("Location: " . $checkout_session->url);
		} else {
			header('Location: /utilisateur');
		}
	}

	public function checkoutSuccessAction() {
		if (isset($_SESSION["id"])) {
			$user = new UserModel();
			$_POST["items"] = $_SESSION["items_order"];
			$_POST["status"] = 1;
			$_POST["total"] = $_SESSION["total_order"];
			$_POST["user"] = $_SESSION["id"];
			$user->createOrder();
			$user->emptyBasket();
			Mailer::envoieMail(
				$_SESSION["email"],
				$_SESSION["firstname"],
				$_SESSION["lastname"],
				'Votre commande sur ' . LANG["general"]["website_title"] . '!',
				'<p>Bonjour&nbsp;<strong>' . $_SESSION["firstname"] . '</strong>&nbsp;!</p>
					<p>Votre commande de ' . $_POST["total"] . '€ passée le ' . date("Y-m-d H:i:s") .
					' a bien été enregistrée !</p>
					<p>Nous allons la traiter dans les meilleurs délais pour vous garantir une date de livraison de deux jours !</p>
					<p>Vous pouvez acceder à vos commandes&nbsp;<a href="' . URLSITE . '/utilisateur/order">ici</a>&nbsp;!</p>
					<p>&nbsp;</p>
					<p>Merci, l\'équipe ' . LANG["general"]["website_title"] . '</p>'
			);
			unset($_SESSION["items_order"]);
			unset($_SESSION["total_order"]);
			header('Location: /utilisateur/order');
		} else {
			header('Location: /utilisateur');
		}
	}

	public function checkoutFailedAction() {
		if (isset($_SESSION["id"])) {
			$user = new UserModel();
			$_POST["items"] = $_SESSION["items_order"];
			$_POST["status"] = 0;
			$_POST["total"] = $_SESSION["total_order"];
			$_POST["user"] = $_SESSION["id"];
			$user->createOrder();
			Mailer::envoieMail(
				$_SESSION["email"],
				$_SESSION["firstname"],
				$_SESSION["lastname"],
				'Votre commande sur ' . LANG["general"]["website_title"] . '!',
				'<p>Bonjour&nbsp;<strong>' . $_SESSION["firstname"] . '</strong>&nbsp;!</p>
				<p>Malheureusement votre commande de '
					. $_POST["total"] . '€ a &eacute;t&eacute; refus&eacute;e ! Vous pouvez acc&eacute;der &agrave; votre panier <a href="' . URLSITE .
					'/utilisateur/panier">ici</a> et r&eacute;essayer votre commande.</p>
				<p>Vous pouvez acceder &agrave; vos commandes&nbsp;<a href="' . URLSITE .
					'/utilisateur/order">ici</a>&nbsp;!</p>
				<p>&nbsp;</p>
				<p>Merci, l\'&eacute;quipe ' . LANG["general"]["website_title"] . '</p>'
			);
			unset($_SESSION["items_order"]);
			unset($_SESSION["total_order"]);
			header('Location: /utilisateur/order');
		} else {
			header('Location: /utilisateur');
		}
	}
}