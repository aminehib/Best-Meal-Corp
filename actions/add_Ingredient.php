<?php
if(session_status() === PHP_SESSION_NONE){
 session_start();
}
// Ajoute un ingrédient dans la base avec son image éventuelle.


if(!isset($_SESSION["login"])){
     $_SESSION["erreur"] = "Accès Interdit";
    header("Location:/ProjetWeb/pages/recettes.php") ;
    exit();
}

require_once  __DIR__."/../Autoload.php" ;
Autoload::register() ;
$name = "" ;
$filename = null ;



if(isset($_POST["name"])){
    $name = $_POST["name"] ;
}
if(!$name){
    $_SESSION["erreur"] = "Le champ name doit etre rempli";
     header("Location:/ProjetWeb/pages/panier.php") ;
     exit() ;
}


if(isset($_FILES["img"]) && $_FILES["img"]["error"] == 0){
    $filename = $_FILES["img"]["name"] ;
    $destination = __DIR__."/../pages/images/uploads/".$filename ;
    move_uploaded_file($_FILES["img"]["tmp_name"] , $destination);
}

// Si le champ name est vide, on redirige vers la page de panier avec une erreur
if(!$filename && !$name){
    $_SESSION["erreur"] = "Aucun champ n'a été rempli";
    header("Location:/ProjetWeb/pages/panier.php");
    exit();
}

$db = new \gdb\IngredientDB();

// On ajoute l'ingrédient à la base de données
$db->addIngredient($name , $filename);

header("Location:/ProjetWeb/pages/panier.php");
exit();
