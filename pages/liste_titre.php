<?php
include("Donnees.inc.php");
$mots = explode(",", $_POST['mot']);
$mot = end($mots);
$titres = array();
$coc = array_keys($Recettes);
foreach ($coc as $c) {
    $cocktail = array_keys($Recettes[$c]);
    $array = $Recettes[$c];
    $ingredients = $array['index'];
    foreach($ingredients as $ingredient){
        if(str_contains(strtolower(trim($ingredient)), strtolower(trim($mot)))){
           if(!in_array('<a href=# onclick=mettre_dans_recherche(hello)>'.$ingredient .'</a><br>', $titres)){
            $titres[] = '<a href=# onclick=mettre_dans_recherche(hello)>'.$ingredient .'</a><br>';
           }
            break;
        }
    }
}
echo json_encode($titres, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>