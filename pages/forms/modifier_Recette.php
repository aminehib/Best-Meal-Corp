<?php
session_start();

if(!isset($_SESSION["login"])){
    $erreur = urlencode("Accès Interdit");
    header("Location:/ProjetWeb/pages/recettes.php?erreur=$erreur") ;
    exit();
}



$id = null ;

if(!isset($_GET["id"])){
    header("Location:/ProjetWeb/pages/recette.php") ;
    exit();
}

$id = (int) $_GET["id"];

if(!$id){
    header("Location:/ProjetWeb/pages/recette.php") ;
    exit();
}


require_once __DIR__ ."/../../Autoload.php";
Autoload::register();

echo "hi";
$db = new  \gdb\RecepieDB();
$recepie = $db->getById($id);

if(!$recepie){
    $erreur= urlencode("Recette introuvable");
    header("Location:/ProjetWeb/pages/recette.php?erreur=$erreur");
    exit();
}



if(isset($_GET["erreur"])){?>
    <script > var erreur = "<?=$_GET["erreur"]?>" 
    </script>
    <script src ="js/update_recepie.js"> </script>
<?php 
    unset($_GET["erreur"]) ;
}



$db = new \gdb\IngredientDB();
$ingredients = $db->getAllIngredients() ;// Renvoie la liste de tous les ingredients 
$ing = $db->getIngredients($id) ;// Renvoie la liste des ingredients d'une recette


$db = new \gdb\TagDB();
$tags = $db->getAllTags();// Renvoie la liste des ingredients d'une recette
$tag = $db->getTags($id);// Renvoie la liste des ingredients d'une recette


?>

<form method="GET" action="/ProjetWeb/actions/update_recette.php" enctype="multipart/form-data" >

    <input type="hidden" name="id" value="<?= $id ?>">

    <input type="text" name="new-name" value ="<?= $recepie->name;?>" >



    <!-- ingrédients -->
     <select name="ingredients[]" multiple>
        <?php foreach($ingredients as $ingredient):
            $selected = "" ;
            foreach($ing as $i):
                if($ingredient->id == $i->id):
                    $selected = "selected" ;
                endif;    
            endforeach;      
            ?>
            <option <?= $selected ?> value="<?= $ingredient->id ?>"> <?= $ingredient->name ?> </option>
        <?php 
        endforeach; ?>
        </select>


    <!-- tags -->
    <select name="tags[]" multiple>
        <?php foreach($tags as $t):
            $selected = "";
            foreach($tag as $exitsent_tags):
                if($exitsent_tags->id == $t->id ):
                    $selected = "selected";
                endif;
            endforeach;
            ?>
            <option <?= $selected ?> value="<?= $t->id ?>"> <?= $t->name?> </option>
        <?php endforeach; ?>
    </select>

    <input type="file" name ="img">

    <button type="submit">Modifier</button>
</form>
