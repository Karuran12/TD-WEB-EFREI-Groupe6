<?php
include_once 'bdd.php';

$pdo = Bdd::connexion();

try {
    $stmt = $pdo->prepare("
        SELECT 
            r.id,
            r.name AS titre,
            r.description,
            r.image,
            COALESCE(AVG(rt.rating), 0) AS moyenne_note,
            STRING_AGG(i.name || ' (' || COALESCE(i.quantity, 'n/a') || ')', ', ') AS ingredients
        FROM 
            recipes r
        LEFT JOIN 
            ratings rt ON r.id = rt.recipe_id
        LEFT JOIN 
            ingredients i ON r.id = i.recipe_id
        GROUP BY 
            r.id
        ORDER BY 
            r.created_at DESC
    ");
    $stmt->execute();
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    die("Erreur lors de la récupération des recettes : " . $e->getMessage());
}

?>