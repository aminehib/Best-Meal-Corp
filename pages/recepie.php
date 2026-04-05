<!DOCTYPE html>
<html lang="fr">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Recette Admin - Livret de Recettes</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css">
 <link rel="stylesheet" href="/ProjetWeb/pages/styles/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="main-content admin-recipe-page">
 <section class="recette-page">
  <div class="container">

   <form action="/ProjetWeb/actions/update_recette.php" method="POST" enctype="multipart/form-data" class="recipe-global-form">
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

    <div class="recette-top">
     <div class="recette-image admin-block clickable-image-block" id="image-trigger">
      <img src="/ProjetWeb/pages/images/uploads/<?= htmlspecialchars($recette->image_url) ?>" alt="<?= htmlspecialchars($recette->name) ?>" id="recipe-image">

      <?php if(isset($_SESSION["login"])): ?>
       <label for="image" class="sr-only">Changer l'image</label>
       <input type="file" id="image" name="img" accept="image/*" class="hidden-file-input" value="<?= htmlspecialchars(__DIR__ . '/images/uploads/' . $recette->image_url) ?>">
      <?php endif; ?>
     </div>

     <div class="recette-info">
      <span class="page-subtitle">Détail de la recette</span>

      <div class="editable-header">
       <h1>
        <?php if($recette->title): ?>
         <?= htmlspecialchars($recette->title) ?>
        <?php else: ?>
         <span class="empty-placeholder">Sans titre</span>
        <?php endif; ?>
       </h1>
       <?php if(isset($_SESSION["login"])): ?>
        <a href="#" class="edit-inline-btn" data-target="title-block" title="Modifier le titre">✎</a>
       <?php endif; ?>
      </div>

      <div class="recipe-edit-form recipe-edit-hero is-hidden" data-form-id="title-block">
       <input type="text" id="title" name="title" value="<?= htmlspecialchars($recette->title ?? '') ?>" placeholder="Entrez le titre de la recette..." class="recipe-title-input">
      </div>

      <div class="editable-section">
       <div class="section-head">
        <span class="section-edit-title">Description</span>
        <?php if(isset($_SESSION["login"])): ?>
         <a href="#" class="edit-inline-btn" data-target="description-block" title="Modifier la description">✎</a>
        <?php endif; ?>
       </div>
       <p class="recette-description">
        <?php if($recette->description): ?>
         <?= htmlspecialchars($recette->description) ?>
        <?php else: ?>
         <span class="empty-placeholder">Aucune description. Cliquez ✎ pour en ajouter une.</span>
        <?php endif; ?>
       </p>
      </div>

      <div class="recipe-edit-form recipe-edit-hero is-hidden" data-form-id="description-block">
       <textarea id="description" name="description" placeholder="Décrivez votre recette..." class="recipe-description-input"><?= htmlspecialchars($recette->description ?? '') ?></textarea>
      </div>

      <div class="editable-section">
       <div class="section-head">
        <span class="section-edit-title">Informations</span>
        <?php if(isset($_SESSION["login"])): ?>
         <a href="#" class="edit-inline-btn" data-target="infos-block" title="Modifier les informations">✎</a>
        <?php endif; ?>
       </div>

       <div class="recette-meta">
        <div class="meta-item">
         <span class="meta-label">Temps de préparation</span>
         <span class="meta-value"><?= $recette->preparation_time ? htmlspecialchars($recette->preparation_time) . ' min' : '<span class="empty-placeholder">—</span>' ?></span>
        </div>

        <div class="meta-item">
         <span class="meta-label">Temps de cuisson</span>
         <span class="meta-value"><?= $recette->cooking_time ? htmlspecialchars($recette->cooking_time) . ' min' : '<span class="empty-placeholder">—</span>' ?></span>
        </div>

        <div class="meta-item">
         <span class="meta-label">Nombre de personnes</span>
         <span class="meta-value"><?= $recette->servings ? htmlspecialchars($recette->servings) . ' pers.' : '<span class="empty-placeholder">—</span>' ?></span>
        </div>
       </div>

       <div class="recipe-edit-form recipe-meta-form is-hidden" data-form-id="infos-block">
        <div class="recette-meta">
         <div class="meta-item">
          <label for="prep_time" class="meta-label">Temps de préparation</label>
          <input type="number" id="prep_time" name="preparation_time" value="<?= htmlspecialchars($recette->preparation_time ?? '') ?>" placeholder="ex: 30" min="0" class="recipe-text-input">
         </div>

         <div class="meta-item">
          <label for="cook_time" class="meta-label">Temps de cuisson</label>
          <input type="number" id="cook_time" name="cooking_time" value="<?= htmlspecialchars($recette->cooking_time ?? '') ?>" placeholder="ex: 45" min="0" class="recipe-text-input">
         </div>

         <div class="meta-item">
          <label for="servings" class="meta-label">Nombre de personnes</label>
          <input type="number" id="servings" name="servings" value="<?= htmlspecialchars($recette->servings ?? '') ?>" placeholder="ex: 4" min="1" class="recipe-text-input">
         </div>
        </div>
       </div>
      </div>

      <div class="editable-section">
       <div class="section-head">
        <span class="section-edit-title">Tags</span>
        <?php if(isset($_SESSION["login"])): ?>
         <a href="#" class="edit-inline-btn" data-target="tags-block" title="Modifier les tags">✎</a>
        <?php endif; ?>
       </div>

       <div class="recette-tags">
        <?php foreach($tags as $tag): ?>
         <span><?= htmlspecialchars($tag->name) ?></span>
        <?php endforeach; ?>
       </div>

       <div class="recipe-edit-form recipe-tags-form is-hidden" data-form-id="tags-block">
        <select id="tag-select" name="tags[]" class="recipe-select" multiple>
         <?php foreach($tagsAll as $tag):
          $selected = "";
          foreach($tags as $t):
           if($tag->id == $t->id){
            $selected = "selected";
           }
          endforeach;
         ?>
          <option value="<?= htmlspecialchars($tag->name) ?>" <?= $selected ?>><?= htmlspecialchars($tag->name) ?></option>
         <?php endforeach; ?>
        </select>
       </div>
      </div>
     </div>
    </div>

    <div class="recette-content">
     <div class="ingredients-box">
      <div class="section-head">
       <h2>Ingrédients</h2>
       <?php if(isset($_SESSION["login"])): ?>
        <a href="#" class="edit-inline-btn" data-target="ingredients-block" title="Modifier les ingrédients">✎</a>
       <?php endif; ?>
      </div>

      <ul>
       <?php foreach($ingredients as $ing): ?>
        <li><?= htmlspecialchars($ing->name) ?></li>
       <?php endforeach; ?>
      </ul>

      <div class="recipe-edit-form recipe-content-form is-hidden" data-form-id="ingredients-block">
       <select id="ingredient-select" name="ingredients[]" class="recipe-select recipe-select-large" multiple >
        <?php foreach($ingredientsAll as $ing):
         $selected = "";
         foreach($ingredients as $in):
          if($in->id == $ing->id){
           $selected = "selected";
          }
         endforeach;
        ?>
         <option value="<?= htmlspecialchars($ing->name) ?>" <?= $selected ?>><?= htmlspecialchars($ing->name) ?></option>
        <?php endforeach; ?>
       </select>
      </div>
     </div>

     <div class="preparation-box">
      <div class="section-head">
       <h2>Préparation</h2>
       <?php if(isset($_SESSION["login"])): ?>
        <a href="#" class="edit-inline-btn" data-target="preparation-block" title="Modifier la préparation">✎</a>
       <?php endif; ?>
      </div>

      <?php if($recette->preparation): ?>
       <p><?= htmlspecialchars($recette->preparation) ?></p>
      <?php else: ?>
       <p><span class="empty-placeholder">Aucune étape de préparation. Cliquez ✎ pour en ajouter.</span></p>
      <?php endif; ?>

      <div class="recipe-edit-form recipe-content-form is-hidden" data-form-id="preparation-block">
       <textarea id="preparation" name="preparation" placeholder="Décrivez les étapes de préparation..." class="recipe-textarea"><?= htmlspecialchars($recette->preparation ?? '') ?></textarea>
      </div>
     </div>
    </div>

    <?php if(isset($_SESSION["login"])): ?>
     <div class="recette-actions">
      <button type="submit" class="btn btn-primary">Enregistrer toutes les modifications</button>
      <a href="/ProjetWeb/pages/recettes.php" class="btn btn-secondary">Retour aux recettes</a>
     </div>
    <?php endif; ?>

   </form>

  </div>
 </section>
