<?php
include_once 'bdd.php'; 

// Initialiser la connexion à la base de données
$db = Bdd::connexion();  // Assure-toi que cette ligne appelle bien la méthode statique 'connexion'

function getLikedRecipes($user_id) {
    global $db; // Utilise la connexion définie plus haut

    $stmt = $db->prepare('
        SELECT recipes.id, recipes.name, recipes.description, recipes.image
        FROM recipes
        INNER JOIN user_favorites ON recipes.id = user_favorites.recipe_id
        WHERE user_favorites.user_id = ?
    ');

    $stmt->execute([$user_id]);

    return $stmt->fetchAll();
}

function addRecipeToFavorites($user_id, $recipe_id) {
    global $db;

    $stmt = $db->prepare('
        SELECT * FROM user_favorites WHERE user_id = ? AND recipe_id = ?
    ');
    $stmt->execute([$user_id, $recipe_id]);

    if ($stmt->rowCount() == 0) {
        $stmt = $db->prepare('
            INSERT INTO user_favorites (user_id, recipe_id) VALUES (?, ?)
        ');
        $stmt->execute([$user_id, $recipe_id]);
    }
}

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$favorites = getLikedRecipes($_SESSION['user']['id']);


?>