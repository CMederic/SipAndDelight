<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/cockail.png" type="image/x-png">
    <link rel="stylesheet" href=" ../style/reset.css">
    <title>Changement d'informations</title>
</head>

<body>

    <header><a href="/Projet/accueil.php"> <img src="/Projet/images/cockail.png" alt="cockail" width="64" height="64"> </a></header>
    <?php
    $serv = "127.0.0.1";
    $user = "root";
    $mdp2 = "";
    $base = "test";
    $port = 3306;
    try {
        $log = $_SESSION['id_client_bdd'];
        $mysqli = new mysqli($serv, $user, $mdp2, $base, $port);
        $mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 1000);
        $requete = $mysqli->prepare("call getResultSet(?)");
        $requete->bind_param("s", $log);
        $requete->execute();
        $a = $requete->get_result();
        $data = $a->fetch_array();
        $mysqli->close();
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
    }



    echo '<form action="#" id="connexForm" method="post" onsubmit="return MettreEnRouge()">
        <h3> Bonjour ' . $data[0] . ' voici vos informations personnelles : </h3>
        <span id="spanpwd">
            <label id="smdp">Mot de passe : </label>
            <input type="password" name="motdepasse" id="motdepasse" value ="" require>
        </span>
        <input type="checkbox" name="cmdp" id="cmdp" onchange="AfficherLeMotDePasse()"> <br>
        <label id="snom">Nom : </label>
        <input type="text" name="nom" id="nom" value ="' . $data[2] . '" value=> <br>
        <label id="sprenom">Prénom : </label>
        <input type="text" name="prenom" id="prenom" value ="' . $data[3] . '"> <br>
        <label id="ssexe"> Femme </label>';
    if ($data[4] == "Femme") {
        echo  '<input type="radio" name="Choixsexe" id="femme" value="Femme" checked> Homme <input type="radio" name="Choixsexe" id="homme" value="Homme"> <br>';
    } else if ($data[4] == "Homme") {
        echo ' <input type="radio" name="Choixsexe" id="femme" value="Femme"> Homme <input type="radio" name="Choixsexe" id="homme" value="Homme" checked> <br>';
    }

    echo '<label id="semail">Adresse mail : </label>
        <input type="text" name="mail" id="mail" value ="' . $data[5] . '"> <br>
        <label id="sdate_naissance">Date de naissance : </label>
        <input type="date" name="date_de_naissance" id="date_de_naissance" value ="' . $data[6] . '"> <br>
        <label id="sadresse">Adresse : </label>
        <input type="text" name="adresse" id="adresse" value ="' . $data[7] . '"> <br>
        <label id="sadresse_postale">Code postale : </label>
        <input type="text" name="code_postal" id="code_postal" value ="' . $data[8] . '"> <br>
        <label id="sville">Ville : </label>
        <input type="text" name="ville" id="ville" value ="' . $data[9] . '"> <br>
        <label id="stel">Téléphone : </label>
        <input type="number" name="tel" id="tel" value ="' . $data[10] . '"> <br>
        <input type="reset">
        <input type="submit" value="valider">
    </form>';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mdp = $_POST['motdepasse'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $sexe = $_POST['Choixsexe'];
        $mail = $_POST['mail'];
        $date_de_naissance = $_POST['date_de_naissance'];
        $adresse = $_POST['adresse'];
        $code_postal = ($_POST['code_postal'] != "") ? trim($_POST['code_postal']) : 0;
        $ville = $_POST['ville'];
        $tel = $_POST['tel'];
        try {
            $mysqli = new mysqli($serv, $user, $mdp2, $base, $port);
            $requete = $mysqli->prepare("UPDATE test SET mdp = ? , nom = ? , prenom = ? , sexe = ? , adresse_mail = ? , date_de_naissance = ?, adresse = ? , code_postal = ? , ville = ?, telephone = ? WHERE login = ?;");
            $requete->bind_param("sssssssisss", hash('sha256', $mdp), $nom, $prenom, $sexe, $mail, $date_de_naissance, $adresse, $code_postal, $ville, $tel, $_SESSION['id_client_bdd']);
            $requete->execute();
            $mysqli->close();
            header("Location: https://localhost/Projet/pages/informationChange.php");
            exit();
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
    ?>
</body>
    <script>
        function AfficherLeMotDePasse() {
        document.getElementById('motdepasse').type = document.getElementById('cmdp').checked ? 'text' : 'password';
    }
    </script>
</html>