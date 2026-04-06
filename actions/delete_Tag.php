<?php
session_start();


if(!isset($_SESSION["login"])){
    $_SESSION["erreur"] = "Accès Interdit";
     header("Location:/ProjetWeb/pages/recettes.php") ;
     exit() ;
}

$id = null ;

if(!isset($_GET["id"])){
    $_SESSION["erreur"] = "ID du tag non spécifié";
    header("Location:/ProjetWeb/pages/panier.php");
    exit();
}

$id = (int) $_GET["id"] ;


if(!$id){
    header("Location:/ProjetWeb/pages/panier.php");
    exit();
}




require_once __DIR__."/../Autoload.php" ;
Autoload::register();


$db = new \gdb\TagDB();

$tag = $db->getById($id);

if(!$tag){
    $_SESSION["erreur"] = "Tag introuvable";
    header("Location:/ProjetWeb/pages/panier.php") ;
    exit();
}


if(!$db->deleteTag($id)){
    $_SESSION["erreur"] = "Erreur lors de la suppression du tag";
    header("Location:/ProjetWeb/pages/panier.php") ;
    exit();
}

header("Location:/ProjetWeb/pages/panier.php");
exit();