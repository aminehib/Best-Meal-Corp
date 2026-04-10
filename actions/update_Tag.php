<?php
session_start();

if (!isset($_SESSION["login"])) {
    $_SESSION["erreur"] = "Accès Interdit";
    header("Location:/ProjetWeb/pages/recettes.php");
    exit();
}

$id = null;

if (!isset($_POST["id"])) {
    header("Location:/ProjetWeb/pages/panier.php");
    exit();
}

$id = (int) $_POST["id"];

if (!$id) {
    header("Location:/ProjetWeb/pages/panier.php");
    exit();
}

require_once __DIR__ . "/../Autoload.php";
Autoload::register();

$db = new \gdb\TagDB();
$tag = $db->getById($id);

if (!$tag) {
    $_SESSION["erreur"] = "Tag introuvable";
    header("Location:/ProjetWeb/pages/panier.php");
    exit();
}

$name = "";

if (!empty($_POST["name"])) {
    $name = $_POST["name"];
}

if (!$name) {
    $_SESSION["erreur"] = "Le champ name est obligatoire";
    $_SESSION["pantry_edit_type"] = "tag";
    $_SESSION["pantry_edit_id"] = $id;
    header("Location:/ProjetWeb/pages/panier.php");
    exit();
}

$db->updateTag($id, $name);

header("Location:/ProjetWeb/pages/panier.php");
exit();
