    <?php 
    $isConnected = isset($_SESSION['user']);
    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Barre de navigation</title>
        <link rel="stylesheet" href="styles/navstyles.css">
    </head>
    <body>
        <nav class="navbar">
            <header class="header">
                <a href="index.php?page=accueil" class="logo">
                    <img src="photos/logo.png" alt="Logo" />
                </a>
                <form class="search-bar" action="search.php" method="GET">
                    <input type="text" name="query" placeholder="Search...">
                    <button type="submit" class="search-button">
                        🔍
                    </button>
                </form>
                <div class="filter-image">
                    <a href="filter.php">
                        <img src="photos/filtre.png" alt="Filtre">
                    </a>
                </div>
                <div class="menu">
                    <?php if ($isConnected): ?>
                        <div class="menu-icon" onclick="toggleMenu()">☰</div>
                        <div class="dropdown-menu" id="menu">
                            <ul>
                                <li><a href="index.php?page=deconnexion">Déconnexion</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div class="menu-icon" onclick="toggleMenu()">☰</div>
                        <div class="dropdown-menu" id="menu">
                            <ul>
                                <li><a href="index.php?page=inscription">Inscription</a></li>
                                <li><a href="index.php?page=connexion">Connexion</a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
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
