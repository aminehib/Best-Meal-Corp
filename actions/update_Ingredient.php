<?php
session_start();


if(!isset($_SESSION["login"])){
    $_SESSION["erreur"] = "Accès Interdit";
     header("Location:/ProjetWeb/pages/recettes.php") ;
     exit() ;
}


if(!isset($_POST["id"]) ){
    header("Location:/ProjetWeb/pages/panier.php") ;
    exit();
}

$id = (int)$_POST["id"] ;

if(!$id){
    header("Location:/ProjetWeb/pages/panier.php") ;
    exit();
}



require_once __DIR__."/../Autoload.php" ;
Autoload::register();

$db = new \gdb\IngredientDB();

$ingredient = $db->getById($id);

if(!$ingredient){
    $_SESSION["erreur"] = "Ingrédient introuvable";
     header("Location:/ProjetWeb/pages/panier.php") ;
     exit() ;
}



//recuperer l'id

$filename = null ;
$name = "" ;

if(isset($_POST["name"])){
    $name = $_POST["name"] ;
}


if(isset($_FILES["img"]) && $_FILES["img"]["error"] == 0){
    $filename = $_FILES["img"]["name"] ;
    $destination = __DIR__."/../pages/images/uploads/".$filename ;
    move_uploaded_file($_FILES["img"]["tmp_name"] , $destination);
}else{
    $filename = $ingredient->image_url ;
}


if(!$filename && !$name){
    $_SESSION["erreur"] = "Aucun champ n'a été rempli";
    header("Location:/ProjetWeb/pages/forms/panier..php");
    exit();
}

if(empty($name)){
    $name = $ingredient->name ;
}



$db->updateIngredient($id ,$name , $filename  );
header("Location:/ProjetWeb/pages/panier.php");
exit();