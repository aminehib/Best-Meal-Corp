<?php
session_start();


if(!isset($_SESSION["login"])){
    $erreur = urlencode("Accès Interdit");
    header("Location:/ProjetWeb/pages/recettes.php?erreur=$erreur") ;
    exit();
}

require_once  __DIR__."/../Autoload.php" ;
Autoload::register() ;
$name = "" ;
$filename = null ;



if(isset($_POST["name"])){
    $name = $_POST["name"] ;
}


if(isset($_FILES["img"]) && $_FILES["img"]["error"] == 0){
    $filename = $_FILES["img"]["name"] ;
    $destination = __DIR__."/../pages/images/uploads/".$filename ;
    move_uploaded_file($_FILES["img"]["tmp_name"] , $destination);
}

// Si le champ name est vide, on redirige vers la page de panier avec une erreur
if(!$filename && !$name){
    $erreur = "Aucun champ n'a été rempli";
    header("Location:/ProjetWeb/pages/panier..php?erreur=$erreur");
    exit();
}

$db = new \gdb\IngredientDB();

// On ajoute l'ingrédient à la base de données
$db->addIngredient($name , $filename);

header("Location:/ProjetWeb/pages/panier.php");
exit();