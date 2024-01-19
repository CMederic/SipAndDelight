<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" ../style/reset.css">
    <link rel="stylesheet" href=" ../style/styleMain.css">
    <link rel="shortcut icon" href="../images/cockail.png" type="image/x-png">
    <title>Recettes</title>
</head>

<body>
    <header>
        <a href="/Projet/accueil.php" id="imageAccueil" class="droite"> <img src="/Projet/images/cockail.png" alt="cockail" width="64" height="64"> </a>
        <div class="divTitrePrincipal">
            <h1 class="titrePrincipal">SipAndDelight</h1>
        </div>
        <div class="recherche">
            <p id="re">Recherche </p>
            <input type="text" name="recherche" id="recherche" class="search" onkeyup="completion()"> <img src="/Projet/images/loupe.png" alt="loupe" onclick="recherche()">
            <div id="sugg"></div>
        </div>

        <?php
        session_start();
        if ($_SESSION['id_client_bdd'] != '') {
            echo '<div id="client">';
            echo '<label for="client">Bienvenue ' . $_SESSION['id_client_bdd'] . '</label>';
            echo '<select name="client" id="clients">';
            echo '<option value="" selected></option>';
            echo '<option value="deconnexion">déconnexion</option>';
            echo '<option value="parametre">paramètre</option>';
            echo '</select>';
            echo '<a href="monPanier.php" id="panier" name="panier"><img src="/Projet/images/caddie.svg" alt="panier" width="64" height="64"></a>';
            echo '</div>';
        } else {
            echo '
                <div class="gauche">
                    <div class="menuButton">
                        <a href="login.php" id="boutonConnexion" >Connexion</a> 
                        <a href="sign.php" id="boutonInscrire">S\'inscrire</a>
                    </div>
                    <a href="monPanier.php" id="panier" name="panier"><img src="/Projet/images/caddie.svg" alt="panier" width="64" height="64"></a>
                </div>
            ';
        }
        echo '<br>';
        ?>

    </header>
    <nav>
        <?php

        include("Donnees.inc.php");

        if (!isset($_SESSION['chemin'])) {
            $_SESSION['chemin'] = array();
        }

        if (empty($_GET['aliment'])) {
            $aliment = $Hierarchie['Aliment'];
            echo 'Aliment<br>';
            $_SESSION['chemin'] = array('Aliment');
        } else {

            echo $_GET['aliment'] . '<br>';
            $_SESSION['chemin'][] = $_GET['aliment'];
            $aliment = $Hierarchie[$_GET['aliment']];
        }

        foreach ($aliment['sous-categorie'] as $elem) {
            echo '<a href="?aliment=' . $elem . '">' . $elem . '</a><br>';
        }

        echo '<br>';

        foreach ($_SESSION['chemin'] as $path) {
            echo '<a href="?' . $path . '">>' . $path . '</a>';
        }
        ?>

    </nav>

    <div class="mainContent">
        <div class="recetteContent">
            <div id="test"></div>
            <?php
            include("Donnees.inc.php");
            if (!isset($_GET['aliment']) || $_GET['aliment'] == 'Aliment') {
                $coc = array_keys($Recettes);
                foreach ($coc as $c) {
                    $cocktail = array_keys($Recettes[$c]);
                    $array = $Recettes[$c];
                    $titre = $array['titre'];
                    echo '
                    <div class="recette">
                        <a href="main.php?cocktail=' . $c . '" class="list">' . $titre . '</a><br><br>
                    </div>
                ';
                }
            } else {
                $coc = array_keys($Recettes);
                foreach ($coc as $c) {
                    $cocktail = array_keys($Recettes[$c]);
                    $array = $Recettes[$c];
                    $aliment = $array['index'];
                    $titre = $array['titre'];
                    foreach ($aliment as $elem) {
                        if ($elem == $_GET['aliment']) {
                            echo '
                                <div class="recette">
                                    <a href="main.php?cocktail=' . $c . '" class="list">' . $titre . '</a><br><br>
                                </div>
                            ';
                        }
                    }
                }
            }
            ?>
        </div>
        <main>
            <h2 class="choix">Votre choix :</h2>
            <?php
            if (isset($_GET['cocktail'])) {
                $val = $_GET['cocktail'];
                $cocktail = array_keys($Recettes[$val]);
                $array = $Recettes[$val];
                $ingredient = $array['ingredients'];
                $list = explode('|', $ingredient);
                echo '<h2 class="choixRecette">' . $array['titre'] . '</h2>';
                echo '<h2 class="choixRecette"> Ingrédient : </h2>';
                echo '<ul>';
                foreach ($list as $ingre) {
                    echo '<li class="texteRecette">' . $ingre . '</li>';
                }
                echo '</ul>';
                echo '<h2 class="choixRecette">Préparation : </h2>';
                echo '<p class="texteRecette">' . $array['preparation'] . '</p>';


                $accents = array(
                    'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ÿ' => 'y'
                );
                $titreSansParentheses = preg_replace('/\(.+\)/', '', $array['titre']);
                $titreSansEspace = str_replace(' ', '_', trim(strtolower($titreSansParentheses)));
                $titre1LettreMaj = ucfirst($titreSansEspace);
                $titre1sansAccents = strtr($titre1LettreMaj, $accents);
                echo '<br><br><img src="/Projet/photos/' . $titre1sansAccents . '.jpg" alt="">';

                echo ' <form action="" method="post" id="formPanier">
            <input type="submit" value="Ajouter au panier" name="addpanier" id="addPanier">
            </form>';
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if ($_SESSION['id_client_bdd'] != '') {
                        $login = $_POST['login'];
                        $mdp = $_POST['mdp'];
                        $serv = "127.0.0.1";
                        $user = "root";
                        $mdp2 = "";
                        $base = "test";
                        $port = 3306;
                        try {
                            $mysqli = new mysqli($serv, $user, $mdp2, $base, $port); 
                            $requete = $mysqli->prepare("INSERT INTO panierRecettes(login, nom_recette) values(?,?)");
                            $laRecette =  $array['titre'];
                            $login = $_SESSION['id_client_bdd'];
                            $requete->bind_param("ss", $login, $laRecette);
                            $requete->execute();
                            $mysqli->close();
                        } catch (Exception $e) {
                            echo 'Erreur : ' . $e->getMessage();
                        }
                    } else {
                        $_SESSION[$array['titre']] = $array['titre'];
                    }
                }
            }


            ?>

        </main>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" id="wave1">
        <path fill="#1B6FD1" fill-opacity="0.7" d="M0,256L26.7,234.7C53.3,213,107,171,160,154.7C213.3,139,267,149,320,170.7C373.3,192,427,224,480,234.7C533.3,245,587,235,640,218.7C693.3,203,747,181,800,197.3C853.3,213,907,267,960,277.3C1013.3,288,1067,256,1120,234.7C1173.3,213,1227,203,1280,197.3C1333.3,192,1387,192,1413,192L1440,192L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"></path>
    </svg>
