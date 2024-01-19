<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $serv = "127.0.0.1";
    $user = "root";
    $mdp2 = "";
    $base = "test";
    $port = 3306;
    try {
        $mysqli = new mysqli($serv, $user, $mdp2, $base, $port);
        $requete = $mysqli->prepare("Call DeleteRecette(?,?)");
        $laRecette = $_POST['key'];
        $login = $_SESSION['id_client_bdd'];
        $requete->bind_param("ss", $login, $laRecette);
        $requete->execute();
        $mysqli->close();
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
