<?php
session_start() ;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Livret de Recettes</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>

<section class="login-page">
    <div class="login-box">
        <form method="POST" action="/ProjetWeb/actions/AdminAuthentification.php" class="login-form">
            <?php if(isset($_SESSION["erreur"])): ?> <!-- Si une erreur générique est présente dans la session, on l'affiche au-dessus du formulaire de connexion -->
                <div class="error-message"><?= $_SESSION["erreur"] ?></div>
                <?php unset($_SESSION["erreur"]) ?> <!-- On supprime l'erreur de la session pour éviter de l'afficher à nouveau si l'utilisateur rafraîchit la page -->
            <?php endif; ?>
            <h1>Admin Authentification</h1>
            <input type="hidden" name ="source" value="<?=$_GET["src"] ?? "/ProjetWeb/pages/index.php" ?>"> <!-- Champ caché pour stocker la source de redirection après la connexion -->   
            <div class="form-group">
                <label for="Username">Username</label>
                <input type="text" id="Username" name="username">
                <?php if(isset($_SESSION["erreur_username"])) {?> 
                    <span class="field-error-message"><?= $_SESSION["erreur_username"] ?></span>
                    <?php unset($_SESSION["erreur_username"]) ;
                } ?> <!-- Si une erreur de username est présente dans la session, on l'affiche sous le champ de saisie -->     
            </div>

            <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" id="Password" name="password">
                <?php if(isset($_SESSION["erreur_password"])): ?> <!-- Si une erreur de password est présente dans la session, on l'affiche sous le champ de saisie -->
                    <span class="field-error-message"><?= $_SESSION["erreur_password"] ?></span>
                    <?php unset($_SESSION["erreur_password"]); ?> <!-- On supprime l'erreur de la session pour éviter de l'afficher à nouveau si l'utilisateur rafraîchit la page -->   
                <?php endif; ?> 
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</section>