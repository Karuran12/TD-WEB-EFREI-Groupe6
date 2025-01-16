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
