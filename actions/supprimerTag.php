<?php
session_start();

// Vérification de l'authentification de l'utilisateur
if(!isset($_SESSION["login"])){
    $_SESSION["erreur"] = "Accès Interdit";
     header("Location:/ProjetWeb/pages/recettes.php") ;
     exit() ;
}


// Vérification que l'id du tag à supprimer est bien défini
if(!isset($_GET["id"])){
    header("Location:/ProjetWeb/recette.php");
    exit();
}


$id =(int) $_POST["id"] ;

// Si l'id n'est pas un entier ou n'est pas valide, on redirige vers la page de la recette
if(!$id){
    $_SESSION["erreur"] = "ID du tag non spécifié";
    header("Location:/ProjetWeb/pages/recettes.php") ;
    exit();
}

require_once __DIR__."/../Autoload.php" ;
Autoload::register();


$db = new \gdb\TagDB();

$tag = $db->getById($id);

// Si le tag n'existe pas, on redirige vers la page de panier avec une erreur
if(!$tag){
    $_SESSION["erreur"] = "Tag introuvable";
     header("Location:/ProjetWeb/pages/panier.php") ;
     exit() ;
}


$db->delete($id);

header("Location:/ProjetWeb/recette.php");
exit();