<?php
session_start();


if(!isset($_SESSION["login"])){
    $erreur = urlencode("Accès Interdit");
    header("Location:/ProjetWeb/pages/panier.php?erreur=$erreur") ;
    exit();
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
    $erreur = urlencode("Tag introuvable") ;
    header("Location:/ProjetWeb/pages/panier.php?erreur=$erreur");
    exit();
}




$name = "" ;

if(!empty($_POST["name"])){
    $name = $_POST["name"] ;
}

// Si le champ name est vide, on redirige vers la page de panier avec une erreur
if(!$name){
    $erreur= urlencode("Le champ Name doit etre rempli") ;
    header("Location:/ProjetWeb/pages/panier.php?erreur=$erreur");
    exit();
}

// On modifie le tag dans la base de données
$db->updateTag($id , $name);

header("Location:/ProjetWeb/pages/panier.php");
exit();