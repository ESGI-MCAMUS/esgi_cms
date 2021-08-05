<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible"
    content="IE=edge">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
  <title>Installer</title>
  <link rel="icon"
    type="image/png"
    href="/assets/images/logo.png" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"
    href="/../assets/css/main.css">
  <link rel="stylesheet"
    href="/../assets/css/components/typographie/typographie.css">
  <link rel="stylesheet"
    href="/../assets/css/components/boutons/boutons.css">
  <link rel="stylesheet"
    href="/../assets/css/components/segments/segments.css">
  <link rel="stylesheet"
    href="/../assets/css/components/inputs/inputs.css">
  <link rel="stylesheet"
    href="/assets/css/components/header/header-main.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
</head>

<body>
  <div class="row">
    <div class="col-4"></div>
    <div class="col-4 center">
      <h1 class="texte souligne-bleu left">Bienvenue dans la configuration</h1>
      <form action="/install.php"
        method="post"
        style="margin-top:10%; margin-bottom:10%">
        <h2 class="texte normal left">
          Base de donnée :
        </h2>
        <br>
        <input required
          type="text"
          name="db_host"
          id="db_host"
          value="<?= isset($_GET["prefill"]) ? 'database' : '' ?>"
          placeholder="Hôte de la base de donnée (ex: localhost)"
          class="input fluide bleu epais">
        <br><br>
        <input required
          type="text"
          name="db_port"
          id="db_port"
          value="<?= isset($_GET["prefill"]) ? '3306' : '' ?>"
          placeholder="Port de la base de donnée (ex: 3306)"
          class="input fluide bleu epais">
        <br>
        <br>
        <input required
          type="text"
          name="db_name"
          id="db_name"
          value="<?= isset($_GET["prefill"]) ? 'eazf_cms_esgi' : '' ?>"
          placeholder="Nom de la base de donnée (ex: mydatabase)"
          class="input fluide bleu epais">
        <br>
        <br>
        <input required
          type="text"
          name="db_user"
          id="db_user"
          value="<?= isset($_GET["prefill"]) ? 'root' : '' ?>"
          placeholder="Nom d'utilisateur de la base de donnée (ex: root)"
          class="input fluide bleu epais">
        <br>
        <br>
        <input required
          type="password"
          name="db_password"
          id="db_password"
          value="<?= isset($_GET["prefill"]) ? 'password' : '' ?>"
          placeholder="Mot de passe de la base de donnée (ex: password)"
          class="input fluide bleu epais">
        <br>
        <br>
        <input required
          type="text"
          name="db_prefixe"
          id="db_prefixe"
          value="<?= isset($_GET["prefill"]) ? 'eazf' : '' ?>"
          placeholder="Préfixe de la base de donnée (ex: ' . $database["
          prefix"]
          . ')"
          class="input fluide bleu epais">
        <br>
        <br>
        <button type="button"
          class="bouton info inverse"
          onclick="testDbConnect()">Tester la connexion</button>
        <br>
        <p class="texte aide tres-petit"
          id="connect_text"></p>
        <br>
        <hr>
        <br>
        <!-- SERVICE DE MAILING -->
        <h2 class="texte normal left">
          Service de mailing :
        </h2>
        <br><br>
        <input required
          type="text"
          name="smtp_host"
          id="smtp_host"
          value="<?= isset($_GET["prefill"]) ? 'smtp.ionos.fr' : '' ?>"
          placeholder="Hôte SMTP (ex: smtp.host.fr)"
          class="input fluide bleu epais">
        <br><br>
        <input required
          type="text"
          name="smtp_username"
          id="smtp_username"
          value="<?= isset($_GET["prefill"]) ? 'geobench@turtletv.fr' : '' ?>"
          placeholder="Nom d'
          utilisateur
          SMTP
          (ex:
          test@host.fr)"
          class="input fluide bleu epais">
        <br><br>
        <input required
          type="password"
          name="smtp_password"
          id="smtp_password"
          value="<?= isset($_GET["prefill"]) ? '&7@2H9f%B*hbe9iAC$&5' : '' ?>"
          placeholder="Mot de passe SMTP"
          class="input fluide bleu epais">
        <br><br>
        <input required
          type="text"
          name="smtp_port"
          id="smtp_port"
          value="<?= isset($_GET["prefill"]) ? '465' : '' ?>"
          placeholder="Port serveur SMTP (ex: 465)"
          class="input fluide bleu epais">
        <br><br>
        <input required
          type="text"
          name="smtp_from_email"
          value="<?= isset($_GET["prefill"]) ? 'cms@esgi.fr' : '' ?>"
          id="smtp_from_email"
          placeholder="Email de l'expéditeur (ex: cms@esgi.fr)"
          class="input fluide bleu epais">
        <br><br>
        <input required
          type="text"
          name="smtp_from_name"
          id="smtp_from_name"
          value="<?= isset($_GET["prefill"]) ? 'CMS ESGI' : '' ?>"
          placeholder="Nom de l'expéditeur (ex: CMS ESGI)"
          class="input fluide bleu epais">
        <br>
        <br>
        <hr>
        <br>
        <!-- SERVICE DE STRIPE -->
        <h2 class="texte normal left">
          Service de paiement Stripe :
        </h2>
        <br>
        <br>
        <input required
          type="text"
          name="stripe_pk"
          id="stripe_pk"
          placeholder="Clé publique de Stripe"
          value="<?= isset($_GET["prefill"]) ? 'pk_test_51JG3aOJ6EFTnNcYzBNxWMWCqwV2zuEp7J0uoJMBJKYuw3E2KE4RaSk337tNdfqNED58enRzmPbAdrbXexsHm0ROK00235jrlXg' : '' ?>"
          class="input fluide bleu epais">
        <br><br>
        <input required
          type="password"
          name="stripe_sk"
          id="stripe_sk"
          value="<?= isset($_GET["prefill"]) ? 'sk_test_51JG3aOJ6EFTnNcYzrKi63lGT1m9OwAYPQ2U5AvT25cCZZEEFx9hOUfieohT8xl24dRfLAHhBrc6GsJR1Ab7wTCl800NzlC3jgw' : '' ?>"
          placeholder="Clé secrète de Stripe"
          class="input fluide bleu epais">

        <br>
        <br>
        <hr>
        <br>

        <!-- COMPTE ADMINISTRATEUR  -->
        <h2 class="texte normal left">
          Configurer un compte admin :
        </h2>
        <br>
        <br>
        <input required
          type="text"
          name="admin_email"
          id="admin_email"
          value="<?= isset($_GET["prefill"]) ? 'mcamus@condorcet93.fr' : '' ?>"
          placeholder="Adresse email de l'administrateur"
          class="input fluide bleu epais">
        <br><br>
        <input required
          type="password"
          name="admin_password"
          id="admin_password"
          value="<?= isset($_GET["prefill"]) ? 'Nm7%z7q*S24M&*NxX93%' : '' ?>"
          placeholder="Mot de passe de l'administrateur"
          class="input fluide bleu epais">

        <br><br>
        <input type="hidden"
          value="start"
          name="start">
        <button class="bouton info inverse fluide">Commencer à utiliser le CMS</button>
        <p class="texte rouge petit">Après utilisation de cet installer, veuillez supprimer le fichier
          <code>install.php</code> et <code>database_test.php</code> de la racine de ce répertoire</p>
      </form>

    </div>
    <div class="col-4"></div>
  </div>
