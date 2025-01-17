<?php
include_once './model/bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $userId = $_SESSION['user']['id'] ?? null;

    if (!$userId) {
        echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté.']);
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $recipeId = $data['recipe_id'] ?? null;
    $rating = $data['rating'] ?? null;

    if ($recipeId && $rating) {
        $pdo = Bdd::connexion();
        $stmt = $pdo->prepare("
            INSERT INTO recipe_ratings (recipe_id, user_id, rating) 
            VALUES (:recipe_id, :user_id, :rating)
            ON CONFLICT (recipe_id, user_id) 
            DO UPDATE SET rating = :rating
        ");
        $stmt->execute([
            ':recipe_id' => $recipeId,
            ':user_id' => $userId,
            ':rating' => $rating,
        ]);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Données invalides.']);
    }
}
?>
