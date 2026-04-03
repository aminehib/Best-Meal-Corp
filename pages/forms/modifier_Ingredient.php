<?php
session_start();

if(!isset($_SESSION["login"])) {
    $erreur = urlencode("Accès Interdit");
    header("Location:/ProjetWeb/pages/recettes.php?erreur=$erreur") ;
    exit();
}



if(!isset($_GET["id"])){
    header("Location:/ProjetWeb/pages/recettes.php") ;
    exit();
}

$id =(int) $_GET["id"] ;

if(!$id){
    header("Location:/ProjetWeb/pages/recettes.php") ;
    exit();
}




require_once "/ProjetWeb/Autoload.php";
Autoload::register();


$db = new \classe\IngredientDB();
$ingredient = $db->getById($id);

if(!$ingredient){
    $erreur = urlencode("Ingredient introuvable") ;
    header("Location:/ProjetWeb/pages/recettes.php?erreur=$erreur") ;
    exit();
}

?>

<h1>Modifier un ingrédient</h1>

<form method="POST" action="/ProjetWeb/actions/update_ingredient.php" enctype="multipart/form-data">
    
    <input type="hidden" name="id" value="<?= $ingredient->id ?>">

    <div>
        <label>Nom</label>
        <input type="text" name="name" value="<?= htmlspecialchars($ingredient->name) ?>">
    </div>

    <div>
        <label>Image actuelle</label><br>
        <?php if($ingredient->getImage()): ?>
            <img src="/ProjetWeb/pages/images/ingredients/<?= $ingredient->image_url ?>" width="100">
        <?php else: ?>
            <p>Aucune image</p>
        <?php endif; ?>
    </div>

    <div>
        <label>Nouvelle image</label>
        <input type="file" name="img" >
    </div>

    <button type="submit">Modifier</button>
</form>