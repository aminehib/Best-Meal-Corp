<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recettes - Livret de Recettes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css">

    <link rel="stylesheet" href="/projet-recette/css/style.css">

    
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="main-content">
    <section class="recettes-page">
        <div class="container">
            <div class="page-title">
                <span class="page-subtitle">Nos spécialités</span>
                <h1>Découvrez nos recettes</h1>
                <p>
                    Recherchez une recette par nom, ingrédient ou tag et découvrez
                    notre sélection de plats gourmands.
                </p>
            </div>

            <div class="search-form-box">
    <form action="/projet-recette/recettes.php" method="GET" class="search-form">

        <div class="form-group">
            <label for="nom">Nom de la recette</label>
            <input type="text" id="nom" name="nom" placeholder="Ex : Pizza, Salade, Gâteau...">
        </div>

        <div class="form-group">
            <label for="ingredient-select">Ingrédients</label>
            <select id="ingredient-select" name="ingredient[]" multiple>
                <option value="tomate">Tomate</option>
                <option value="fromage">Fromage</option>
                <option value="chocolat">Chocolat</option>
                
            </select>
        </div>

        <div class="form-group">
            <label for="tag-select">Tags</label>
            <select id="tag-select" name="tag[]" multiple>
                <option value="dessert">Dessert</option>
                <option value="léger">Léger</option>
                <option value="au four">Au four</option>
                
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>
</div>

            <div class="recettes-list">

                <div class="recepie">
                    <img src="/projet-recette/images/pizza.jpg" alt="Pizza Maison">
                    <h2>Pizza Maison</h2>
                    <p>Une pizza savoureuse préparée avec des ingrédients frais et une pâte croustillante.</p>
                    <a href="recette.php" class="btn btn-primary">Voir la recette</a>
                </div>

                <div class="recepie">
                    <img src="/projet-recette/images/salade.jpg" alt="Salade Fraîche">
                    <h2>Salade Fraîche</h2>
                    <p>Une salade légère et colorée, idéale pour un repas sain, rapide et rafraîchissant.</p>
                    <a href="recette.php" class="btn btn-primary">Voir la recette</a>
                </div>

                <div class="recepie">
                    <img src="/projet-recette/images/gateau-chocolat.jpg" alt="Gâteau au Chocolat">
                    <h2>Gâteau au Chocolat</h2>
                    <p>Un dessert moelleux et gourmand, parfait pour les amateurs de chocolat.</p>
                    <a href="recette.php" class="btn btn-primary">Voir la recette</a>
                </div>

                <div class="recepie">
                    <img src="/projet-recette/images/pates.jpg" alt="Pâtes Crémeuses">
                    <h2>Pâtes Crémeuses</h2>
                    <p>Des pâtes onctueuses avec une sauce riche et crémeuse pour un repas réconfortant.</p>
                    <a href="recette.php" class="btn btn-primary">Voir la recette</a>
                </div>

                <div class="recepie">
                    <img src="/projet-recette/images/soupe.webp" alt="Soupe de Légumes">
                    <h2>Soupe de Légumes</h2>
                    <p>Une soupe chaude et équilibrée, parfaite pour les journées fraîches et calmes.</p>
                    <a href="recette.php" class="btn btn-primary">Voir la recette</a>
                </div>

                <div class="recepie">
                    <img src="/projet-recette/images/tarte.jpg" alt="Tarte aux Fruits">
                    <h2>Tarte aux Fruits</h2>
                    <p>Une tarte légère et fruitée avec une pâte croustillante et une garniture douce.</p>
                    <a href="recette.php" class="btn btn-primary">Voir la recette</a>
                </div>

            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
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
</body>
</html>