</body>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#recherche').keyup(function() {
            var mot = $('#recherche').val();
            if (mot === "") {
                $('.recette').show();
                location.reload();
            };
        })
    });

    function recherche() {
        $(document).ready(function() {
            var mot = $('#recherche').val();
            var list = document.getElementsByClassName('list');
            if (mot === "") {
                $('.recette').show();
                location.reload();
            } else {
                $.ajax({
                    type: 'GET',
                    url: 'search_recipe.php',
                    data: {
                        mot: mot
                    },
                    success: function(response) {
                        $('.recette').hide();
                        $('#test').html(response);

                    }
                });

            }
        });
    }
    document.getElementById('clients').addEventListener('change', function() {
        switch (this.value) {
            case 'deconnexion':
                fetch('deco.php', {
                    method: 'POST',
                }).then(data => {
                    document.location.reload();
                });
                break;
            case 'parametre':
                document.location.href = "https://localhost/Projet/pages/informationChange.php";
                break;
            case 'monpanier':
                document.location.href = "https://localhost/Projet/pages/monPanier.php"
                break;
        }
    })

    function getXhr() {
        var xhr = null;
        if (window.XMLHttpRequest)
            // Navigateur moderne
            xhr = new XMLHttpRequest();
        else if (window.ActiveXObject) {
            // Internet Explorer <7
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
                // IE 6
            } catch (e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
                // IE 5!!
            }
        } else { // XMLHttpRequest non supporté par le navigateur
            alert("Votre navigateur ne supporte pas les objets XHR…");
            xhr = false;
        }
        return xhr;
    }

    function completion() {
        console.log("oui");
        xhr = getXhr();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (xhr.response == "") {
                    document.getElementById("sugg").style.visibility = "hidden";
                } else {
                    var reponse = xhr.responseText.replace(/^\["|"\]$/g, '').replace(/","/g, '');
                    document.getElementById("sugg").innerHTML = reponse;
                    document.getElementById("sugg").style.visibility = "visible";
                }
            }
        }
        xhr.open("POST", "liste_titre.php", true);
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        console.log(document.getElementById("recherche").value);
        xhr.send("mot=" + document.getElementById("recherche").value);
    }

    function mettre_dans_recherche(input){
            $('.recherche').value = input;
    }
</script>