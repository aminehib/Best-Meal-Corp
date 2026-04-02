<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une recette - Livret de Recettes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css">
    <link rel="stylesheet" href="/projet-recette/css/style.css">
</head>
<body>

<?php include '../includes/header.php'; ?>

<main class="main-content">
    <section class="form-page">
        <div class="container">
            <div class="page-title">
                <span class="page-subtitle">Administration</span>
                <h1>Ajouter une recette</h1>
                <p>Remplissez le formulaire ci-dessous pour ajouter une nouvelle recette.</p>
            </div>

            <div class="admin-form-box">
                <form action="//projet-recette/actions/ajouter.php" method="POST" enctype="multipart/form-data" class="admin-form">

                    <div class="form-group full-width">
                        <label for="title">Titre</label>
                        <input type="text" id="title" name="title" placeholder="Ex : Pizza Maison">
                    </div>

                    <div class="form-group full-width">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="Décrivez la recette..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="preparation_time">Temps de préparation</label>
                        <input type="number" id="preparation_time" name="preparation_time" placeholder="Ex : 20">
                    </div>

                    <div class="form-group">
                        <label for="cooking_time">Temps de cuisson</label>
                        <input type="number" id="cooking_time" name="cooking_time" placeholder="Ex : 25">
                    </div>

                    <div class="form-group">
                        <label for="servings">Nombre de personnes</label>
                        <input type="number" id="servings" name="servings" placeholder="Ex : 4">
                    </div>

                    <div class="form-group full-width">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="img" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="ingredient-select">Ingrédients</label>
                        <select id="ingredient-select" name="ingredients[]" multiple>
                            <option value="tomate">Tomate</option>
                            <option value="fromage">Fromage</option>
                            <option value="chocolat">Chocolat</option>
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tag-select">Tags</label>
                        <select id="tag-select" name="tags[]" multiple>
                            <option value="dessert">Dessert</option>
                            <option value="léger">Léger</option>
                            <option value="au four">Au four</option>
                           
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Ajouter la recette</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php include '../includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>

<script>
$(document).ready(function() {
    $('#ingredient-select').selectize({
        placeholder: 'Choisir un ou plusieurs ingrédients (ou tapez pour créer)',
        plugins: ['remove_button'],
        create: true, // <-- C'est cette ligne magique qui permet d'ajouter de nouvelles valeurs
        createOnBlur: true // (Optionnel) Valide la création si l'utilisateur clique en dehors du champ
    });

    $('#tag-select').selectize({
        placeholder: 'Choisir un ou plusieurs tags (ou tapez pour créer)',
        plugins: ['remove_button'],
        create: true, // <-- La même chose ici pour les tags
        createOnBlur: true
    });
});
</script>

</body>
</html>