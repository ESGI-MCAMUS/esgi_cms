<?php

namespace App\Controllers;

use App\Core\Security as Secu;
use App\Core\View;

class Security
{


	public function defaultAction()
	{
		echo "Controller security action default";
	}


	public function loginAction()
	{
		$security = new Secu();
		$security->connect();
		echo "Controller security action login";
		$view = new View("login", "front");
	}



	public function logoutAction()
	{
		$view = new View("logout", "front");
		$security = new Secu();
		if ($security->isConnected()) {
			echo "OK";
			$security->disconnect();
			echo "Disconnected successfully";
		} else {
			echo "NOK";
		}
	}
}
