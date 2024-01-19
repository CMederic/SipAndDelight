<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" ../style/reset.css">
    <link rel="stylesheet" href="../style/styleLogin.css" type="text/css" />
    <link rel="shortcut icon" href="../images/cockail.png" type="image/x-png">
    <title>Connexion</title>
</head>

<body>
    <header><a href="/Projet/accueil.php"> <img src="/Projet/images/cockail.png" alt="cockail" width="64" height="64"> </a>
    </header>
    <main>
        <div class="contenuLogin">
            <h1 class="titrePrincipal">SipAndDelight</h1>
            <form action="" method="post" id="identification">
                <div class="contenuForm">
                    <div>
                        <p>Login</p>
                        <input type="text" name="login" id="login" required> <br>
                    </div>
                    <div>
                        <p>Mot de passe</p>
                        <input type="password" name="mdp" id="mdp" required> <br>
                    </div>
                </div>
                <div>
                    <input id="boutonSubmit" type="submit" value="Valider">
                </div>
            </form>

            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $login = $_POST['login'];
                $mdp = $_POST['mdp'];
                $serv = "127.0.0.1";
                $user = "root";
                $mdp2 = "";
                $base = "test";
                $port = 3306;
                try {
                    $mysqli = new mysqli($serv, $user, $mdp2, $base, $port);
                    $requete = $mysqli->prepare("SELECT getClientByLogin(?,?)");
                    $motdepasse = hash('sha256', $mdp);
                    $requete->bind_param("ss", $login, $motdepasse);
                    $requete->execute();
                    $data = $requete->get_result();
                    $a = $data->fetch_array();
                    $mysqli->close();
                    if ($a[0] != "") {
                        $_SESSION['id_client_bdd'] = $a[0];
                        echo '<script> document.location.href = "https://localhost/Projet/pages/main.php";</script>';
                        exit();
                    } else {
                        echo '<script>alert("Le login et/ou le mot de passe sont incorrects")</script>';
                    }
                } catch (Exception $e) {
                    echo 'Erreur : ' . $e->getMessage();
                }
            }
            ?>
            </form>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" id="wave1">
                <path fill="#1B6FD1" fill-opacity="0.7" d="M0,256L26.7,234.7C53.3,213,107,171,160,154.7C213.3,139,267,149,320,170.7C373.3,192,427,224,480,234.7C533.3,245,587,235,640,218.7C693.3,203,747,181,800,197.3C853.3,213,907,267,960,277.3C1013.3,288,1067,256,1120,234.7C1173.3,213,1227,203,1280,197.3C1333.3,192,1387,192,1413,192L1440,192L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"></path>
            </svg>
        </div>
    </main>
</body>

</html>