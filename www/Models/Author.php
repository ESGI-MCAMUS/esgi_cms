<?php

namespace App\Models;

use App\Core\Database;

class Author extends Database {

	public function __construct() {
		parent::__construct();
	}

	public function fetchAuthor() {
		return Database::fetchAuthorById();
	}

	public function fetchBooks() {
		return Database::fetchBook4ByAuthor();
	}
}