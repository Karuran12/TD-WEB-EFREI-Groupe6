<?php
include_once 'bdd.php';

if (!isset($_SESSION['user'])) {
    echo json_encode(['error' => 'Vous devez être connecté pour liker une recette.']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
error_log('Données reçues dans mod-lik.php : ' . json_encode($data));

if (!isset($data['recipe_id'])) {
    echo json_encode(['error' => 'Identifiant de recette manquant.']);
    exit();
}

$recipe_id = (int)$data['recipe_id'];
$user_id = (int)$_SESSION['user']['id'];

try {
    $pdo = Bdd::connexion();
    $stmt = $pdo->prepare("
        INSERT INTO recipe_likes (user_id, recipe_id)
        VALUES (:user_id, :recipe_id)
        ON CONFLICT (user_id, recipe_id) DO NOTHING
    ");
    $stmt->execute([
        'user_id' => $user_id,
        'recipe_id' => $recipe_id,
    ]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Erreur lors de l\'ajout du like : ' . $e->getMessage()]);
}
?>
