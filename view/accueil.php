<?php
include_once './model/mod-acc.php'; 
?>

<link rel="stylesheet" href="./styles/accstyles.css">

<div class="container">
    <h1>Liste des Recettes</h1>
    <div class="recipes">
        <?php foreach ($recipes as $recipe): ?>
            <div class="recipe-card">
                <img 
                    src="<?= htmlspecialchars($recipe['image'] ?? 'photos-recettes/default.jpg') ?>" 
                    alt="Image de <?= htmlspecialchars($recipe['name'] ?? 'Recette inconnue') ?>" 
                    class="recipe-image"
                >
                <h2><?= htmlspecialchars($recipe['name'] ?? 'Recette sans nom') ?></h2>
                <p><strong>Description :</strong> <?= htmlspecialchars($recipe['description'] ?? 'Aucune description disponible.') ?></p>
                <p><strong>Note Moyenne :</strong> <?= number_format($recipe['avg_rating'] ?? 0, 1) ?> / 5</p>
                <p><strong>Ingrédients :</strong></p>
                <ul>
                    <?php if (!empty($recipe['ingredients'])): ?>
                        <?php foreach ($recipe['ingredients'] as $ingredient): ?>
                            <li>
                                <?= htmlspecialchars($ingredient['name']) ?> 
                                (<?= htmlspecialchars($ingredient['quantity'] ?? 'quantité inconnue') ?>)
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>Aucun ingrédient répertorié.</li>
                    <?php endif; ?>
                </ul>
                <?php if (isset($_SESSION['user'])): ?>
                    <form method="POST" action="add_to_favorites.php" class="favorite-form">
                        <input type="hidden" name="recipe_id" value="<?= $recipe['id'] ?>">
                        <button type="submit" class="btn-favorite">Ajouter aux Favoris</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

