<?php

namespace App\Controller;

use App\Core\View;
use App\Models\Categorie as CategorieModel;
use App\Models\User as UserModel;
use App\Core\Helpers;

class Categories {
	public function displayAction() {
		$categories = new CategorieModel();
		$_POST["categories"] = $categories->fetchCategorie();
		$view = new View("categories", "front");
	}

	public function browseAction() {
		$categories = new CategorieModel();
		$_POST["categorie"] = $categories->fetchCategorieById();
		$_POST["books"] = $categories->fetchBooksInCategory();

		if (isset($_SESSION['id'])) {
			$user = new UserModel();
			$user->setId($_SESSION['id']);
			$_POST["panier_choisi"] = $user->fetchBasketIds($user->getId());
			$_POST["wishlist_choisi"] = $user->fetchWishlistId($user->getId());
		}

		$view = new View("categorie", "front");
	}

	public function manageCategoriesAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			if (strcmp($_SESSION['role'], "0") == 0) {
				header('Location: /utilisateur');
			} else {
				unset($_POST["imgErrors"]);
				unset($_POST["imgName"]);
				if (isset($_POST["add_categoryName"]) && isset($_POST["add_categoryDesc"])) {
					$user = new UserModel();
					$_POST["add_categoryName"] = ucfirst(strtolower($_POST["add_categoryName"]));
					$_POST["add_categoryDesc"] = ucfirst(strtolower($_POST["add_categoryDesc"]));
					$result = Helpers::handleImageSubmit("assets/images/categories/", "add_categoryImage");
					$_POST["imgErrors"] = $result["error"];
					$_POST["imgName"] = $result["imageName"];
					if (empty($result["error"])) {
						$queryResult = $user->addCategoriesAdmin();
					}
				}
				unset($_POST["listCategories"]);
				$_POST["listCategories"] = $user->fetchCategoriesAdmin();
				$view = new View("manageCategories", "back");
			}
		} else {
			header('Location: /');
		}
	}

	// Edition des catégories
	public function editCategorieAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			if (strcmp($_SESSION['role'], "0") == 0) {
				header('Location: /utilisateur');
			} else {
				if (isset($_POST["edit_categoryName"]) && isset($_POST["edit_categoryDesc"])) {
					$user->editCategory();
					header('Location: /admin/categories');
				} else {
					header('Location: /admin/categories');
				}
			}
		} else {
			header('Location: /');
		}
	}

	public function fetchInformationsAction() {
		$categorie = new CategorieModel();

		echo json_encode($categorie->fetchCategoriesStats());
	}
}
