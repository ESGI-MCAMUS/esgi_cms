<?php
$host_name = $_POST["host"];
$database = $_POST["database"];
$user_name = $_POST["user"];
$password = $_POST["password"];
$dbh = null;

try {
  $dbh = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
  echo "1";
} catch (PDOException $e) {
  die("Echec de la connexion à la base de donnée => " . $e);
}