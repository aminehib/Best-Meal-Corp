<?php
session_start() ;

require_once  __DIR__."/../Autoload.php" ;
Autoload::register() ;

$db = new \gdb\IngredientDB() ;
$ingredients = $db->getAllIngredients() ;

$db = new \gdb\TagDB() ;
$tags = $db->getAllTags() ;

include "mon_panier.php";

if(isset($_SESSION["erreur"])){
    ?> <script>var erreur = "<?= $_SESSION["erreur"]?>" </script> ;
    <script src = '/ProjetWeb/pages/js/validation.js'></script>;
    <?php
    unset($_SESSION["erreur"]);
}


