<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/styleAccueil.css" type="text/css" />
    <link rel="shortcut icon" href="./images/cockail.png" type="image/x-png">
    <title>SipAndDelight</title>


</head>

<body>
    <div class="contenuAccueil">
        <h1 class="titrePrincipal">SipAndDelight</h1>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script>
                if ( $(document).ready(function() {
                        const text = document.querySelector(".titrePrincipal");
                        const load = () => {
                            setTimeout(() => {
                                text.textContent = "SipAndDelight";
                            }, 0);
                            setTimeout(() => {
                                text.textContent = "SipAndHappiness";
                            }, 2000);
                            setTimeout(() => {
                                text.textContent = "SipAndPleasure";
                            }, 4000);
                        }
                        load();
                        setInterval(load, 6000);
                    }));
            </script>
        <a href="pages/login.php"><button type="button" id="boutonConnexion">Connexion</button></a>
        <a href="pages/sign.php"><button type="button" id="boutonInscrire">S'inscrire</button></a>
        <a href="pages/main.php"><p id="boutonContinuer">Continuer sans se connecter</p></a>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" id="wave1">
        <path fill="#1B6FD1" fill-opacity="0.7" d="M0,256L26.7,234.7C53.3,213,107,171,160,154.7C213.3,139,267,149,320,170.7C373.3,192,427,224,480,234.7C533.3,245,587,235,640,218.7C693.3,203,747,181,800,197.3C853.3,213,907,267,960,277.3C1013.3,288,1067,256,1120,234.7C1173.3,213,1227,203,1280,197.3C1333.3,192,1387,192,1413,192L1440,192L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"></path>
    </svg>
</body>

</html>