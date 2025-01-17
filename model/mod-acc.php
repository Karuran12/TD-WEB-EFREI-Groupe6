<?php
include_once 'bdd.php';

try {
    $pdo = Bdd::connexion();

    $stmt = $pdo->prepare("
        SELECT r.id AS recipe_id, r.name AS recipe_name, r.description, r.image, 
               COALESCE(AVG(rt.rating), 0) AS moyenne_note
        FROM recipes r
        LEFT JOIN ratings rt ON r.id = rt.recipe_id
        GROUP BY r.id
    ");
    $stmt->execute();
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($recipes as &$recipe) {
        $stmt = $pdo->prepare("
            SELECT i.name, i.quantity, i.category
            FROM ingredients i
            JOIN recipe_ingredients ri ON i.id = ri.ingredient_id
            WHERE ri.recipe_id = :recipe_id
        ");
        $stmt->execute(['recipe_id' => $recipe['recipe_id']]);
        $recipe['ingredients'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}

function getTopRatedRecipes() {
    $pdo = Bdd::connexion();
    $sql = "
        SELECT 
            r.id, 
            r.name, 
            r.description, 
            r.image, 
            r.category,
            COALESCE(AVG(rt.rating), 0) AS avg_rating
        FROM recipes r
        LEFT JOIN ratings rt ON r.id = rt.recipe_id
        GROUP BY r.id
        ORDER BY avg_rating DESC, r.name ASC
        LIMIT 10
    ";

    $stmt = $pdo->query($sql);
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($recipes as &$recipe) {
        $recipe['ingredients'] = getIngredientsForRecipe($pdo, $recipe['id']);
    }

    return $recipes;
}

function getIngredientsForRecipe($pdo, $recipeId) {
    $sql = "
        SELECT i.name, i.quantity 
        FROM ingredients i
        INNER JOIN recipe_ingredients ri ON i.id = ri.ingredient_id
        WHERE ri.recipe_id = :recipe_id
        ORDER BY i.name ASC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['recipe_id' => $recipeId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getLatestRecipes() {
    $pdo = Bdd::connexion();

    $sql = "
        SELECT r.id, r.name AS recipe_name, r.description, r.image, r.category, r.created_at,
               AVG(rt.rating) AS avg_rating
        FROM recipes r
        LEFT JOIN ratings rt ON r.id = rt.recipe_id
        GROUP BY r.id
        ORDER BY r.created_at DESC
        LIMIT 5
    ";
    $stmt = $pdo->query($sql);
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($recipes as &$recipe) {
        $recipe['ingredients'] = getIngredientsForRecipe($pdo, $recipe['id']);
    }

    return $recipes;
}



?>

