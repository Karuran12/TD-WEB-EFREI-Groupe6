<?php
include_once 'bdd.php';

$ingredientsByCategory = getIngredientsByCategory();


function getIngredientsByCategory() {
    $pdo = Bdd::connexion();

    $sql = "SELECT category, id, name FROM ingredients ORDER BY category, name";
    $stmt = $pdo->query($sql);

    $ingredients = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ingredients[$row['category']][] = $row;
    }

    return $ingredients;
}

function getFilteredRecipes($ingredientIds) {
    $pdo = Bdd::connexion();

    if (empty($ingredientIds)) {
        return [];
    }

    $placeholders = implode(',', array_fill(0, count($ingredientIds), '?'));

    $sql = "
        SELECT DISTINCT r.id, r.name, r.description, r.image, r.category
        FROM recipes r
        JOIN recipe_ingredients ri ON r.id = ri.recipe_id
        WHERE ri.ingredient_id IN ($placeholders)
        ORDER BY r.name ASC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($ingredientIds);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>