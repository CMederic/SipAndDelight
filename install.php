<?php
$serv = "127.0.0.1";
$user = "root";
$mdp2 = "";
$base = "";
$port = 3306;
try {
    $mysqli = new mysqli($serv, $user, $mdp2, $base, $port);
    $creation = "Drop DATABASE IF EXISTS test;
                 CREATE DATABASE test DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
                 USE test;
                 CREATE TABLE `panierRecettes` (`login` varchar(30) NOT NULL, `nom_recette` varchar(1000) NOT NULL );
                 CREATE TABLE `test` (`login` varchar(30) NOT NULL,`mdp` varchar(256) NOT NULL, `nom` varchar(30), `prenom` varchar(30), `sexe` varchar(30), `adresse_mail` varchar(30), `date_de_naissance` date, `adresse` varchar(100), `code_postal` int(5), `ville` varchar(30), `telephone` int(10));
                 ALTER TABLE `test` ADD PRIMARY KEY (`login`), ADD KEY `login` (`login`), ADD KEY `login_2` (`login`); COMMIT;
    ";
    if ($mysqli->multi_query($creation)) {
        do {
        } while ($mysqli->next_result());
    } else {
        throw new Exception($mysqli->error);
    }

    $mysqli->close();
} catch (Exception $e) {
    exit($e->getMessage());
}
?>