<?php
session_start() ;

require_once  __DIR__."/../Autoload.php" ;
Autoload::register() ;

if(isset($_GET["erreur"])){
    ?> <script>var erreur = "<?= urldecode($_GET["erreur"])?>" </script> ;
    <script src = '/ProjetWeb/pages/js/panier.js'></script>;
    <?php
}


$db = new \gdb\IngredientDB() ;
$ingredients = $db->getAllIngredients() ;

$db = new \gdb\TagDB() ;
$tags = $db->getAllTags() ;

include "mon_panier.php";