</main>

<?php include 'includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
<script>
$(document).ready(function() {
 $('#ingredient-select').selectize({
    create: true,
  placeholder: 'Choisir un ou plusieurs ingrédients',
  plugins: ['remove_button']
 });

 $('#tag-select').selectize({
  placeholder: 'Choisir un ou plusieurs tags',
  plugins: ['remove_button']
 });

 document.querySelectorAll('[data-target]').forEach(function(button) {
  button.addEventListener('click', function(e) {
   e.preventDefault();
   const formId = button.getAttribute('data-target');
   const formBlock = document.querySelector('[data-form-id="' + formId + '"]');

   if (!formBlock) return;

   formBlock.classList.toggle('is-hidden');
   button.classList.toggle('editing');
   button.textContent = formBlock.classList.contains('is-hidden') ? '✎' : '✕';

   if (!formBlock.classList.contains('is-hidden')) {
    const firstInput = formBlock.querySelector('input, textarea');
    if (firstInput) {
     firstInput.focus();
     if (firstInput.value) {
      const len = firstInput.value.length;
      firstInput.setSelectionRange(len, len);
     }
    }
   }
  });
 });

 const imageTrigger = document.getElementById('image-trigger');
 const imageInput = document.getElementById('image');

 if (imageTrigger && imageInput) {
  imageTrigger.addEventListener('click', function() {
   imageInput.click();
  });
 }
});
</script>

</body>
</html>