</body>
<script>
function testDbConnect() {
  $.post("database_test.php", {
      host: $('#db_host').val(),
      database: $('#db_name').val(),
      user: $('#db_user').val(),
      password: $('#db_password').val(),
    })
    .done(function(data) {
      if (data == 1) {
        $('#connect_text').html('Connexion à la base de donnée réussie')
      } else {
        $('#connect_text').html(data);
      }

    });
}
</script>

</html>

<?php

if (isset($_POST["start"])) {

  $database = [
    "host" => $_POST["db_host"],
    "port" => $_POST["db_port"],
    "name" => $_POST["db_name"],
    "user" => $_POST["db_user"],
    "password" => $_POST["db_password"],
    "prefix" => $_POST["db_prefixe"]
  ];

  $smtp = [
    "host" => $_POST["smtp_host"],
    "user" => $_POST["smtp_username"],
    "password" => $_POST["smtp_password"],
    "port" => $_POST["smtp_port"],
    "from" => [
      "email" => $_POST["smtp_from_email"],
      "name" => $_POST["smtp_from_name"]
    ]
  ];

  $stripe = [
    "public" => $_POST["stripe_pk"],
    "secret" => $_POST["stripe_sk"],
  ];

  $admin = [
    "firstname" => "Admin",
    "lastname" => "Admin",
    "birthdate" => "2021-01-01",
    "email" => $_POST["admin_email"],
    "password" => password_hash($_POST["admin_password"], PASSWORD_DEFAULT),
    "country" => "FR",
    "state" => 1,
    "role" => 1,
    "isDeleted" => 0,
    "createdAt" => "CURRENT_TIMESTAMP",
    "updatedAt" => "CURRENT_TIMESTAMP",
    "emailKey" => "-1",
    "panier" => "[]"
  ];

  // Test de connexion à la base de données
  $dbh = null;

  try {
    $dbh = new PDO("mysql:host=" . $database["host"] . "; dbname=" . $database["name"] . ";", $database["user"], $database["password"]);
    if ($dbh) {
      $file = ".env";
      $content = '
DBHOST=' . $database["host"] . '
DBNAME=' . $database["name"] . '
DBPORT=' . $database["port"] . '
DBUSER=' . $database["user"] . '
DBPWD=' . $database["password"] . '
DBPREFIXE=' . $database["prefix"] . '_
DBDRIVER=mysql

URLSITE=http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '

# Service de mailing PHPMailer
SMTP_HOST=' . $smtp["host"] . '
SMTP_USERNAME=' . $smtp["user"] . '
SMTP_PASSWORD=' . $smtp["password"] . '
SMTP_PORT=' . $smtp["port"] . '
SMTP_FROM_EMAIL=' . $smtp["from"]["email"] . '
SMTP_FROM_NAME=' . $smtp["from"]["name"] . '

# Système de paiment Stripe
STRIPE_PUBLIC=' . $stripe["public"] . '
STRIPE_SECRET=' . $stripe["secret"] . '

 ENV=dev';

      file_put_contents($file, $content);

      $file = ".env.dev";
      $content = '
DBUSER=' . $database["user"] . '
DBPWD=' . $database["password"] . '
      ';

      file_put_contents($file, $content);

      // Script SQL pour générer la base de donnée
      $sql = '
-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : dim. 25 juil. 2021 à 15:17
-- Version du serveur : 5.7.34
-- Version de PHP : 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `' . $database["prefix"] . '_cms_esgi`
--

-- --------------------------------------------------------

--
-- Structure de la table `' . $database["prefix"] . '_article`
--

DROP TABLE IF EXISTS `' . $database["prefix"] . '_article`;
CREATE TABLE `' . $database["prefix"] . '_article` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `image_header` text,
  `content` longtext,
  `price` float(20,0) NOT NULL,
  `fk_category` int(11) DEFAULT NULL,
  `fk_page` int(11) DEFAULT NULL,
  `fk_author` int(11) DEFAULT NULL,
  `keywords_json` json DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `' . $database["prefix"] . '_author`
--

DROP TABLE IF EXISTS `' . $database["prefix"] . '_author`;
CREATE TABLE `' . $database["prefix"] . '_author` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `profilePicture` varchar(50) NOT NULL,
  `bannerPicture` varchar(50) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `' . $database["prefix"] . '_category`
--

DROP TABLE IF EXISTS `' . $database["prefix"] . '_category`;
CREATE TABLE `' . $database["prefix"] . '_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `' . $database["prefix"] . '_comment`
--

DROP TABLE IF EXISTS `' . $database["prefix"] . '_comment`;
CREATE TABLE `' . $database["prefix"] . '_comment` (
  `id` int(11) NOT NULL,
  `fk_author` int(11) DEFAULT NULL,
  `fk_article` int(11) DEFAULT NULL,
  `comment` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `' . $database["prefix"] . '_orders`
--

DROP TABLE IF EXISTS `' . $database["prefix"] . '_orders`;
CREATE TABLE `' . $database["prefix"] . '_orders` (
  `id` int(11) NOT NULL,
  `items` json NOT NULL,
  `status` int(11) NOT NULL,
  `total_amount` float NOT NULL,
  `fk_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `' . $database["prefix"] . '_page`
--

DROP TABLE IF EXISTS `' . $database["prefix"] . '_page`;
CREATE TABLE `' . $database["prefix"] . '_page` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `fk_author` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `' . $database["prefix"] . '_user`
--

DROP TABLE IF EXISTS `' . $database["prefix"] . '_user`;
CREATE TABLE `' . $database["prefix"] . '_user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `email` varchar(320) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `country` char(2) DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  `isDeleted` tinyint(1) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emailKey` varchar(16) NOT NULL,
  `panier` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `' . $database["prefix"] . '_wishlist`
--

DROP TABLE IF EXISTS `' . $database["prefix"] . '_wishlist`;
CREATE TABLE `' . $database["prefix"] . '_wishlist` (
  `id` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_livre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `' . $database["prefix"] . '_article`
--
ALTER TABLE `' . $database["prefix"] . '_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_artcile_category` (`fk_category`),
  ADD KEY `fk_article_page` (`fk_page`),
  ADD KEY `fk_article_auteur` (`fk_author`);

--
-- Index pour la table `' . $database["prefix"] . '_author`
--
ALTER TABLE `' . $database["prefix"] . '_author`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `' . $database["prefix"] . '_category`
--
ALTER TABLE `' . $database["prefix"] . '_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `' . $database["prefix"] . '_comment`
--
ALTER TABLE `' . $database["prefix"] . '_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comment_author` (`fk_author`),
  ADD KEY `fk_article` (`fk_article`);

--
-- Index pour la table `' . $database["prefix"] . '_orders`
--
ALTER TABLE `' . $database["prefix"] . '_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`fk_user`) USING BTREE;

--
-- Index pour la table `' . $database["prefix"] . '_page`
--
ALTER TABLE `' . $database["prefix"] . '_page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_page_user` (`fk_author`);

--
-- Index pour la table `' . $database["prefix"] . '_user`
--
ALTER TABLE `' . $database["prefix"] . '_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `' . $database["prefix"] . '_wishlist`
--
ALTER TABLE `' . $database["prefix"] . '_wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_whislist_user` (`fk_user`),
  ADD KEY `fk_whislist_livre` (`fk_livre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `' . $database["prefix"] . '_article`
--
ALTER TABLE `' . $database["prefix"] . '_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `' . $database["prefix"] . '_author`
--
ALTER TABLE `' . $database["prefix"] . '_author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `' . $database["prefix"] . '_category`
--
ALTER TABLE `' . $database["prefix"] . '_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `' . $database["prefix"] . '_comment`
--
ALTER TABLE `' . $database["prefix"] . '_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `' . $database["prefix"] . '_orders`
--
ALTER TABLE `' . $database["prefix"] . '_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `' . $database["prefix"] . '_page`
--
ALTER TABLE `' . $database["prefix"] . '_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `' . $database["prefix"] . '_user`
--
ALTER TABLE `' . $database["prefix"] . '_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `' . $database["prefix"] . '_wishlist`
--
ALTER TABLE `' . $database["prefix"] . '_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `' . $database["prefix"] . '_article`
--
ALTER TABLE `' . $database["prefix"] . '_article`
  ADD CONSTRAINT `fk_artcile_category` FOREIGN KEY (`fk_category`) REFERENCES `' . $database["prefix"] . '_category` (`id`),
  ADD CONSTRAINT `fk_article_auteur` FOREIGN KEY (`fk_author`) REFERENCES `' . $database["prefix"] . '_author` (`id`),
  ADD CONSTRAINT `fk_article_page` FOREIGN KEY (`fk_page`) REFERENCES `' . $database["prefix"] . '_page` (`id`);

--
-- Contraintes pour la table `' . $database["prefix"] . '_comment`
--
ALTER TABLE `' . $database["prefix"] . '_comment`
  ADD CONSTRAINT `fk_article` FOREIGN KEY (`fk_article`) REFERENCES `' . $database["prefix"] . '_article` (`id`),
  ADD CONSTRAINT `fk_comment_author` FOREIGN KEY (`fk_author`) REFERENCES `' . $database["prefix"] . '_user` (`id`);

--
-- Contraintes pour la table `' . $database["prefix"] . '_orders`
--
ALTER TABLE `' . $database["prefix"] . '_orders`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`fk_user`) REFERENCES `' . $database["prefix"] . '_user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `' . $database["prefix"] . '_page`
--
ALTER TABLE `' . $database["prefix"] . '_page`
  ADD CONSTRAINT `fk_page_user` FOREIGN KEY (`fk_author`) REFERENCES `' . $database["prefix"] . '_user` (`id`);

--
-- Contraintes pour la table `' . $database["prefix"] . '_wishlist`
--
ALTER TABLE `' . $database["prefix"] . '_wishlist`
  ADD CONSTRAINT `fk_whislist_livre` FOREIGN KEY (`fk_livre`) REFERENCES `' . $database["prefix"] . '_article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_whislist_user` FOREIGN KEY (`fk_user`) REFERENCES `' . $database["prefix"] . '_user` (`id`) ON DELETE CASCADE;
COMMIT;

INSERT INTO `' . $database["prefix"] . '_user`(`firstname`, `lastname`, `birthDate`, `email`, `password`, `country`, `state`, `role`, `isDeleted`, `emailKey`, `panier`) VALUES ("' . $admin["firstname"] . '","' . $admin["lastname"] . '","' . $admin["birthdate"] . '","' . $admin["email"] . '","' . $admin["password"] . '","' . $admin["country"] . '","' . $admin["state"] . '","' . $admin["role"] . '","' . $admin["isDeleted"] . '","' . $admin["emailKey"] . '","' . $admin["panier"] . '");

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

      ';
      $request = $dbh->prepare($sql);
      $request->execute();

      $tofile = 'INSERT INTO `' . $database["prefix"] . '_user`(`firstname`, `lastname`, `birthDate`, `email`, `password`, `country`, `state`, `role`, `isDeleted`, `emailKey`, `panier`) VALUES (`' . $admin["firstname"] . '`,`' . $admin["lastname"] . '`,`' . $admin["birthdate"] . '`,`' . $admin["email"] . '`,`' . $admin["password"] . '`,`' . $admin["country"] . '`,`' . $admin["state"] . '`,`' . $admin["role"] . '`,`' . $admin["isDeleted"] . '`,`' . $admin["emailKey"] . '`,`' . $admin["panier"] . '`);';

      file_put_contents("admin_request.sql", $tofile);

      echo '<script>window.location.href="http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '"</script>';
    }
  } catch (PDOException $e) {
    die("Echec de la connexion à la base de donnée => " . $e);
  }
}

?>