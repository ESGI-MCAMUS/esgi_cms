<?php

namespace App\Core;

use Throwable;

class Database {

	private $pdo;
	private $table;

	public function __construct() {
		try {
			$this->pdo = new \PDO(DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME . ";port=" . DBPORT, DBUSER, DBPWD);
			$sql = $this->pdo->prepare("SET NAMES utf8");
			$sql->execute();
		} catch (Exception $e) {
			die("Erreur SQL : " . $e->getMessage());
		}

		//  jclm_   App\Models\User -> jclm_User
		$classExploded = explode("\\", get_called_class());
		$this->table = strtolower(DBPREFIXE . end($classExploded)); //jclm_User
	}


	public function save() {
		//INSERT OU UPDATE
		$column = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);

		$query = $this->pdo->prepare("INSERT INTO " . $this->table . " 
						(" . implode(',', array_keys($column)) . ") 
						VALUES 
						(:" . implode(',:', array_keys($column)) . ") "); //1 


		try {
			$query->execute($column);

			$sql = $this->pdo->prepare("SELECT LAST_INSERT_ID() as id;");
			if ($sql->execute()) {
				$obj = $sql->fetchAll();
				return $obj[0]['id'];
			}
			var_dump("ERREUR LASTINSERTID");

			return false;
		} catch (\Throwable $th) {
			throw $th;
		}
	}

	public function reccuperationKey($id) {
		$column = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);
		$sql = $this->pdo->prepare("SELECT emailKey as clef FROM " . $this->table . " WHERE id = :id");

		if ($sql->execute(['id' => $id])) {
			$obj = $sql->fetch();

			return $obj["clef"];
		}

