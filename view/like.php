<?php
include_once './model/mod-acc.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$likedRecipes = getLikedRecipesByUser($_SESSION['user_id']);
?>

<link rel="stylesheet" href="./styles/accstyles.css">

<div class="container">
    <h1>Mes recettes likées</h1>
    <div class="recipes">
        <?php if (empty($likedRecipes)): ?>
            <p>Vous n'avez pas encore liké de recettes.</p>
        <?php else: ?>
            <?php foreach ($likedRecipes as $recipe): ?>
                <div class="recipe-card">
                    <img 
                        src="<?= htmlspecialchars($recipe['image'] ?? 'photos-recettes/default.jpg') ?>" 
                        alt="Image de <?= htmlspecialchars($recipe['name']) ?>">
                    <h3><?= htmlspecialchars($recipe['name']) ?></h3>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
