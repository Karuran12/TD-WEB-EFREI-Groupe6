<?php 

$page = isset($_GET['page']) ? $_GET['page'] : 'accueil'; 

switch ($page) {
    case 'accueil':
        if (file_exists('view/accueil.php')) {
            include 'view/accueil.php';
        } else {
            echo "Page de accueil indisponible.";
        }
        break;
    case 'connexion':
        include 'view/connexion.php';
        break;     
    case 'deconnexion':
        include 'deconnexion.php';
        break;
    case 'plat':
        include 'view/plat.php';
        break;
    case 'filtre':
        include 'view/filtre.php';
        break; 
    default:
        include 'view/404.php';
}