<?php
include_once './model/mod-lik.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=connexion');
    exit();
}

$favorites = getLikedRecipes((int)$_SESSION['user']['id']);
?>

<div class="container">
    <h1>Mes Recettes Likées</h1>
    <div class="recipes">
        <?php if (empty($favorites)): ?>
            <p>Vous n'avez pas encore liké de recettes.</p>
        <?php else: ?>
            <?php foreach ($favorites as $recipe): ?>
                <div class="recipe-card">
                    <img 
                        src="<?= htmlspecialchars($recipe['image'] ?? 'photos-recettes/default.jpg') ?>" 
                        alt="Image de <?= htmlspecialchars($recipe['name']) ?>" 
                        class="recipe-image"
                    >
                    <h2><?= htmlspecialchars($recipe['name']) ?></h2>
                    <p><?= htmlspecialchars($recipe['description']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
