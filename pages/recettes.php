<?php
session_start();
require_once __DIR__."/../Autoload.php";
Autoload::register();
    // On récupère toutes les recettes, ingrédients et tags pour les afficher sur la page des recettes
    $db = new \gdb\RecepieDB();
    
    $recepies = $db->getAllRecepies();

    $db = new \gdb\IngredientDB();

    $ingredients = $db->getAllIngredients();

    $db = new \gdb\TagDB();

    $tags = $db->getAllTags();


$content = "" ;

if(isset($_SESSION["recherche"])){// Si une recherche a été effectuée, on affiche les résultats de la recherche à la place de toutes les recettes

    $content = $_SESSION["recherche"] ;
    if(empty($content)){// Si la recherche n'a donné aucun résultat, on affiche un message d'erreur
        $content ="<div class=\"empty-state\"><h2>Aucune recette trouvée 😕</h2><p>Essayez avec d'autres mots-clés.</p></div>" ;
    }
    unset($_SESSION["recherche"]);// On supprime la variable de session de recherche pour éviter d'afficher les résultats de la recherche précédente si l'utilisateur rafraîchit la page

}else{// Sinon, on affiche toutes les recettes
    
    ob_start();
    foreach($recepies as $recepie){
        $recepie->getHTML();
    }   
    $content = ob_get_clean();

}
    

// On utilise la classe Template pour afficher la page des recettes en passant le contenu des recettes, les ingrédients et les tags en paramètres
\classe\Template::render($content , $ingredients , $tags);





