<?php

namespace App\Models;

use App\Core\Database;

class Book extends Database {

	public function __construct() {
		parent::__construct();
	}

	public function fetchBook() {
		return Database::fetchBook4EditAdmin();
	}

	public function getComments() {
		return Database::fetchCommentsForBook();
	}

	public function addComment() {
		return Database::addComment();
	}

	public function searchBook() {
		return Database::fetchBooksByQuery();
	}

	public function fetchLivresStats() {
		$nbLivre = Database::fetchNbLivresStats();

		$nbLivresVendusWeekly = Database::fetchNbOrdersLastWeek();

		$prixWeekly = Database::fetchPriceWeekly();

		$prixAvg = Database::fetchAverageOrder();
		return [$nbLivre, $nbLivresVendusWeekly, $prixWeekly, $prixAvg];
	}
}
