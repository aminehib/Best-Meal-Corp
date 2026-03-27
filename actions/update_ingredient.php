<?php
session_start();


if(!isset($_SESSION["login"])){
    $erreur = urlencode("Accès Interdit");
    header("Location:/ProjetWeb/pages/recettes.php?erreur=$erreur") ;
    exit();
}


if(!isset($_GET["id"]) ){
    header("Location:/ProjetWeb/pages/recettes.php") ;
    exit();
}

$id = (int)$_GET["id"] ;

if(!$id){
    header("Location:/ProjetWeb/pages/recettes.php") ;
    exit();
}



require_once __DIR__."/../Autoload.php" ;
Autoload::register();

$db = new \gdb\IngredientDB();

$ingredient = $db->getById($id);

if(!$ingredient){
    $erreur = urlencode("Ingredient introuvable");
    header("Location:/ProjetWeb/pages/forms/modifier_Ingredientphp?erreur=$erreur");
    exit();
}




//recuperer l'id

$filename = null ;
$name = null ;

if(isset($_GET["name"])){
    $name = $_GET["name"] ;
}


if($_FILES["img"]["error"] == 0){
    $filename = $_FILES["img"]["name"] ;
    move_uploaded_file($_FILES["img"]["tmp_name"] , "/ProjetWeb/pages/images/ingredients/".$filename);
}


if(!$filename && !$name){
    $erreur = "Aucun champ n'a été rempli";
    header("Location:/ProjetWeb/pages/forms/modifier_Ingredient.php?erreur=$erreur");
    exit();
}





$db->update($id ,$name , $filename  );
header("Location:/ProjetWeb/pages/recettes.php");
exit();