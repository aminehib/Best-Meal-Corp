<?php
session_start();

if(!isset($_SESSION["login"])){
    $_SESSION["erreur"] = "Accès Interdit";
    header("Location:/ProjetWeb/pages/recettes.php") ;
    exit() ;
}

$id = null ;

if(!isset($_POST["id"])){// Si l'id n'est pas défini, on redirige vers la page de la recette
    header("Location:/ProjetWeb/pages/recette.php");
    exit();
}

$id = (int) $_POST["id"] ;


if(!$id){ // Si l'id n'est pas un entier, on redirige vers la page de la recette
    header("Location:/ProjetWeb/pages/recette.php");
    exit();
}


require_once __DIR__."/../Autoload.php" ;
Autoload::register();


$db = new \gdb\RecepieDB();
$recette = $db->getById($id);

// Si la recette n'existe pas, on redirige vers la page de la recette avec une erreur
if(!$recette){
    $_SESSION["erreur"] = "Recette introuvable";
     header("Location:/ProjetWeb/pages/panier.php") ;
     exit() ;
}


$name = "" ;
$ingredients = [] ;
$tags = [] ;
$filename = null ;
$description  = null ;
$cookingTime = null ;
$preparationTime = null ;
$servings = null ;
$preparation = null ;



if(isset($_POST["preparation_time"])){
    $preparationTime = (int)$_POST["preparation_time"] ;
}


if(isset($_POST["preparation"])){
    $preparation= $_POST["preparation"] ;
}



if(isset($_POST["description"])){
    $description = $_POST["description"];
}


if(isset($_POST["servings"])){
    $servings = (int) $_POST["servings"] ;
}



if(isset($_POST["title"])){
    $name = $_POST["title"];
}


if(isset($_POST["ingredients"])){
    $ingredients = $_POST["ingredients"] ;
}
if(isset($_POST["tags"] )){
    $tags = $_POST["tags"] ;
}

if(isset($_FILES["img"]) && $_FILES["img"]["error"] == 0){
    
    $filename = $_FILES["img"]["name"];
    $dir = __DIR__ ."/../pages/images/uploads/". $filename;
    move_uploaded_file($_FILES["img"]["tmp_name"], $dir) ;

}else{
    $filename = $recette->image_url ;
}


if(isset($_POST["cooking_time"])){
    $cookingTime = (int)$_POST["cooking_time"] ;
}

// SI AUCUN CHAMP N'EST REMPLI, ON NE FAIT RIEN ET ON REDIRIGE VERS LA PAGE DE LA RECETTE AVEC UNE ERREUR
if(!$name && !$ingredients && !$tags && !$filename && !$cookingTime && !$preparationTime && !$servings && !$description &&!$preparation ){
    $_SESSION["erreur"] = "Aucun champ n'a été rempli" ;
    header("Location:/ProjetWeb/pages/recette.php?id=$id") ;
    exit();
}



$db = new \gdb\RecepieDB();

// On met à jour la recette dans la base de données
$db->updateRecepie($id ,$name ,$description,$ingredients , $tags ,$filename ,$preparationTime, $preparation, $cookingTime ,$servings ) ;   

header("Location:/ProjetWeb/pages/recette.php?id=$id");
exit();





