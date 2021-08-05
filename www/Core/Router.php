<?php

namespace App\Core;

use App\Core\View;

class Router {

	private $slug;
	private $action;
	private $controller;
	private $data;
	private $routePath = "routes.yml";
	private $listOfRoutes = [];
	private $listOfSlugs = [];


	/*	
		- On passe le slug en attribut
		- Execution de la methode loadYaml
		- Vérifie si le slug existe dans nos routes -> SINON appel la methode exception4040
		- call setController et setAction
	*/
	public function __construct($uir) {
		if (strcmp(explode("/", $uir)[1], 'activation') == 0) {
			$slug = $uir;

			$this->setController('User');
			$this->setAction('activation');

			$data = explode("/", $slug);
			$rem = array_shift($data);
			$rem = array_shift($data);


			$this->setData($data);
		} else if (strcmp(explode("/", $uir)[1], 'categorie') == 0) { // Slug dynamique pour l'affichage d'une catégorie
			$slug = $uir;

			$data = explode("/", $slug);
			if (sizeof($data) !== 3) {
				$this->exception404();
			} else {
				$this->setController('Categories');
				$this->setAction('browse');
				$_POST["categoryId"] = $data[2];
				$this->setData($data);
			}
		} else if (strcmp(explode("/", $uir)[1], 'author') == 0) { // Slug dynamique pour l'affichage d'un auteur
			$slug = $uir;

			$data = explode("/", $slug);
			if (sizeof($data) !== 3) {
				$this->exception404();
			} else {
				$this->setController('Authors');
				$this->setAction('display');
				$_POST["id"] = $data[2];
				$this->setData($data);
			}
		} else if (strcmp(explode("/", $uir)[1], 'book') == 0) { // Slug dynamique pour l'affichage d'un auteur
			$slug = $uir;

			$data = explode("/", $slug);
			if (sizeof($data) !== 3) {
				$this->exception404();
			} else {
				$this->setController('Books');
				$this->setAction('display');
				$_POST["id"] = $data[2];
				$this->setData($data);
			}
		} else if (strcmp(explode("/", $uir)[1], 'password-reset') == 0) { // Slug dynamique pour l'affichage d'un auteur
			$slug = $uir;

			$data = explode("/", $slug);
			if (sizeof($data) !== 3) {
				$this->exception404();
			} else {
				$this->setController('User');
				$this->setAction('showReset');
				$_POST["id"] = $data[2];
				$this->setData($data);
			}
		} else {
			//On récupère le slug dans la super globale SERVER
			//On le transforme en minuscule
			$slug = mb_strtolower($uir);
			$this->slug = $slug;
			$this->loadYaml(explode("/", $slug));

			if (empty($this->listOfRoutes[$this->slug])) $this->exception404();

			/*
			$this->listOfRoutes
								["/liste-des-utilisateurs"]
								["controller"]

		*/
			$this->setController($this->listOfRoutes[$this->slug]["controller"]);
			$this->setAction($this->listOfRoutes[$this->slug]["action"]);
		}
	}


	/*
		$this->routePath = "routes.yml";	
		- On transforme le YAML en array que l'on stock dans listOfRoutes
		- On parcours toutes les routes
			- Si il n'y a pas de controller ou pas d'action -> die()
			- Sinon on alimente un nouveau tableau qui aura pour clé le controller et l'action
	*/
	public function loadYaml() {
		$this->listOfRoutes = yaml_parse_file($this->routePath);
		foreach ($this->listOfRoutes as $slug => $route) {
			if (empty($route["controller"]) || empty($route["action"]))
				die("Parse YAML ERROR");
			$this->listOfSlugs[$route["controller"]][$route["action"]] = $slug;
		}
	}



	public function getSlug($controller = "Main", $action = "default") {
		return $this->listOfSlugs[$controller][$action];
	}

	//ucfirst = fonction upper case first : majuscule la première lettre
	public function setController($controller) {
		$this->controller = ucfirst($controller);
	}

	public function setAction($action) {
		$this->action = $action . "Action";
	}

	public function setData($tmp) {
		$this->data = $tmp;
	}


	public function getController() {
		return $this->controller;
	}

	public function getAction() {
		return $this->action;
	}

	public function getData() {
		return $this->data;
	}

	public function exception404() {
		$view = new View("404", "front");
	}
}
