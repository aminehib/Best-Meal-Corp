<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Livret de Recettes</title>
    <link rel="stylesheet" href="/projet-recette/css/login.css">
</head>
<body>

<section class="login-page">
    <div class="login-box">
        <form method="POST" action="/ProjetWeb/actions/AdminAuthentification.php" class="login-form">
            <h1>Admin Authentification</h1>

            <div class="form-group">
                <label for="Username">Username</label>
                <input type="text" id="Username" name="username">
            </div>

            <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" id="Password" name="password">
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</section>

<script src="/projet-recette/js/validation.js"></script>

</body>
</html>
