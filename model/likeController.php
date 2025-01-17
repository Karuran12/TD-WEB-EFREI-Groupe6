<?php
session_start();
include_once '../model/mod-lik.php';
if (!isset($_SESSION['user'])) {

    header('Location: login.php');
    exit();
}


if (isset($_POST['recipe_id'])) {
    $user_id = $_SESSION['user']['id']; 
    $recipe_id = $_POST['recipe_id']; 

    addRecipeToFavorites($user_id, $recipe_id);
    
    header('Location: plat.php?recipe_id=' . $recipe_id);
    exit();
} else {
    echo "Recette introuvable.";
}
?>
