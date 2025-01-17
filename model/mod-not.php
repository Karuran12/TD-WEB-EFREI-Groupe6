<?php
include_once 'bdd.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipe_id = $_POST['recipe_id'] ?? null;

    if (!$recipe_id || !isset($_SESSION['user']) || !isset($_SESSION['user']['id'])) {
        error_log('Session user: ' . json_encode($_SESSION['user'] ?? 'undefined'));
        error_log('Post data: ' . json_encode($_POST));

        echo json_encode([
            'error' => 'Données invalides ou utilisateur non connecté.',
            'debug' => compact('recipe_id'),
        ]);
        exit();
    }

    try {
        $pdo = Bdd::connexion();
        $user_id = $_SESSION['user']['id'];

        $stmt = $pdo->prepare(
            "SELECT COUNT(*) FROM recipe_likes WHERE user_id = :user_id AND recipe_id = :recipe_id"
        );
        $stmt->execute([
            'user_id' => $user_id,
            'recipe_id' => $recipe_id,
        ]);
        $exists = $stmt->fetchColumn() > 0;

        if ($exists) {
            $stmt = $pdo->prepare(
                "DELETE FROM recipe_likes WHERE user_id = :user_id AND recipe_id = :recipe_id"
            );
            $stmt->execute([
                'user_id' => $user_id,
                'recipe_id' => $recipe_id,
            ]);
            echo json_encode(['success' => true, 'action' => 'unliked']);
        } else {
            $stmt = $pdo->prepare(
                "INSERT INTO recipe_likes (user_id, recipe_id) VALUES (:user_id, :recipe_id)"
            );
            $stmt->execute([
                'user_id' => $user_id,
                'recipe_id' => $recipe_id,
            ]);
            echo json_encode(['success' => true, 'action' => 'liked']);
        }
    } catch (Exception $e) {
        error_log('Database error: ' . $e->getMessage());
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    error_log('Invalid request method: ' . $_SERVER['REQUEST_METHOD']);
    echo json_encode(['error' => 'Invalid request method.']);
}
