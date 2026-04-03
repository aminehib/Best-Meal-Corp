<?php
namespace classe ;


class Template{

    public static function render($content, $ingredients , $tags){?>

        <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recettes - Livret de Recettes</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css">
    <link rel="stylesheet" href="/ProjetWeb/pages/styles/style.css">
</head>
<body>

<?php include $_SERVER['DOCUMENT_ROOT'] ."/ProjetWeb/pages/includes/header.php"; ?>

<main class="main-content">
    <section class="recettes-page">
        <div class="container">
            <div class="page-title">
                <span class="page-subtitle">Nos spécialités</span>
                <h1>Découvrez nos recettes</h1>
                <p>
                    Parcourez notre sélection de recettes gourmandes, simples et variées
                    pour tous les goûts et toutes les envies.
                </p>
            </div>
            <div class="search-bar">

                <form action="/ProjetWeb/actions/recherche.php" method="GET" class="search-form">

                 <div class="form-group">
                    <label for="nom">Nom de la recette</label>
                    <input type="text" id="nom" name="nom" placeholder="Ex : Pizza, Salade, Gâteau...">
                </div>

                   <div class="form-group">
                    <label for="ingredient-select">Ingrédients</label>
                        <select id="ingredient-select" name="ingredient[]" multiple>
                <?php 
                foreach($ingredients as $ing): ?>
                <option value="<?=$ing->name?>"> <?=$ing->name?> </option>
                <?php endforeach ; ?>
                </select>
                </div>


        <div class="form-group">
            <label for="tag-select">Tags</label>
            <select id="tag-select" name="tag[]" multiple>
                <?php 
                foreach($tags as $tag): ?>
                <option value="<?=$tag->name?>"><?=$tag->name?></option>
                <?php endforeach ; ?>
                    
                
            </select>
        </div>

            <div class="form-actions">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>

                    
                    
                </form>
            </div>

            <div class="recettes-list">
                <?= $content ?>
            </div>
        </div>
    </section>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>

<script>
$(document).ready(function() {
    $('#ingredient-select').selectize({
        placeholder: 'Choisir un ou plusieurs ingrédients',
        plugins: ['remove_button'] /* <-- Ajoute juste cette ligne ici */
    });

    $('#tag-select').selectize({
        placeholder: 'Choisir un ou plusieurs tags',
        plugins: ['remove_button'] /* <-- Et ici aussi */
    });
});
</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/ProjetWeb/pages/includes/footer.php'; ?>

</body>
</html>

</html>


<?php



    }



}