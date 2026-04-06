<body>


<header class="site-header">
    <div class="container header-container">
        <a href="/ProjetWeb/pages/index.php" class="logo-link">
            <img src="/ProjetWeb/pages/images/logo.png" alt="Logo du site" class="logo">
            <span class="site-name">LivretRecettes</span>
        </a>

        <nav class="navbar">
            <ul class="nav-list">
                <!-- Ajoute automatiquement la classe "active" au lien correspondant à la page actuellement ouverte -->
               <li><a href="/ProjetWeb/pages/index.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">Accueil</a></li>
               <li><a href="/ProjetWeb/pages/recettes.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'recettes.php') ? 'active' : ''; ?>">Recettes</a></li>
               <li><a href="/ProjetWeb/pages/panier.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'panier.php') ? 'active' : ''; ?>">Mon Panier</a></li>
                <?php if(isset($_SESSION["login"])) { // Si l'utilisateur est connecté, on affiche le lien "Ajouter" ?>
                <li><a href="/ProjetWeb/pages/forms/ajouter.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'ajouter.php') ? 'active' : ''; ?>">Ajouter</a></li>
                <?php } ?>
            </ul>
        </nav>

        <div class="header-actions">
            <!-- Affiche le bouton "Admin" si l'utilisateur n'est pas connecté, sinon affiche le bouton "Logout" pour se déconnecter -->
            <?php if(isset($_SESSION["login"])) { ?>
                <a href="/ProjetWeb/pages/logout.php?src=<?=$_SERVER["PHP_SELF"]?>" class="admin-btn" >Logout</a>
                <?php } else { ?>
                <a href="/ProjetWeb/pages/login.php?src=<?=$_SERVER["PHP_SELF"]?>" class="admin-btn">Admin</a>
                <?php } ?>
        </div>
    </div>
</header>

