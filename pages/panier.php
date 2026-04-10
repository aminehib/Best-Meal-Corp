<?php
session_start();

require_once __DIR__ . "/../Autoload.php";
Autoload::register();

$db = new \gdb\IngredientDB();
$ingredients = $db->getAllIngredients();

$db = new \gdb\TagDB();
$tags = $db->getAllTags();

$erreurPanier = null;
$formulairePanierAOuvrir = null;
$formulaireEditionPanier = null;

if (isset($_SESSION["erreur"])) {
    $erreurPanier = $_SESSION["erreur"];
    unset($_SESSION["erreur"]);
}

if (isset($_SESSION["pantry_open_form"])) {
    $formulairePanierAOuvrir = $_SESSION["pantry_open_form"];
    unset($_SESSION["pantry_open_form"]);
}

if (isset($_SESSION["pantry_edit_type"]) && isset($_SESSION["pantry_edit_id"])) {
    $formulaireEditionPanier = array(
        "type" => $_SESSION["pantry_edit_type"],
        "id" => (int) $_SESSION["pantry_edit_id"]
    );
    unset($_SESSION["pantry_edit_type"]);
    unset($_SESSION["pantry_edit_id"]);
}

include "mon_panier.php";