		return false;
	}

	public function estActive($id) {
		$column = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);
		$sql = $this->pdo->prepare("SELECT state FROM " . $this->table . " WHERE id = :id");

		if ($sql->execute(['id' => $id])) {
			$obj = $sql->fetch();

			return $obj["state"];
		}

		return false;
	}

	public function activateAccount($id) {
		$column = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);
		$sql = $this->pdo->prepare("UPDATE " . $this->table . " SET state=1 WHERE id = :id");

		return $sql->execute(['id' => $id]);
	}

	/**
	 * retourne l'id de l'utilisateur apers sauvegarde
	 */
	public function getID() {
		$column = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);
		$sql = $this->pdo->prepare("SELECT id FROM " . $this->table . " WHERE email = :email");

		if ($sql->execute(['email' => $column["email"]])) {
			$obj = $sql->fetch();
			return $obj["nb"];
		}

		return false;
	}

	public function delete() {
		$sql = $this->pdo->prepare("DELETE FROM " . DBPREFIXE . $_POST["table"] . " WHERE id = :id");

		$ok = $sql->execute(['id' => $_POST["id"]]);

		//var_dump(['ok' => $ok, 'table' => $_POST["table"], 'id' => $_POST["id"], 'error' => $sql->errorInfo()]);

		return $ok;
	}

	public function softDelete() {
		$sql = $this->pdo->prepare("UPDATE `" . DBPREFIXE . $_POST["table"] . "` SET `isDeleted`=1 WHERE `id` = :id ;");

		return $sql->execute(['id' => $_POST["id"]]);
	}

	// retourne le nombre de mails qui correspondent au mail envoyé
	public function verifieMailUnique() {
		$column = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);
		$sql = $this->pdo->prepare("SELECT count(email) as nb FROM " . $this->table . " WHERE email = :email");

		if ($sql->execute(['email' => $column["email"]])) {
			$obj = $sql->fetch();
			return $obj["nb"];
		}

		return false;
	}

	public function checkUser() {
		$column = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);
		$sql = $this->pdo->prepare("SELECT count(email) as nb FROM " . $this->table . " WHERE email = :email");

		if ($sql->execute(['email' => $column["email"]])) {
			$obj = $sql->fetch();
			return $obj->nb;
		}

		return false;
	}

	public function fetchPWD() {
		$column = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);
		$sql = $this->pdo->prepare("SELECT password FROM " . $this->table . " WHERE email = :email");

		if ($sql->execute(['email' => $column["email"]])) {
			$obj = $sql->fetch();
			return $obj['password'];
		}

		return false;
	}

	public function isDeleted() {
		$column = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);
		$sql = $this->pdo->prepare("SELECT isDeleted FROM " . $this->table . " WHERE email = :email");

		if ($sql->execute(['email' => $column["email"]])) {
			$obj = $sql->fetch();
			return $obj['isDeleted'];
		}

		return false;
	}

	public function fetchUserPopulate() {
		$column = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);
		$sql = $this->pdo->prepare("SELECT id, firstname, lastname, email, `role`, country, `state`, createdAt FROM " . $this->table . " WHERE email = :email");

		if ($sql->execute(['email' => $column["email"]])) {
			$obj = $sql->fetch();
			return $obj;
		}

		return false;
	}

	public function fetchUserProfil() {
		$column = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);
		$sql = $this->pdo->prepare("SELECT id, firstname, lastname, email, `role`, `password`, birthDate FROM " . $this->table . " WHERE email = :email");

		if ($sql->execute(['email' => $column["email"]])) {
			$obj = $sql->fetch();
			return $obj;
		}

		return false;
	}

	public function fetchUserById($id) {
		$sql = $this->pdo->prepare("SELECT id, firstname, lastname, email, `role`, birthDate FROM " . $this->table . " WHERE id = :id");

		if ($sql->execute(['id' => $id])) {
			$obj = $sql->fetch();
			return $obj;
		}

		return false;
	}

	// Récupération de la liste des utilisateurs pour la partie administration
	public function fetchUsersAdmin() {
		$sql = $this->pdo->prepare("SELECT `id`, `firstname`,`lastname`,`email`,`role`, `state` FROM " . $this->table . " WHERE 1 ORDER BY `id`");
		if ($sql->execute()) {
			$obj = $sql->fetchAll();
			return $obj;
		}

		return false;
	}

	// Récupération de la liste des livres pour la partie administration
	public function fetchBooksAdmin() {
		$sql = $this->pdo->prepare("SELECT " . DBPREFIXE . "article.id, `title`,`created_at`, `firstname`, `lastname`, " . DBPREFIXE . "category.name as `categoryName`, " . DBPREFIXE . "page.name as `pageName` FROM " . DBPREFIXE . "article LEFT JOIN " . DBPREFIXE . "author ON " . DBPREFIXE . "article.fk_author = " . DBPREFIXE . "author.id LEFT JOIN " . DBPREFIXE . "page ON " . DBPREFIXE . "article.fk_page = " . DBPREFIXE . "page.id LEFT JOIN " . DBPREFIXE . "category ON " . DBPREFIXE . "article.fk_category = " . DBPREFIXE . "category.id ORDER BY id;");
		if ($sql->execute()) {
			$obj = $sql->fetchAll();
			return $obj;
		}

		return false;
	}

	// Modification d'un livre à partir de son id
	public function updateBookById() {
		$sql = $this->pdo->prepare("UPDATE `" . DBPREFIXE . "article` SET `title`=:title,`image_header`=:image,`content`=:content,`fk_category`=:category,`fk_author`=:author,`keywords_json`=:keywords,`edited_at`=CURRENT_TIMESTAMP, `price`=:price WHERE `id` = :id ;");
		if ($sql->execute([
			'title' => $_POST["bookName"],
			'image' => $_POST["imgName"],
			'content' => $_POST["bookEditor"],
			'category' => $_POST["bookCategory"],
			'author' => $_POST["bookAuthor"],
			'keywords' => $_POST["tags"],
			'price' => $_POST["price"],
			'id' => $_POST["bookToUpdate"],
		])) {
			$obj = $sql->fetchAll();
			return $obj;
		}

		return false;
	}

	// Récupération de la liste des catégories pour la partie administration
	public function fetchCategoriesAdmin() {
		$sql = $this->pdo->prepare("SELECT c.id, c.name,c.description, c.image, CONCAT(LEFT(c.description, 32), '...') as shortDescription, (SELECT count(*) FROM " . DBPREFIXE . "article a WHERE a.fk_category = c.id) AS nbBooks FROM " . DBPREFIXE . "category c ORDER BY c.name ASC;");
		if ($sql->execute()) {
			$obj = $sql->fetchAll();
			return $obj;
		}

		return false;
	}

	// Récupération d'une catégorie selon son id
	public function fetchCategorieById() {
		$sql = $this->pdo->prepare("SELECT * FROM " . DBPREFIXE . "category WHERE id = :id");
		if ($sql->execute(["id" => $_POST["categoryId"]])) {
			$obj = $sql->fetchAll();
			return $obj;
		}

		return false;
	}

	// Récupération des livres dans ue catégorie
	public function fetchBooksInCategory() {
		$sql = $this->pdo->prepare("SELECT b.*, (SELECT id FROM " . DBPREFIXE . "author a WHERE a.id = b.fk_author) as authorId, (SELECT firstname FROM " . DBPREFIXE . "author a WHERE a.id = b.fk_author) as authorFirstname, (SELECT lastname FROM " . DBPREFIXE . "author a WHERE a.id = b.fk_author) as authorLastname FROM " . DBPREFIXE . "article b WHERE b.fk_category = :id;");
		if ($sql->execute(["id" => $_POST["categoryId"]])) {
			$obj = $sql->fetchAll();
			return $obj;
		}

		return false;
	}

	// Récupération des livres selon une query
	public function fetchBooksByQuery() {
		$sql = $this->pdo->prepare("SELECT DISTINCT b.*, (SELECT id FROM " . DBPREFIXE . "author a WHERE a.id = b.fk_author) as authorId, (SELECT firstname FROM " . DBPREFIXE . "author a WHERE a.id = b.fk_author) as authorFirstname, (SELECT lastname FROM " . DBPREFIXE . "author a WHERE a.id = b.fk_author) as authorLastname FROM " . DBPREFIXE . "article b WHERE b.`title` LIKE :search OR b.keywords_json LIKE :search;");
		if ($sql->execute(["search" => $_POST["search"]])) {
			$obj = $sql->fetchAll();
			return $obj;
		}

		return false;
	}

	// Récupération de la liste des auteurs pour la partie administration
	public function fetchAuthorsAdmin() {
		$sql = $this->pdo->prepare("SELECT * FROM " . DBPREFIXE . "author ;");
		if ($sql->execute()) {
			$obj = $sql->fetchAll();
			return $obj;
		}

		return false;
	}

	// Ajout d'un auteur dans la base de donnée
	public function addAuthor() {

		$sql = $this->pdo->prepare("INSERT INTO `" . DBPREFIXE . "author`(`firstname`, `lastname`, `profilePicture`, `bannerPicture`, `content`) VALUES (:authorFirstname, :authorLastname, :photoName, :banniereName, :authorEditor)");
		try {
			$sql->execute([
				"authorFirstname" => $_POST["authorFirstname"],
				"authorLastname" => $_POST["authorLastname"],
				"authorEditor" => $_POST["authorEditor"],
				"photoName" => $_POST["photoName"],
				"banniereName" => $_POST["banniereName"],
			]);
			return true;
		} catch (\Throwable $th) {
			return $th;
		}
	}

	// Récupération de la liste des auteurs pour la partie administration
	public function fetchAuthorAdmin() {
		$sql = $this->pdo->prepare("SELECT `id`, `firstname`, `lastname` FROM " . DBPREFIXE . "author;");
		if ($sql->execute()) {
			$obj = $sql->fetchAll();
			return $obj;
		}

		return false;
	}

	// Récupérer l'auteur avec son identifiant
	public function fetchAuthorById() {
		$sql = $this->pdo->prepare("SELECT * FROM " . DBPREFIXE . "author WHERE id = :id");

		if ($sql->execute(['id' => $_POST["id"]])) {
			$obj = $sql->fetch();
			return $obj;
		}

		return false;
	}

	// Éditer l'auteur avec son identifiant
	public function editAuthorById() {
		$sql = $this->pdo->prepare("UPDATE `" . DBPREFIXE . "author` SET `firstname`=:authorFirstname,`lastname`=:authorLastname,`profilePicture`=:photoName,`bannerPicture`=:bannerName,`content`=:authorEditor WHERE `id` = :idAuthor ;");

		if ($sql->execute([
			'idAuthor' => $_POST["idAuthor"],
			'authorFirstname' => $_POST["authorFirstname"],
			'authorLastname' => $_POST["authorLastname"],
			'photoName' => $_POST["photoName"],
			'bannerName' => $_POST["bannerName"],
			'authorEditor' => $_POST["authorEditor"],
		])) {
			$obj = $sql->fetch();
			return $obj;
		}

		return false;
	}

	// Récupération d'un livre grâce à son id
	public function fetchBook4EditAdmin() {
		$sql = $this->pdo->prepare("SELECT * FROM " . DBPREFIXE . "article WHERE `id` = :id;");
		if ($sql->execute(['id' => $_POST["id"]])) {
			$obj = $sql->fetchAll();
			return $obj;
		}

		return false;
	}

	// Récupération d'un livre grâce à son id
	public function fetchBook4ByAuthor() {
		$sql = $this->pdo->prepare("SELECT * FROM " . DBPREFIXE . "article WHERE `fk_author` = :id;");
		if ($sql->execute(['id' => $_POST["id"]])) {
			$obj = $sql->fetchAll();
			return $obj;
		}

		return false;
	}

	// Editer une catégorie
	public function editCategory() {
		$sql = $this->pdo->prepare("UPDATE `" . DBPREFIXE . "category` SET `name`=:name,`description`=:description WHERE `id` = :id ;");
		if ($sql->execute([
			'name' => $_POST["edit_categoryName"],
			'description' => $_POST["edit_categoryDesc"],
			'id' => $_POST["id"]
		])) {
			$obj = $sql->fetchAll();
			return $obj;
		}

		return false;
	}

	// Editer un attribut de l'utilisateur côté admin
	public function editUserAttribute() {
		$sql = $this->pdo->prepare("UPDATE `" . DBPREFIXE . "user` SET " . $_POST["attribute"] . " = :value WHERE `id` = :id ;");
		if ($sql->execute([
			'value' => $_POST["value"],
			'id' => $_POST["id"]
		])) {
			$obj = $sql->fetchAll();
			return $obj;
		}

		return false;
	}

	// Ajout d'une catégorie pour la partie administration
	public function addCategoriesAdmin() {

		$sql = $this->pdo->prepare("INSERT INTO " . DBPREFIXE . "category (`name`, `description`, `image`) VALUES (:name, :description, :imgName);");
		if ($sql->execute(['name' => $_POST["add_categoryName"], 'description' => $_POST["add_categoryDesc"], 'imgName' => $_POST["imgName"]])) {
			$obj = $sql->fetchAll();
			return $obj;
		}

		return false;
	}

	public function updateMail($id) {
		$column = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);

		var_dump($column["email"]);

		$sql = $this->pdo->prepare("UPDATE " . $this->table . " SET email = :email WHERE id = :id");
		return $sql->execute(['email' => $column["email"], 'id' => $id]);
	}

	public function updatePwd($id) {
		$column = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);

		var_dump($column["password"]);

		$sql = $this->pdo->prepare("UPDATE " . $this->table . " SET password = :pwd WHERE id = :id");
		return $sql->execute(['pwd' => $column["password"], 'id' => $id]);
	}

	public function changePasswordUser($key, $pwd) {
		$sql = $this->pdo->prepare("UPDATE " . $this->table . " SET password = :pwd WHERE emailKey = :key");
		return $sql->execute(['key' => $key, ':pwd' => $pwd]);
	}

	// Ajout d'un livre
	public function addLivreAdmin() {
		$sql = $this->pdo->prepare("INSERT INTO `" . DBPREFIXE . "article`(`title`, `image_header`, `content`, `fk_category`, `fk_page`, `fk_author`, `keywords_json`, `price`) VALUES (:title, :imgName, :content, :category, 1, :author, :keywords, :price)");
		if ($sql->execute([
			'title' => $_POST["bookName"],
			'content' => $_POST["bookEditor"],
			'imgName' => $_POST["imgName"],
			'keywords' => $_POST["tags"],
			'category' => $_POST["bookCategory"],
			'author' => $_POST["bookAuthor"],
			'price' => $_POST["price"]
		])) {
			$obj = $sql->fetchAll();
			return $obj;
		}

		return false;
	}

	// Récupération des commentaires pour un livre
	public function fetchCommentsForBook() {
		$sql = $this->pdo->prepare("SELECT c.id, c.comment, created_at, (SELECT id FROM " . DBPREFIXE . "user u WHERE u.id = c.fk_author) as userId, (SELECT firstname FROM " . DBPREFIXE . "user u WHERE u.id = c.fk_author) as userFirstname, (SELECT lastname FROM " . DBPREFIXE . "user u WHERE u.id = c.fk_author) as userLastname FROM " . DBPREFIXE . "comment c WHERE c.`fk_article` = :id;");
		if ($sql->execute(["id" => $_POST["id"]])) {
			$obj = $sql->fetchAll();
			return $obj;
		}

		return false;
	}

	// Ajout d'un commentaire
	public function addComment() {
		$sql = $this->pdo->prepare("INSERT INTO `" . DBPREFIXE . "comment`(`fk_author`, `fk_article`, `comment`) VALUES (:user, :book, :comment);");
		try {
			$sql->execute([
				"user" => $_POST["user"],
				"book" => $_POST["book"],
				"comment" => htmlspecialchars($_POST["comment"])
			]);
			return $sql;
		} catch (\Throwable $th) {
			return $th;
		}
	}

	public function fetchWishlistUser($id) {
		$column = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);

		$sql = $this->pdo->prepare("SELECT wsh.id as id, art.id as id_livre, art.title as titre_livre, aut.id as id_auteur, CONCAT(aut.firstname, ' ', aut.lastname) as nom_auteur, cat.id as id_category, cat.name as category, art.price as prix_livre
			FROM " . DBPREFIXE . "wishlist as wsh
			INNER JOIN " . DBPREFIXE . "article as art on art.id = wsh.fk_livre
			INNER JOIN " . DBPREFIXE . "author as aut on art.fk_author = aut.id
			INNER JOIN " . DBPREFIXE . "category as cat on art.fk_category = cat.id
			WHERE wsh.fk_user = :id;");
		try {
			if ($sql->execute(["id" => $id])) {
				$obj = $sql->fetchAll();

				return $obj;
			}

			return false;
		} catch (\Throwable $th) {
			return $th;
		}
	}

	public function fetchBasketUser($id, array $array_livres) {
		$req = "SELECT art.id as id_livre, art.title as titre_livre, art.price as prix_livre, CONCAT(aut.firstname, ' ', aut.lastname) as nom_auteur, aut.id as id_auteur, cat.name as description_livre, cat.id as id_categorie
					FROM eazf_article as art
						INNER JOIN eazf_author as aut on art.fk_author = aut.id
    					INNER JOIN eazf_category as cat on art.fk_category = cat.id
				where";

		if (sizeof($array_livres) != 0) {

			foreach ($array_livres as $k => $v) {
				$req .= ' art.id = ' . $v . ' OR ';
			}
			$req .= ' art.id = -1';

			$sql = $this->pdo->prepare($req);
			if ($sql->execute(["id" => $id])) {
				$obj = $sql->fetchAll();
				return $obj;
			}
		}
		return false;
	}

	public function fetchWishlistIds($id) {
		$sql = $this->pdo->prepare("SELECT fk_livre FROM `" . DBPREFIXE . "wishlist` WHERE fk_user = :id");
		if ($sql->execute(["id" => $id])) {
			$obj = $sql->fetchAll();

			$tab_ids = [];
			foreach ($obj as $k => $v) {
				array_push($tab_ids, $v['fk_livre']);
			}

			// var_dump($tab_ids);

			return $tab_ids;
		}
		// return (['pasok' => $sql->errorInfo()]);
	}

	public function fetchBasketIds($id) {
		$sql = $this->pdo->prepare("SELECT panier FROM " . $this->table . " WHERE id = :id");
		if ($sql->execute(["id" => $id])) {
			$obj = $sql->fetchAll();
			return $obj;
		}
	}

	// Creation d'une commande
	public function insertWishlist($id) {
		$sql = $this->pdo->prepare("INSERT INTO `" . DBPREFIXE . "wishlist`(`fk_user`, `fk_livre`) VALUES (:id,:book);");
		$sql->execute([
			"id" => $id,
			"book" => $_POST["id_livre_ajout"]
		]);
		return $sql;
	}

	// Creation d'une commande
	public function createOrder() {
		$sql = $this->pdo->prepare("INSERT INTO `" . DBPREFIXE . "orders`(`items`, `status`, `total_amount`, `fk_user`) VALUES (:items, :status, :total, :user);");
		if ($sql->execute([
			"items" => $_POST["items"],
			"status" => $_POST["status"],
			"total" => $_POST["total"],
			"user" => $_POST["user"],
		])) {
			$obj = $sql->fetchAll();
			return $obj;
		}
	}

	// Vider le panier
	public function emptyBasket() {
		$sql = $this->pdo->prepare("UPDATE `" . DBPREFIXE . "user` SET `panier`='[]' WHERE `id`=:id");
		if ($sql->execute([
			"id" => $_SESSION["id"]
		])) {
			$obj = $sql->fetchAll();
			return $obj;
		}
	}

	public function updateBasketUser($basket, $id) {
		$sql = $this->pdo->prepare("UPDATE " . $this->table . " SET panier = :basket WHERE id = :id");
		return $sql->execute(['basket' => $basket, "id" => $id]);
	}

	public function removeItem($id) {
		$sql = $this->pdo->prepare("DELETE FROM " . DBPREFIXE . "user WHERE id = :id");

		$ok = $sql->execute(['id' => $id]);
		return $ok;
	}

	public function fetchOrderUser($id) {
		$sql = $this->pdo->prepare("SELECT id, JSON_LENGTH(items) as nb_items, total_amount, created_at as date_creation, status FROM " . DBPREFIXE . "orders WHERE fk_user = :id");
		if ($sql->execute(["id" => $id])) {
			$obj = $sql->fetchAll();
			return $obj;
		}
	}

	public function changeKeyUser($newKey, $mail) {
		$sql = $this->pdo->prepare("UPDATE " . $this->table . " SET emailKey = :key WHERE email = :mail");
		return $sql->execute(['key' => $newKey, "mail" => $mail]);
	}

	public function fetchNbCategoriesStats() {
		$sql = $this->pdo->prepare("SELECT count(`id`) as id FROM " . DBPREFIXE . "category");
		if ($sql->execute()) {
			$obj = $sql->fetchAll();
			return $obj;
		}
	}

	public function fetchCategoriesGlobals() {
		$sql = $this->pdo->prepare("SELECT cat.name, COUNT(*) FROM " . DBPREFIXE . "article as art INNER JOIN " . DBPREFIXE . "category as cat on art.fk_category = cat.id GROUP BY fk_category");
		if ($sql->execute()) {
			$obj = $sql->fetchAll();
			return $obj;
		}
	}

	public function fetchNbLivresStats() {
		$sql = $this->pdo->prepare("SELECT count(`id`) as id FROM " . DBPREFIXE . "article");
		if ($sql->execute()) {
			$obj = $sql->fetchAll();
			return $obj;
		}
	}

	public function fetchNbOrdersLastWeek() {
		$sql = $this->pdo->prepare("SELECT count(id) as nb_orders_weekly FROM " . DBPREFIXE . "orders WHERE created_at > CURDATE() - INTERVAL 7 DAY");
		if ($sql->execute()) {
			$obj = $sql->fetchAll();
			return $obj;
		}
	}

	public function fetchPriceWeekly() {
		$sql = $this->pdo->prepare("SELECT sum(`total_amount`) FROM " . DBPREFIXE . "orders WHERE created_at > CURDATE() - INTERVAL 7 DAY");
		if ($sql->execute()) {
			$obj = $sql->fetchAll();
			return $obj;
		}
	}

	public function fetchAverageOrder() {
		$sql = $this->pdo->prepare("SELECT avg(`total_amount`) FROM " . DBPREFIXE . "orders WHERE created_at > CURDATE() - INTERVAL 7 DAY");
		if ($sql->execute()) {
			$obj = $sql->fetchAll();
			return $obj;
		}
	}
}
