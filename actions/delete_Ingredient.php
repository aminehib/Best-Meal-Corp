<?php
session_start();


if(!isset($_SESSION["login"])){
    $_SESSION["erreur"] = "Accès Interdit";
     header("Location:/ProjetWeb/pages/recettes.php") ;
     exit() ;
   
}

require_once  __DIR__."/../Autoload.php" ;
Autoload::register() ;


$id = null ;
// On vérifie que l'id de l'ingrédient à supprimer est bien défini
if(!isset($_GET["id"])){
    header("Location:/ProjetWeb/pages/panier.php") ;
    exit();
}

$id = (int) $_GET["id"] ;
// Si l'id n'est pas un entier ou n'est pas valide, on redirige vers la page de panier
if(!$id){
    header("Location:/ProjetWeb/pages/panier.php") ;
    exit();
}



$db = new \gdb\IngredientDB();
$ingredient = $db->getById($id);    
// Si l'ingrédient n'existe pas, on redirige vers la page de panier avec une erreur
if(!$ingredient){
    $_SESSION["erreur"] = "Ingrédient introuvable";
     header("Location:/ProjetWeb/pages/panier.php") ;
     exit() ;
}

// On supprime l'ingrédient de la base de données
// Si la suppression de l'ingrédient échoue, on redirige vers la page de panier avec une erreur
if(!$db->deleteIngredient($id)){
    $_SESSION["erreur"] = "Erreur lors de la suppression de l'ingrédient";
     header("Location:/ProjetWeb/pages/panier.php") ;
     exit() ;
}

header("Location:/ProjetWeb/pages/panier.php") ;
exit();