<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier - Livret de Recettes</title>
    <link rel="stylesheet" href="/projet-recette/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="main-content pantry-page">
    <section class="recettes-page">
        <div class="container">
            <div class="page-title">
                <span class="page-subtitle">Gestion des ingredients</span>
                <h1>Mon panier</h1>
                <p>Modifiez separement vos ingredients et vos tags dans deux espaces distincts.</p>
            </div>

            <div class="pantry-sections">
                <section class="pantry-section">
                    <div class="section-head">
                        <h2>Ingredients</h2>
                    </div>

                    <div class="pantry-list">
                        <article class="pantry-row">
                            <div class="pantry-row-image pantry-image-trigger" id="pantry-image-trigger-1">
                                <img src="/projet-recette/images/salade.jpg" alt="Tomate">
                                <form action="/projet-recette/actions/modifier.php" method="POST" enctype="multipart/form-data" class="recipe-edit-form image-form is-hidden" data-form-id="pantry-image-form-1">
                                    <input type="hidden" name="ingredient_id" value="1">
                                    <input type="hidden" name="action_type" value="image">
                                    <label for="pantry-image-1" class="sr-only">Changer l'image</label>
                                    <input type="file" id="pantry-image-1" name="image" accept="image/*" class="hidden-file-input">
                                </form>
                            </div>

                            <div class="pantry-row-content">
                                <div class="editable-header">
                                    <h3>Tomate</h3>
                                    <a href="#" class="edit-inline-btn" data-target="pantry-name-form-1" title="Modifier le nom">✎</a>
                                </div>

                                <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="pantry-name-form-1">
                                    <input type="hidden" name="ingredient_id" value="1">
                                    <input type="hidden" name="action_type" value="name">
                                    <input type="text" name="name" value="Tomate" class="recipe-text-input">
                                    <button type="submit" class="recipe-form-btn">Enregistrer</button>
                                </form>
                            </div>
                        </article>

                        <article class="pantry-row">
                            <div class="pantry-row-image pantry-image-trigger" id="pantry-image-trigger-2">
                                <img src="/projet-recette/images/pizza.jpg" alt="Fromage">
                                <form action="/projet-recette/actions/modifier.php" method="POST" enctype="multipart/form-data" class="recipe-edit-form image-form is-hidden" data-form-id="pantry-image-form-2">
                                    <input type="hidden" name="ingredient_id" value="2">
                                    <input type="hidden" name="action_type" value="image">
                                    <label for="pantry-image-2" class="sr-only">Changer l'image</label>
                                    <input type="file" id="pantry-image-2" name="image" accept="image/*" class="hidden-file-input">
                                </form>
                            </div>

                            <div class="pantry-row-content">
                                <div class="editable-header">
                                    <h3>Fromage</h3>
                                    <a href="#" class="edit-inline-btn" data-target="pantry-name-form-2" title="Modifier le nom">✎</a>
                                </div>

                                <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="pantry-name-form-2">
                                    <input type="hidden" name="ingredient_id" value="2">
                                    <input type="hidden" name="action_type" value="name">
                                    <input type="text" name="name" value="Fromage" class="recipe-text-input">
                                    <button type="submit" class="recipe-form-btn">Enregistrer</button>
                                </form>
                            </div>
                        </article>

                        <article class="pantry-row">
                            <div class="pantry-row-image pantry-image-trigger" id="pantry-image-trigger-3">
                                <img src="/projet-recette/images/tarte.jpg" alt="Chocolat">
                                <form action="/projet-recette/actions/modifier.php" method="POST" enctype="multipart/form-data" class="recipe-edit-form image-form is-hidden" data-form-id="pantry-image-form-3">
                                    <input type="hidden" name="ingredient_id" value="3">
                                    <input type="hidden" name="action_type" value="image">
                                    <label for="pantry-image-3" class="sr-only">Changer l'image</label>
                                    <input type="file" id="pantry-image-3" name="image" accept="image/*" class="hidden-file-input">
                                </form>
                            </div>

                            <div class="pantry-row-content">
                                <div class="editable-header">
                                    <h3>Chocolat</h3>
                                    <a href="#" class="edit-inline-btn" data-target="pantry-name-form-3" title="Modifier le nom">✎</a>
                                </div>

                                <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="pantry-name-form-3">
                                    <input type="hidden" name="ingredient_id" value="3">
                                    <input type="hidden" name="action_type" value="name">
                                    <input type="text" name="name" value="Chocolat" class="recipe-text-input">
                                    <button type="submit" class="recipe-form-btn">Enregistrer</button>
                                </form>
                            </div>
                        </article>
                    </div>
                </section>

                <section class="pantry-section">
                    <div class="section-head">
                        <h2>Tags</h2>
                    </div>

                    <div class="pantry-tag-list">
                        <article class="pantry-tag-row">
                            <div class="section-head">
                                <h3>Legume</h3>
                                <a href="#" class="edit-inline-btn" data-target="tag-form-1" title="Modifier le tag">✎</a>
                            </div>

                            <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="tag-form-1">
                                <input type="hidden" name="tag_id" value="1">
                                <input type="hidden" name="action_type" value="tag_name">
                                <input type="text" name="tag_name" value="Legume" class="recipe-text-input">
                                <button type="submit" class="recipe-form-btn">Enregistrer</button>
                            </form>
                        </article>

                        <article class="pantry-tag-row">
                            <div class="section-head">
                                <h3>Dessert</h3>
                                <a href="#" class="edit-inline-btn" data-target="tag-form-2" title="Modifier le tag">✎</a>
                            </div>

                            <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="tag-form-2">
                                <input type="hidden" name="tag_id" value="2">
                                <input type="hidden" name="action_type" value="tag_name">
                                <input type="text" name="tag_name" value="Dessert" class="recipe-text-input">
                                <button type="submit" class="recipe-form-btn">Enregistrer</button>
                            </form>
                        </article>

                        <article class="pantry-tag-row">
                            <div class="section-head">
                                <h3>Leger</h3>
                                <a href="#" class="edit-inline-btn" data-target="tag-form-3" title="Modifier le tag">✎</a>
                            </div>

                            <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="tag-form-3">
                                <input type="hidden" name="tag_id" value="3">
                                <input type="hidden" name="action_type" value="tag_name">
                                <input type="text" name="tag_name" value="Leger" class="recipe-text-input">
                                <button type="submit" class="recipe-form-btn">Enregistrer</button>
                            </form>
                        </article>

                        <article class="pantry-tag-row">
                            <div class="section-head">
                                <h3>Vegetarien</h3>
                                <a href="#" class="edit-inline-btn" data-target="tag-form-4" title="Modifier le tag">✎</a>
                            </div>

                            <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="tag-form-4">
                                <input type="hidden" name="tag_id" value="4">
                                <input type="hidden" name="action_type" value="tag_name">
                                <input type="text" name="tag_name" value="Vegetarien" class="recipe-text-input">
                                <button type="submit" class="recipe-form-btn">Enregistrer</button>
                            </form>
                        </article>

                        <article class="pantry-tag-row">
                            <div class="section-head">
                                <h3>Au four</h3>
                                <a href="#" class="edit-inline-btn" data-target="tag-form-5" title="Modifier le tag">✎</a>
                            </div>

                            <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="tag-form-5">
                                <input type="hidden" name="tag_id" value="5">
                                <input type="hidden" name="action_type" value="tag_name">
                                <input type="text" name="tag_name" value="Au four" class="recipe-text-input">
                                <button type="submit" class="recipe-form-btn">Enregistrer</button>
                            </form>
                        </article>

                        <article class="pantry-tag-row">
                            <div class="section-head">
                                <h3>Rapide</h3>
                                <a href="#" class="edit-inline-btn" data-target="tag-form-6" title="Modifier le tag">✎</a>
                            </div>

                            <form action="/projet-recette/actions/modifier.php" method="POST" class="recipe-edit-form is-hidden" data-form-id="tag-form-6">
                                <input type="hidden" name="tag_id" value="6">
                                <input type="hidden" name="action_type" value="tag_name">
                                <input type="text" name="tag_name" value="Rapide" class="recipe-text-input">
                                <button type="submit" class="recipe-form-btn">Enregistrer</button>
                            </form>
                        </article>

                    </div>
                </section>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-target]').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const formId = button.getAttribute('data-target');
            const form = document.querySelector('[data-form-id="' + formId + '"]');

            if (!form) return;

            form.classList.toggle('is-hidden');
            button.classList.toggle('editing');
            button.textContent = form.classList.contains('is-hidden') ? '✎' : '✕';
        });
    });

    document.querySelectorAll('.pantry-image-trigger').forEach(function(trigger) {
        trigger.addEventListener('click', function() {
            const input = trigger.querySelector('input[type="file"]');
            if (input) {
                input.click();
            }
        });
    });
});
</script>

</body>
</html>
