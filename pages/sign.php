<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" ../style/reset.css">
    <link rel="stylesheet" href="../style/styleSign.css">
    <link rel="shortcut icon" href="../images/cockail.png" type="image/x-png">
    <title>Inscription</title>
</head>

<body>
    <header><a href="/Projet/accueil.php"> <img src="/Projet/images/cockail.png" alt="cockail" width="64" height="64"> </a></header>
    <main>
        <h1 class="titrePrincipal">SipAndDelight</h1>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" id="wave1">
            <path fill="#1B6FD1" fill-opacity="0.7" d="M0,256L26.7,234.7C53.3,213,107,171,160,154.7C213.3,139,267,149,320,170.7C373.3,192,427,224,480,234.7C533.3,245,587,235,640,218.7C693.3,203,747,181,800,197.3C853.3,213,907,267,960,277.3C1013.3,288,1067,256,1120,234.7C1173.3,213,1227,203,1280,197.3C1333.3,192,1387,192,1413,192L1440,192L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"></path>
        </svg>
        <form action="" id="connexForm" method="post" onsubmit="return MettreEnRouge()">
            <div class="contenuForm">
                <div class="labels">
                    <label id="slogin">Login</label>
                    <label id="smdp">Mot de passe</label>
                    <label id="snom">Nom</label>
                    <label id="sprenom">Prénom</label>
                    <label> Femme </label>
                    <label>Homme</label>
                    <label id="semail">Adresse mail</label>
                    <label id="sdate_naissance">Date de naissance</label>
                    <label id="sadresse">Adresse</label>
                    <label id="sadresse_postale">Code postale</label>
                    <label id="sville">Ville</label>
                    <label id="stel">Téléphone</label>

                </div>

                <div class="inputs">
                    <input type="text" name="login" id="login" value<?php echo '="'.$_POST['login'].'"'?>>
                    <input type="password" name="motdepasse" id="motdepasse" value<?php echo '="'.$_POST['motdepasse'].'"'?>>
                    <input type="text" name="nom" id="nom" value<?php echo '="'.$_POST['nom'].'"'?>>
                    <input type="text" name="prenom" id="prenom" value<?php echo '="'.$_POST['prenom'].'"'?>>
                    <input type="radio" name="Choixsexe" id="femme" value="Femme" <?php if($_POST['Choixsexe'] == "Femme") echo 'Checked'?>>
                    <input type="radio" name="Choixsexe" id="homme" value="Homme" <?php if($_POST['Choixsexe'] == "Homme") echo 'Checked'?>>
                    <input type="text" name="mail" id="mail" value<?php echo '="'.$_POST['main'].'"'?>>
                    <input type="date" name="naissance" id="naissance" value<?php echo '="'.$_POST['naissance'].'"'?>>
                    <input type="text" name="adresse" id="adresse" value<?php echo '="'.$_POST['adresse'].'"'?>>
                    <input type="text" name="code_postal" id="code_postal" value<?php echo '="'.$_POST['code_postal'].'"'?>>
                    <input type="text" name="ville" id="ville" value<?php echo '="'.$_POST['ville'].'"'?>>
                    <input type="tel" name="tel" id="tel" value<?php echo '="'.$_POST['tel'].'"'?>>

                    <!--<div class=" displayPassword">
                    <input type="checkbox" name="cmdp" id="cmdp" onchange="AfficherLeMotDePasse()"> <br>
                    <label id="smdp"> Afficher</label> -->
                </div>
            </div>
            </div>

            <div id="misc">
                <input type="reset" id="boutonReset">
                <input type="submit" value="valider" id="boutonSubmit">
            </div>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($_POST['login'] == "") {
                    echo '<p id="erreur">Vous devez saisir un login</p>';
                } else if ($_POST['motdepasse'] == "") {
                    echo '<p id="erreur">Vous devez saisir un mot de passe</p>';
                } else {
                    $login = trim($_POST['login']);
                    $mdp = trim($_POST['motdepasse']);
                    $nom = trim($_POST['nom']);
                    if ($nom != "" &&  !(preg_match("/[a-zA-Z]/", $nom))) {
                        echo '<p id="erreur">Le nom contient des caractères spéciaux</p>';
                        exit(1);
                    }
                    $prenom = trim($_POST['prenom']);
                    if ($prenom != "" && !(preg_match("/[a-zA-Z]/", $prenom))) {
                        echo '<p id="erreur">Le prénom contient des caractères spéciaux</p>';
                        exit(1);
                    }
                    $sexe = $_POST['Choixsexe'];
                    $mail = trim($_POST['mail']);
                    if ($mail != "" && !(preg_match("/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/", $mail))) {
                        echo '<p id="erreur">Le mail n\' est pas conforme</p>';
                        exit(1);
                    }
                    $date_de_naissance = trim($_POST['naissance']);

                    if (!($date_de_naissance == "")) {
                        list($Annee, $Mois, $Jour) = explode('-', $date_de_naissance);
                        if (!checkdate($Mois, $Jour, $Annee)) {
                            echo '<p id="erreur">La date n\'est pas valide</p>';
                            exit(1);
                        }
                    }else {
                        $date_de_naissance = null;
                    }
                    $adresse = trim($_POST['adresse']);

                    $code_postal = (isset($_POST['code_postal']) && $_POST['code_postal'] !== "") ? trim($_POST['code_postal']) : 0;

                    if ($code_postal != 0 && !(preg_match("/^[0-9]{5}$/", $code_postal))) {
                        echo '<p id="erreur">Le code postal doit n\'avoir que 5 chiffres</p>';
                        exit(1);
                    }
                    $ville = trim($_POST['ville']);
                    if ($ville != "" && !(preg_match("/^[a-zA-Z]+$/", $ville))) {
                        echo '<p id="erreur">La ville contient des caractères spéciaux</p>';
                        exit(1);
                    }
                    $tel = trim($_POST['tel']);
                    if ($tel != "" && !(preg_match("/^[0-9]{10}$/", $tel))) {
                        echo '<p id="erreur">Le numéro de téléphone n\'est pas valable</p>';
                        exit(1);
                    }
                    $serv = "127.0.0.1";
                    $user = "root";
                    $mdp2 = "";
                    $base = "test";
                    $port = 3306;
                    try {
                        $motdepasse = hash('sha256', $mdp);
                        $mysqli = new mysqli($serv, $user, $mdp2, $base, $port);
                        $requete = $mysqli->prepare("INSERT INTO test (login, mdp, nom, prenom, sexe, adresse_mail, date_de_naissance, adresse, code_postal, ville, telephone) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $requete->bind_param("ssssssssisi", $login, $motdepasse, $nom, $prenom, $sexe, $mail, $date_de_naissance, $adresse, $code_postal, $ville, $tel);
                        $requete->execute();
                        $mysqli->close();
                        header("Location: https://localhost/Projet/pages/login.php");
                    } catch (Exception $e) {
                        if ($e->getMessage() == "Duplicate entry '" . $login . "' for key 'PRIMARY'") {
                            echo '<script>';
                            echo 'alert("Vous ne pouvez pas utiliser ce login");';
                            echo '</script>';
                        }else {
                            echo $e->getMessage();
                        }
                    }
                }
            }
            ?>
        </form>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" id="wave1">
            <path fill="#1B6FD1" fill-opacity="0.7" d="M0,256L26.7,234.7C53.3,213,107,171,160,154.7C213.3,139,267,149,320,170.7C373.3,192,427,224,480,234.7C533.3,245,587,235,640,218.7C693.3,203,747,181,800,197.3C853.3,213,907,267,960,277.3C1013.3,288,1067,256,1120,234.7C1173.3,213,1227,203,1280,197.3C1333.3,192,1387,192,1413,192L1440,192L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"></path>
        </svg>
    </main>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
    function AfficherLeMotDePasse() {
        document.getElementById('motdepasse').type = document.getElementById('cmdp').checked ? 'text' : 'password';
    }

    function MettreEnRouge() {
        $(document).ready(function() {
            var value = document.getElementById('login').value;
            if (value === '') {
                $('#spanlogin').css('border', '3px solid red');
                return false;
            } else {
                $('#spanlogin').css('border', '0');
                return true;
            }
        });
    }
</script>

</html>