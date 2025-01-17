<?php
include_once './model/mod-rec.php';
include_once './model/mod-not.php';

if (!isset($_GET['id'])) {
    echo "Invalid recipe ID.";
    exit;
}

$recipe = getRecipeDetails($_GET['id']);
if (!$recipe) {
    echo "Recipe not found.";
    exit;
}

?>

<link rel="stylesheet" href="styles/recstyles.css">

<div class="recipe-card-landscape">
    <img 
        src="<?= htmlspecialchars($recipe['image'] ?? 'photos-recettes/default.jpg') ?>" 
        alt="Image de <?= htmlspecialchars($recipe['name'] ?? 'Recette inconnue') ?>" 
        class="recipe-image"
    >
    
    <div class="recipe-info">
        <h2><?= htmlspecialchars($recipe['name'] ?? 'Recette sans nom') ?></h2>
        <p><strong>Description :</strong> <?= htmlspecialchars($recipe['description'] ?? 'Aucune description disponible.') ?></p>
        <p><strong>Note Moyenne :</strong> <?= number_format($recipe['avg_rating'] ?? 0, 1) ?> / 5</p>
        <p><strong>Ingrédients :</strong></p>
        <ul>
            <?php if (!empty($recipe['ingredients'])): ?>
                <?php foreach ($recipe['ingredients'] as $ingredient): ?>
                    <li><?= htmlspecialchars($ingredient['name']) ?> (<?= htmlspecialchars($ingredient['quantity'] ?? 'quantité inconnue') ?>)</li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Aucun ingrédient répertorié.</li>
            <?php endif; ?>
        </ul>
        <div class="actions">
            <button class="btn-like">❤️ Liker</button>
        </div>
    </div>
</div>

<div class="recipe-rating-card">
    <h2>Note:</h2>
    <ul>
        <?php if (!empty($recipe['ratings'])): ?>
            <?php foreach ($recipe['ratings'] as $rating): ?>
                <li>
                    <strong><?= htmlspecialchars($rating['username']) ?>:</strong>
                    <?= htmlspecialchars($rating['rating']) ?>/5 - <?= htmlspecialchars($rating['comment']) ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Aucune note pour l'instant.</li>
        <?php endif; ?>
    </ul>

    <?php if (isset($_SESSION['user'])): ?>
        <form method="POST" action="model/mod-not.php" id="rating-form">
            <input type="hidden" name="recipe_id" value="<?= $recipe['id'] ?>">
            <label for="rating">Votre note (1-5):</label>
            <input type="number" name="rating" min="1" max="5" required>
            <button type="submit">Envoyer</button>
        </form>
    <?php else: ?>
        <p><a href="index.php?page=connexion">Connectez-vous</a> pour laisser une note.</p>
    <?php endif; ?>

    <div class="actions">
        <button class="btn-like">❤️ Liker</button>
    </div>
</div>


<script>
    function toggleLike(recipeId) {
        // Implement AJAX for liking recipes
    }
</script>