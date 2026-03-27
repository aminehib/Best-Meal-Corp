<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de la recette - Livret de Recettes</title>
    <link rel="stylesheet" href="/ProjetWeb/pages/styles/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="main-content">
    <section class="recette-page">
        <div class="container">

            <div class="recette-top">
                <div class="recette-image">
                    <img src="<?= $recette->image_url?>" alt="<?=$recette->name?>">
                </div>

                <div class="recette-info">
                    <span class="page-subtitle">Détail de la recette</span>
                    <h1><?= $recette->title ?></h1>
                    <p class="recette-description">
                        <?= $recette->description ?>
                    </p>

                    <div class="recette-tags">
                        <?php foreach($tags as $tag): ?>
                        <span><?= $tag->name ?></span>
                        <?php endforeach ; ?>
                    </div>
                </div>
            </div>

            <div class="recette-content">
                <div class="ingredients-box">
                    <h2>Ingrédients</h2>
                    <ul>
                        <?php foreach($ingredients as $ing): ?>
                        <li><?= $ing->name ?></li>
                        <?php endforeach ; ?>
                    </ul>
                </div>

                <div class="preparation-box">
                    <h2>Préparation</h2>
                    <p>
                        <?= $recette->preparation ?>
                    </p>
                </div>
            </div>

            
            <?php if(isset($_SESSION["login"])){?>

        <a  class="btn btn-secondary" href = "/ProjetWeb/pages/forms/modifier_Recette.php?id=<?= htmlspecialchars($recette->id) ?>">Modifier</a>
        <a  class="btn btn-secondary" href = "/ProjetWeb/actions/delete_recepie.php?id=<?= htmlspecialchars($recette->id) ?>">Supprimer</a>
        
    <?php }   ?>

            <div class="recette-actions">
                <a href="/ProjetWeb/pages/recettes.php" class="btn btn-secondary">Retour aux recettes</a>
            </div>

        </div>
    </section>
</main>

    <?php  include 'includes/footer.php'; ?>



</body>
</html>