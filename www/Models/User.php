<?php

namespace App\Models;

use App\Core\Database;
use App\Core\Security;

class User extends Database {

	// Composition d'un utilisateur
	private $id = null;
	protected $firstname;
	protected $lastname;
	protected $birthDate;
	protected $email;
	protected $password;
	protected $country;
	protected $state;
	protected $role;
	protected $isDeleted;
	protected $createdAt;
	protected $updatedAt;
	protected $emailKey;


	public function __construct() {
		parent::__construct();
	}

	// id
	public function getId() {
		return $this->id;
	}
	public function setId($id): void {
		$this->id = $id;
	}

	// firstname
	public function getFirstname() {
		return $this->firstname;
	}
	public function setFirstname($firstname): void {
		$this->firstname = $firstname;
	}

	// lastname
	public function getLastname() {
		return $this->lastname;
	}
	function setLastname($lastname): void {
		$this->lastname = $lastname;
	}

	// birthdate
	public function getBirthdate() {
		return $this->birthDate;
	}
	function setBirthdate($birthDate): void {
		$this->birthDate = $birthDate;
	}

	// email
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email): void {
		$this->email = $email;
	}

	// password
	public function getPassword() {
		return $this->password;
	}
	public function setPassword($password): void {
		$this->password = $password;
	}

	// country
	public function getCountry() {
		return $this->country;
	}
	public function setCountry($country): void {
		$this->country = $country;
	}

	// state
	public function getState() {
		return $this->state;
	}
	public function setState($state): void {
		$this->state = $state;
	}

	// role
	public function getRole(): int {
		return $this->role;
	}
	public function setRole(int $role): void {
		$this->role = $role;
	}

	// isDeleted
	public function getIsDeleted(): int {
		return $this->isDeleted;
	}
	public function setIsDeleted(int $isDeleted): void {
		$this->isDeleted = $isDeleted;
	}

	// createAt
	public function getCreatedAt(): int {
		return $this->createdAt;
	}
	public function setCreatedAt($createdAt): void {
		$this->createdAt = $createdAt;
	}

	// updatedAt
	public function getUpdatedAt(): int {
		return $this->updatedAt;
	}
	public function setUpdatedAt($updatedAt): void {
		$this->updatedAt = $updatedAt;
	}

	// get the email key
	public function getEmailKey(): string {
		return $this->emailKey;
	}
	public function setEmailKey($emailKey): void {
		$this->emailKey = $emailKey;
	}


	/* Sauvegarder le nouvel utilisateur cree en base de donnee */
	public function save() {
		return Database::save();
	}

	public function delete() {
		Database::delete();
	}

	public function softDelete() {
		return Database::softDelete();
	}

	/* Verifier si l'utilisateur existe deja en base de donnee */
	public function verifieMailUnique() {
		return (Database::verifieMailUnique() == 0);
	}

	public function verifieMailExiste() {
		return (Database::verifieMailUnique() == 1);
	}

	public function populateSession() {
		// session_start();
		$_SESSION['id'] = $this->id;
		$_SESSION['firstname'] = $this->firstname;
		$_SESSION['lastname'] = $this->lastname;
		$_SESSION['email'] = $this->email;
		$_SESSION['role'] = $this->role;
		$_SESSION['country'] = $this->country;
		$_SESSION['createdAt'] = $this->createdAt;

		// var_dump($_SESSION);
	}

	// on vérifie si les identifiants peuvent permettre une connexion à un compte
	/*
	return 
		0: OK
		1: le mail n'existe pas
		2: pbm de mdp
	*/
	public function tentativeConnexion() {
		$errors = [];

		$issue = 0;

		if (!$this->verifieMailUnique()) {
			$is_deleted = Database::isDeleted();
			$pwd_bd = Database::fetchPWD();

			// var_dump($this->password);

			// var_dump($pwd_bd);



			if (!$is_deleted && password_verify($this->password, $pwd_bd)) { //le mail et le pwd matchent en BD
				// Security::connect();
				$array_utilisateur = Database::fetchUserPopulate();
				if (intval($array_utilisateur["state"]) != 0) {

					$this->id = $array_utilisateur["id"];
					$this->firstname = $array_utilisateur["firstname"];
					$this->lastname = $array_utilisateur["lastname"];
					$this->email = $array_utilisateur["email"];
					$this->role = $array_utilisateur["role"];
					$this->country = $array_utilisateur["country"];
					$this->createdAt = $array_utilisateur["createdAt"];

					$this->populateSession();
				} else {
					array_push($errors, 'account_disabled');
				}
			} else {
				array_push($errors, 'wrong_credentials');
			}
		} else {
			array_push($errors, 'wrong_credentials');
		}

		return $errors;
	}

	public function resetPassword($newKey) {
		return Database::changeKeyUser($newKey, $this->email);
	}

	public function updatePassword($pwd, $key) {
		return Database::changePasswordUser($key, $pwd);
	}

	public function reccupereInfoUser() {
		$array_retour = Database::fetchUserProfil();

		$this->id = $array_retour["id"];
		$this->firstname = $array_retour["firstname"];
		$this->lastname = $array_retour["lastname"];
		$this->email = $array_retour["email"];
		$this->role = $array_retour["role"];
		$this->password = $array_retour["password"];
		$this->birthDate = $array_retour["birthDate"];
	}

	public function retourneInformationsUserParId($id) {
		$array_retour = Database::fetchUserById($id);

		$this->id = $array_retour["id"];
		$this->firstname = $array_retour["firstname"];
		$this->lastname = $array_retour["lastname"];
		$this->email = $array_retour["email"];
		$this->role = $array_retour["role"];
		$this->birthDate = $array_retour["birthDate"];
	}

	public function retourneInformationsUser(): array {
		$array[] = [
			"id" => $this->id,
			"firstname" => $this->firstname,
			"lastname" => $this->lastname,
			"email" => $this->email,
			"role" => $this->role,
			"password" => $this->password,
			"birthDate" => $this->birthDate,
		];

		return $array;
	}

	public function retourneInfosMailInscription(): array {
		$array[] = [
			"firstname" => $this->firstname,
			"lastname" => $this->lastname,
			"email" => $this->email,
			"clef" => $this->emailKey
		];

		return $array;
	}

	public function activationCompte() {
		$status = Database::estActive($this->id);
		if ($status == 0) {
			$clef_db = Database::reccuperationKey($this->id);

			if (!$clef_db) { //erreur db
				return -1;
			} else {
				if (strcmp($clef_db, $this->emailKey) == 0) { // les clefs correspondent
					return (Database::activateAccount($this->id) ? 1 : -4);
				} else { //missmatch
					return -2;
				}
			}
		}
		return -3;
	}

	public function majUserPwd() {
		return Database::updatePwd($this->id);
	}

	public function editCategory() {
		return Database::editCategory();
	}

	public function editUserAttribute() {
		return Database::editUserAttribute();
	}

	public function majUserMail() {
		return Database::updateMail($this->id);
	}

	public function deconnexion() {
		Security::disconnect();
	}

	public function fetchUsersAdmin() {
		return Database::fetchUsersAdmin();
	}

	public function fetchBooksAdmin() {
		return Database::fetchBooksAdmin();
	}

	public function fetchBook4EditAdmin() {
		return Database::fetchBook4EditAdmin();
	}

	public function updateBookById() {
		return Database::updateBookById();
	}

	public function addCategoriesAdmin() {
		return Database::addCategoriesAdmin();
	}

	public function addAuthor() {
		return Database::addAuthor();
	}

	public function fetchAuthorById() {
		return Database::fetchAuthorById();
	}

	public function editAuthorById() {
		return Database::editAuthorById();
	}

	public function fetchAuthorsAdmin() {
		return Database::fetchAuthorsAdmin();
	}

	public function fetchWishlistUser($id) {
		$wishlist = Database::fetchWishlistUser($id);
		$basket = json_decode(Database::fetchBasketIds($this->id)[0]['panier']);

		for ($i = 0; $i < sizeof($wishlist); $i++) {
			$est_dedans = false;
			foreach ($basket as $k2 => $v2) {
				if ($wishlist[$i]['id_livre'] == $v2) {
					$est_dedans = true;
				}
			}
			$wishlist[$i]['pending'] = $est_dedans;
		}
		return $wishlist;
	}

	public function fetchWishlistId($id) {
		return Database::fetchWishlistIds($id);
	}

	public function addWishlist() {
		return Database::insertWishlist($this->id);
	}

	public function fetchBasket($id) {
		$liste = json_decode(Database::fetchBasketIds($this->id)[0]['panier']);
		if (sizeof($liste) == 0) {
			return [];
		} else {
			return Database::fetchBasketUser($this->id, $liste);
		}
	}

	public function fetchBasketIds($id) {
		$liste = json_decode(Database::fetchBasketIds($this->id)[0]['panier']);
		if (sizeof($liste) == 0) {
			return [];
		} else {
			return $liste;
		}
	}

	public function addBasket() {
		$ret = json_decode(Database::fetchBasketIds($this->id)[0]['panier']);

		$est_deja = false;

		foreach ($ret as $k => $v) {
			if ($v == $_POST['id_livre_ajout']) {
				$est_deja = true;
			}
		}

		if (!$est_deja) {
			array_push($ret, intval($_POST['id_livre_ajout']));

			return Database::updateBasketUser(json_encode($ret), $this->id);
		}

		return $ret;
	}

	public function removeItemBasket($id_item) {
		$liste = json_decode(Database::fetchBasketIds($this->id)[0]['panier']);
		$new_liste = [];

		foreach ($liste as $k => $v) {
			if ($id_item != $v) {
				array_push($new_liste, $v);
			}
		}

		return Database::updateBasketUser(json_encode($new_liste), $this->id);
	}

	public function fetchOrderUser($id) {
		$wishlist = Database::fetchOrderUser($this->id);
		return $wishlist;
	}

	public function createOrder() {
		return Database::createOrder();
	}
	public function emptyBasket() {
		return Database::emptyBasket();
	}
}
