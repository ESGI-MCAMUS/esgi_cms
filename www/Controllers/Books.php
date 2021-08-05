<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Helpers;
use App\Models\Book as BookModel;
use App\Models\User as UserModel;

class Books {

	/**
	 * PARTIE FRONT OFFICE
	 */
	// Affichage des livres sur le site
	public function displayAction() {
		$book = new BookModel();
		$_POST["book"] = $book->fetchBook();
		$_POST["comments"] = $book->getComments();

		if (isset($_SESSION['id'])) {
			$user = new UserModel();
			$user->setId($_SESSION['id']);
			$_POST["panier_choisi"] = $user->fetchBasketIds($user->getId());
			$_POST["wishlist_choisi"] = $user->fetchWishlistId($user->getId());
		}

		$view = new View("book", "front");
	}

	// Publication d'un commentaire
	public function postCommentAction() {
		$book = new BookModel();
		$result = $book->addComment();
		header('Location: ' . $_POST["back"]);
	}

	// Recherche d'un livre en fonction de son nom ou de son/ses tags
	public function searchAction() {
		$_POST["search"] = "%" . $_POST["search"] . "%";
		$book = new BookModel();
		$_POST["books"] = $book->searchBook();

		if (isset($_SESSION['id'])) {
			$user = new UserModel();
			$user->setId($_SESSION['id']);
			$_POST["panier_choisi"] = $user->fetchBasketIds($user->getId());
			$_POST["wishlist_choisi"] = $user->fetchWishlistId($user->getId());
		}

		$view = new View("search", "front");
	}

	/**
	 * PARTIE BACK OFFICE
	 */

	// Page de gestion des livres
	public function manageBooksAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			if (strcmp($_SESSION['role'], "0") == 0) {
				header('Location: /utilisateur');
			} else {
				unset($_POST["listBooks"]);
				$_POST["listBooks"] = $user->fetchBooksAdmin();
				$view = new View("manageBooks", "back");
			}
		} else {
			header('Location: /');
		}
	}

	// Page d'édition pour ajouter un livre
	public function editBooksAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			if (strcmp($_SESSION['role'], "0") == 0) {
				header('Location: /utilisateur');
			} else {
				unset($_POST["listCategories"]);
				unset($_POST["listAuthor"]);
				$_POST["listCategories"] = $user->fetchCategoriesAdmin();
				$_POST["listAuthor"] = $user->fetchAuthorAdmin();
				$view = new View("bookEditor", "back");
			}
		} else {
			header('Location: /');
		}
	}

	// Page d'édition pour un livre
	public function editBookAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			if (strcmp($_SESSION['role'], "0") == 0) {
				header('Location: /utilisateur');
			} else {
				if (isset($_POST["bookName"]) && isset($_POST["bookEditor"]) && isset($_POST["bookCategory"]) && isset($_POST["bookAuthor"])) {
					if ($_FILES["add_bookImage"]["error"] === 4) {
						$_POST["imgErrors"] = [];
						$_POST["imgName"] = $_POST["oldImage"];
					} else {
						$resultImg = Helpers::handleImageSubmit("assets/images/books/", "add_bookImage");
						$_POST["imgErrors"] = $resultImg["error"];
						$_POST["imgName"] = $resultImg["imageName"];
					}
					$tags = array();
					foreach (explode(",", htmlspecialchars($_POST["bookTags"])) as $key => $value) {
						array_push($tags, $value);
					}
					$_POST["tags"] = json_encode($tags);
					$_POST["bookName"] = htmlspecialchars($_POST["bookName"]);
					$_POST["bookEditor"] = htmlspecialchars(str_replace("script", "", $_POST["bookEditor"]));
					//var_dump($_POST["bookEditor"]);
					if (empty($_POST["imgErrors"])) {
						$queryResult = $user->updateBookById();
					}
?>
<script type="text/javascript">
window.location.href = '/admin/books';
</script>
<?php
					//header('Location: /admin/books');
				} else if (isset($_POST["id"])) {
					unset($_POST["listCategories"]);
					unset($_POST["listAuthor"]);
					unset($_POST["book"]);
					$_POST["listCategories"] = $user->fetchCategoriesAdmin();
					$_POST["listAuthor"] = $user->fetchAuthorAdmin();
					$_POST["book"] = $user->fetchBook4EditAdmin();
					$view = new View("bookEdit", "back");
				} else {
					header('Location: /admin/books');
				}
			}
		} else {
			header('Location: /');
		}
	}

	public function addBookAction() {
		$user = new UserModel();
		if (isset($_SESSION["id"])) {
			if (strcmp($_SESSION['role'], "0") == 0) {
				header('Location: /utilisateur');
			} else {
				unset($_POST["imgErrors"]);
				unset($_POST["imgName"]);
				$tags = array();
				foreach (explode(",", htmlspecialchars($_POST["bookTags"])) as $key => $value) {
					array_push($tags, $value);
				}
				$_POST["tags"] = json_encode($tags);
				$_POST["bookName"] = htmlspecialchars($_POST["bookName"]);
				$_POST["bookEditor"] = htmlspecialchars(str_replace("script", "", $_POST["bookEditor"]));
				$resultImg = Helpers::handleImageSubmit("assets/images/books/", "add_bookImage");
				$_POST["imgErrors"] = $resultImg["error"];
				$_POST["imgName"] = $resultImg["imageName"];
				if (empty($resultImg["error"])) {
					$queryResult = $user->addLivreAdmin();
				}
				header('Location: /admin/books');
			}
		} else {
			header('Location: /');
		}
	}

	public function fetchInformationsAction() {
		$livres = new BookModel();

		echo json_encode($livres->fetchLivresStats());
	}
}