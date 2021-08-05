<?php

namespace App\Models;

use App\Core\Database;
use App\Core\Security;

class Categorie extends Database {

	public function __construct() {
		parent::__construct();
	}

	public function fetchCategorie() {
		return Database::fetchCategoriesAdmin();
	}

	public function fetchCategorieById() {
		return Database::fetchCategorieById();
	}

	public function fetchBooksInCategory() {
		return Database::fetchBooksInCategory();
	}

	public function fetchCategoriesStats() {
		$nbCat = Database::fetchNbCategoriesStats();
		$detailParCat = Database::fetchCategoriesGlobals();
		return [$nbCat, $detailParCat];
	}
}
