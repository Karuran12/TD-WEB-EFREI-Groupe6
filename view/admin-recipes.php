<?php
include_once './model/bdd.php';
include_once 'mod-adm.php';
include_once 'mod-acc.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gérer les Recettes</title>
    <link rel="stylesheet" href="./styles/admin-styles.css">
</head>
<body>
    <div class="admin-container">
        <h1>Gérer les Recettes</h1>
        <div class="recipes-grid">
            <?php foreach ($recipes as $recipe): ?>
                <div class="recipe-card">
                    <div class="recipe-photo">
                        <img 
                            src="<?= htmlspecialchars($recipe['image'] ?? 'photos-recettes/default.jpg') ?>" 
                            alt="Image de <?= htmlspecialchars($recipe['recipe_name']) ?>"
                        >
                    </div>
                    <div class="recipe-details">
                        <h2><?= htmlspecialchars($recipe['recipe_name']) ?></h2>
                    </div>
                    <div class="recipe-actions">
                        <a href="edit-recipe.php?id=<?= $recipe['id'] ?>" class="edit-button">Éditer</a>
                        <a href="delete-recipe.php?id=<?= $recipe['id'] ?>" class="delete-button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?');">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="add-recipe.php" class="add-recipe-button">Ajouter une Recette</a>
    </div>
</body>
</html>
