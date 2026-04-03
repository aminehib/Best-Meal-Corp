<header class="site-header">
    <div class="container header-container">
        <a href="/projet-recette/index.php" class="logo-link">
            <img src="/projet-recette/images/logo.png" alt="Logo du site" class="logo">
            <span class="site-name">LivretRecettes</span>
        </a>

        <nav class="navbar">
            <ul class="nav-list">
                <li><a href="/projet-recette/index.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">Accueil</a></li>
                <li><a href="/projet-recette/recettes.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'recettes.php') ? 'active' : ''; ?>">Recettes</a></li>
                <li><a href="/projet-recette/mon_panier.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'mon_panier.php') ? 'active' : ''; ?>">Mon panier</a></li>
                <li><a href="/projet-recette/forms/ajouter.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'ajouter_recette.php') ? 'active' : ''; ?>">Ajouter</a></li>
            </ul>
        </nav>

        <div class="header-actions">
            <a href="/projet-recette/admin/login.php" class="admin-btn">Admin</a>
        </div>
    </div>
</header>
