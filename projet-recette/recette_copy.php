<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recette Admin - Livret de Recettes</title>
    <link rel="stylesheet" href="/projet-recette/css/style.css">
    
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="main-content admin-recipe-page">
    <section class="recette-page">
        <div class="container">

            <div class="recette-top">

                <!-- IMAGE -->
                <div class="recette-image admin-block">
                    <img src="/projet-recette/images/pizza.jpg" alt="Pizza Maison" id="recipe-image">

                    <form action="/projet-recette/actions/modifier.php" method="POST" enctype="multipart/form-data" class="edit-form-small">
                        <input type="hidden" name="recipe_id" value="1">
                        <input type="hidden" name="action_type" value="image">

                        <label for="image" class="small-label">Changer l'image</label>
                        <input type="file" id="image" name="image" accept="image/*">
                        <button type="submit" class="small-save-btn">Enregistrer</button>
                    </form>
                </div>

                <div class="recette-info">
                    <span class="page-subtitle">Détail de la recette</span>

                    <!-- TITRE -->
                    <form action="/projet-recette/actions/modifier.php" method="POST" class="edit-form-inline">
                        <input type="hidden" name="recipe_id" value="1">
                        <input type="hidden" name="action_type" value="title">

                        <label for="title" class="small-label">Titre</label>
                        <div class="editable-header">
                            <input type="text" id="title" name="title" value="Pizza Maison" class="edit-input-title">
                            <button type="submit" class="edit-inline-btn">✔</button>
                        </div>
                    </form>

                    <!-- DESCRIPTION -->
                    <form action="/projet-recette/actions/modifier.php" method="POST" class="edit-form-inline">
                        <input type="hidden" name="recipe_id" value="1">
                        <input type="hidden" name="action_type" value="description">

                        <label for="description" class="small-label">Description</label>
                        <div class="editable-block-form">
                            <textarea id="description" name="description" class="edit-textarea">
Une pizza savoureuse préparée avec des ingrédients frais, une pâte croustillante et une garniture riche en saveurs. Parfaite pour un repas convivial en famille.
                            </textarea>
                            <button type="submit" class="edit-inline-btn">✔</button>
                        </div>
                    </form>

                    <!-- INFORMATIONS -->
                    <div class="editable-section">
                        <div class="section-head">
                            <span class="section-edit-title">Informations</span>
                        </div>

                        <form action="/projet-recette/actions/modifier.php" method="POST" class="edit-form-meta">
                            <input type="hidden" name="recipe_id" value="1">
                            <input type="hidden" name="action_type" value="infos">

                            <div class="recette-meta">
                                <div class="meta-item">
                                    <label for="prep_time" class="meta-label">Temps de préparation</label>
                                    <input type="text" id="prep_time" name="prep_time" value="20 min">
                                </div>

                                <div class="meta-item">
                                    <label for="cook_time" class="meta-label">Temps de cuisson</label>
                                    <input type="text" id="cook_time" name="cook_time" value="25 min">
                                </div>

                                <div class="meta-item">
                                    <label for="servings" class="meta-label">Nombre de personnes</label>
                                    <input type="text" id="servings" name="servings" value="4 personnes">
                                </div>
                            </div>

                            <button type="submit" class="small-save-btn">Enregistrer</button>
                        </form>
                    </div>

                    <!-- TAGS -->
                    <div class="editable-section">
                        <div class="section-head">
                            <span class="section-edit-title">Tags</span>
                        </div>

                        <form action="/projet-recette/actions/modifier.php" method="POST" class="edit-form-inline">
                            <input type="hidden" name="recipe_id" value="1">
                            <input type="hidden" name="action_type" value="tags">

                            <label for="tags" class="small-label">Tags</label>
                            <div class="editable-block-form">
                                <input type="text" id="tags" name="tags" value="Plat, Fromage, Maison" class="edit-input">
                                <button type="submit" class="edit-inline-btn">✔</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="recette-content">

                <!-- INGREDIENTS -->
                <div class="ingredients-box admin-block">
                    <div class="section-head">
                        <h2>Ingrédients</h2>
                    </div>

                    <form action="/projet-recette/actions/modifier.php" method="POST" class="edit-form-inline">
                        <input type="hidden" name="recipe_id" value="1">
                        <input type="hidden" name="action_type" value="ingredients">

                        <label for="ingredients" class="small-label">Liste des ingrédients</label>
                        <textarea id="ingredients" name="ingredients" class="edit-textarea">
Pâte à pizza
Sauce tomate
Fromage râpé
Olives
Poivrons
Champignons
                        </textarea>
                        <button type="submit" class="small-save-btn">Enregistrer</button>
                    </form>
                </div>

                <!-- PREPARATION -->
                <div class="preparation-box admin-block">
                    <div class="section-head">
                        <h2>Préparation</h2>
                    </div>

                    <form action="/projet-recette/actions/modifier.php" method="POST" class="edit-form-inline">
                        <input type="hidden" name="recipe_id" value="1">
                        <input type="hidden" name="action_type" value="preparation">

                        <label for="preparation" class="small-label">Étapes de préparation</label>
                        <textarea id="preparation" name="preparation" class="edit-textarea">
Étalez la pâte à pizza sur une plaque. Ajoutez la sauce tomate, puis répartissez le fromage et les autres ingrédients. Enfournez pendant environ 20 minutes dans un four bien chaud jusqu’à obtenir une belle cuisson dorée.
                        </textarea>
                        <button type="submit" class="small-save-btn">Enregistrer</button>
                    </form>
                </div>
            </div>

            <div class="recette-actions">
                <a href="/projet-recette/recettes.php" class="btn btn-secondary">Retour aux recettes</a>
            </div>

        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>



</body>
</html>