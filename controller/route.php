<?php 

$page = isset($_GET['page']) ? $_GET['page'] : 'accueil'; 

switch ($page) {
    case 'admin':
        if (file_exists('view/admin-recipes.php')) {
            include 'view/admin-recipes.php';
        } else {
            echo "Page de accueil indisponible.";
        }
        break;
    case 'connexion':
        include 'view/login.php';
        break;     
    case 'deconnexion':
        include 'deconnexion.php';
        break;
    case 'filtre':
        include 'view/filtre.php';
        break; 
    default:
        include 'view/404.php';
}