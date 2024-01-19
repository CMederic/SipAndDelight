<?php
$mots = explode(",", $_GET['mot']);
include("Donnees.inc.php");
$coc = array_keys($Recettes);

foreach ($coc as $c) {
    $array = $Recettes[$c];
    $aliment = $array['index'];
    $titre = $array['titre'];
    $var = true;
    foreach ($mots as $mot) {
        $present = false;
        foreach ($aliment as $ingredient) {
            if (stripos(strtolower(trim($ingredient)), strtolower(trim($mot))) !== false) {
                $present = true;
                break;
            }
        }

        if (!$present) {
            $var = false;
            break;
        }
    }
    if ($var) {
        echo '
            <div class="recette">
                <a href="main.php?cocktail=' . $c . '" class="list">' . $titre . '</a><br><br>
            </div>
        ';
    }
}
