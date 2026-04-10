<?php
session_start();


if(!isset($_SESSION["login"])){
    $_SESSION["erreur"] = "Accès Interdit";
     header("Location:/ProjetWeb/pages/recettes.php") ;
     exit() ;
}

$id = null ;
// On vérifie que l'id du tag à modifier est bien défini
if(!isset($_POST["id"])){
    header("Location:/ProjetWeb/pages/panier.php");
    exit();
}

$id = (int) $_POST["id"] ;

// Si l'id n'est pas un entier ou n'est pas valide, on redirige vers la page de panier
if(!$id){
    header("Location:/ProjetWeb/pages/panier.php");
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




$name = "" ;

if(!empty($_POST["name"])){
    $name = $_POST["name"] ;
}

// Si le champ name est vide, on redirige vers la page de panier avec une erreur
if(!$name){
    $_SESSION["erreur"] = "Le nom du tag ne peut pas être vide, le nom précédent a été conservé";
     header("Location:/ProjetWeb/pages/panier.php") ;
     exit() ;
}

// On modifie le tag dans la base de données
$db->updateTag($id , $name);

header("Location:/ProjetWeb/pages/panier.php");
exit();