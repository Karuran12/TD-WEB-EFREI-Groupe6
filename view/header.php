<?php 
include_once './model/mod-hea.php'; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Sauce Du Chef</title>
    <link rel="stylesheet" href="styles/navstyles.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body>
    <nav class="navbar">
        <header class="header">
            <a href="index.php?page=accueil" class="logo">
                <img src="photos/logo.png" alt="Logo" />
            </a>
            <form class="search-bar" action="search.php" method="GET">
                <input type="text" name="query" placeholder="Rechercher...">
                <button type="submit" class="search-button">
                    🔍
                </button>
            </form>
            <div class="filter-image">
                <a href="index.php?page=filtre">
                    <img src="photos/filtre.png" alt="Filtre">
                </a>
            </div>
            <?php if ($isConnected): ?>
                <div 
                    x-data="{ showPopup: false }" 
                    @mouseenter="showPopup = true" 
                    @mouseleave="showPopup = false" 
                    class="relative">
                    
                    <div class="avatar">
                        <img src="<?php echo htmlspecialchars($_SESSION['user']['avatar'] ?? './photos/avatar1.png'); ?>" alt="Avatar" class="profile-avatar">
                    </div>
                    
                    <div 
                        x-show="showPopup" 
                        x-transition 
                        class="absolute bg-white text-black p-2 rounded shadow-lg text-sm mt-2"
                        style="left: 50%; transform: translateX(-50%); min-width: 150px;">
                        Bonjour <?php echo htmlspecialchars($_SESSION['user']['username'] ?? 'Utilisateur'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="menu-icon" onclick="toggleMenu()">☰</div>
            <div class="dropdown-menu" id="menu">
                <ul>
                    <?php if ($isConnected): ?>
                        <li><a href="index.php?page=deconnexion">Déconnexion</a></li>
                    <?php else: ?>
                        <li><a href="index.php?page=inscription">Inscription</a></li>
                        <li><a href="index.php?page=connexion">Connexion</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </header>
    </nav>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
