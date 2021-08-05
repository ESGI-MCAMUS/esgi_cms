<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Helpers;
use App\Models\Author as AuthorModel;
use App\Models\User as UserModel;

class Authors {
	public function displayAction() {
		$author = new AuthorModel();
		$_POST["author"] = $author->fetchAuthor();
		$_POST["books"] = $author->fetchBooks();
		echo $_POST["authorId"];

		if (isset($_SESSION['id'])) {
			$user = new UserModel();
			$user->setId($_SESSION['id']);
			$_POST["panier_choisi"] = $user->fetchBasketIds($user->getId());
			$_POST["wishlist_choisi"] = $user->fetchWishlistId($user->getId());
		}

		$view = new View("author", "front");
	}

	// Afficher le tableau avec les auteurs
	public function manageAuthorsAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			if (strcmp($_SESSION['role'], "0") == 0) {
				header('Location: /utilisateur');
			} else {
				unset($_POST["listAuthors"]);
				$_POST["listAuthors"] = $user->fetchAuthorsAdmin();
				$view = new View("manageAuthors", "back");
			}
		} else {
			header('Location: /');
		}
	}

	// Afficher la vue pour ajouter un auteur
	public function addAuthorsAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			if (strcmp($_SESSION['role'], "0") == 0) {
				header('Location: /utilisateur');
			} else {
				if (isset($_POST["authorFirstname"]) && isset($_POST["authorLastname"]) && isset($_POST["authorEditor"])) {
					$photo = Helpers::handleImageSubmit("assets/images/authors/pictures/", "add_authorImage");
					$banniere = Helpers::handleImageSubmit("assets/images/authors/banners/", "add_authorBanner");
					if (empty($photo["error"]) && empty($banniere["error"])) {
						$_POST["imgError"] = [];
						$_POST["authorFirstname"] = htmlspecialchars($_POST["authorFirstname"]);
						$_POST["authorLastname"] = htmlspecialchars($_POST["authorLastname"]);
						$_POST["authorEditor"] = addslashes(htmlspecialchars(str_replace("script", "", $_POST["authorEditor"])));
						$_POST["photoName"] = $photo["imageName"];
						$_POST["banniereName"] = $banniere["imageName"];
						$db = $user->addAuthor();
						//var_dump($db);
					} else {
						$_POST["imgError"] = [
							"photo" => $photo["error"],
							"banniere" => $banniere["error"]
						];
					}
					//var_dump($_POST);
					header('Location: /admin/authors');
				} else {
					$view = new View("authorEditor", "back");
				}
			}
		} else {
			header('Location: /');
		}
	}

	// Afficher la vue pour éditer un auteur
	public function editAuthorAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			if (strcmp($_SESSION['role'], "0") == 0) {
				header('Location: /utilisateur');
			} else {
				if (isset($_POST["authorFirstname"]) && isset($_POST["authorLastname"]) && isset($_POST["authorEditor"])) {
					//var_dump($_FILES);
					// Photo de profil
					if ($_FILES["add_authorImage"]["error"] === 4) {
						$_POST["photoName"] = $_POST["oldPhoto"];
					} else {
						$photo = Helpers::handleImageSubmit("assets/images/authors/pictures/", "add_authorImage");
						if (empty($photo["error"])) {
							$_POST["photoName "] = $photo["imageName"];
						} else {
							$_POST["photoName"] = $_POST["oldPhoto"];
						}
					}

					// Photo de bannière
					if ($_FILES["add_authorBanner"]["error"] === 4) {
						$_POST["bannerName"] = $_POST["oldBanner"];
					} else {
						$banniere = Helpers::handleImageSubmit("assets/images/authors/banners/", "add_authorBanner");
						if (empty($banniere["error"])) {
							$_POST["bannerName"] = $banniere["imageName"];
						} else {
							$_POST["bannerName"] = $_POST["oldBanner"];
						}
					}
					$_POST["authorEditor"] = addslashes(htmlspecialchars(str_replace("script", "", $_POST["authorEditor"])));
					//var_dump($_POST);
					$user->editAuthorById();
					header('Location: /admin/authors');
				} else {
					unset($_POST["author"]);
					$_POST["author"] = $user->fetchAuthorById();
					$view = new View("authorEdit", "back");
				}
			}
		} else {
			header('Location: /');
		}
	}
}