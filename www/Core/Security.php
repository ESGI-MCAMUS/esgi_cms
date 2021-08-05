<?php

namespace App\Core;

class Security {
	public function isConnected() {
		session_start();
		if (isset($_SESSION["isConnected"]))
			return $_SESSION["isConnected"];
		return false;
	}

	public static function connect() {
		session_start();
		$_SESSION["isConnected"] = true;
	}
	public static function disconnect() {
		session_unset();
		session_destroy();
	}
}
