<?php
session_start();

if(!isset($_SESSION["admin"])) {
    $erreur = urlencode("Accès Interdit");
    header("Location:/ProjetWeb/pages/recettes.php?erreur=$erreur") ;
    exit();
}



$id = null ;


if(!isset($_GET["id"])){
    header("Location:/ProjetWeb/pages/recettes.php") ;
    exit();
}

$id = $_GET["id"];

if(!$id){
    header("Location:/ProjetWeb/pages/recettes.php") ;
    exit();
}

require_once "/ProjetWeb/Autoload.php";
Autoload::register();


$db = new \classe\TagDB();
$tag = $db->getById($id);

if(!$tag){
    $erreur = urlencode("Tag introuvable");
    header("Location:/ProjetWeb/pages/recette.php?erreur=$erreur");
    exit();
}
?>

<h1>Modifier un tag</h1>



<form method="POST" action="/ProjetWeb/actions/update_Tag.php">
    
    <input type="hidden" name="id" value="<?= $tag->getId() ?>">

    <div>
        <label>Nom</label>
        <input type="text" name="name" value="<?= htmlspecialchars($tag->getName()) ?>">
    </div>

    <button type="submit">Modifier</button>
</form>