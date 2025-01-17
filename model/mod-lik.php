<?php
include_once './model/mod-acc.php';
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Vous devez être connecté pour liker une recette.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recipe_id'])) {
    $recipeId = intval($_POST['recipe_id']);
    $userId = $_SESSION['user_id'];

    $isLiked = toggleLike($userId, $recipeId);

    echo json_encode([
        'success' => true,
        'message' => $isLiked ? 'Recette likée avec succès.' : 'Like retiré avec succès.'
    ]);
    exit();
}

echo json_encode(['success' => false, 'message' => 'Requête invalide.']);
exit();
?>