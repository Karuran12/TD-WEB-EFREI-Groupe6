<?php
include_once 'bdd.php';

function getRecipeDetails($recipeId) {
    $pdo = Bdd::connexion();

    // Fetch recipe details
    $recipeStmt = $pdo->prepare("SELECT * FROM recipes WHERE id = ?");
    $recipeStmt->execute([$recipeId]);
    $recipe = $recipeStmt->fetch(PDO::FETCH_ASSOC);

    if ($recipe) {
        // Fetch ingredients
        $ingredientsStmt = $pdo->prepare("
            SELECT i.name, i.quantity 
            FROM ingredients i
            JOIN recipe_ingredients ri ON i.id = ri.ingredient_id
            WHERE ri.recipe_id = ?
        ");
        $ingredientsStmt->execute([$recipeId]);
        $recipe['ingredients'] = $ingredientsStmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch ratings
        $ratingsStmt = $pdo->prepare("
            SELECT r.rating, r.comment, u.username 
            FROM ratings r
            JOIN users u ON r.user_id = u.id
            WHERE r.recipe_id = ?
        ");
        $ratingsStmt->execute([$recipeId]);
        $recipe['ratings'] = $ratingsStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $recipe;
}

function getAllRecipes() {
    $pdo = Bdd::connexion();
    $stmt = $pdo->query("SELECT name, image FROM recipes");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
