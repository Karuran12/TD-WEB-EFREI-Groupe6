<?php
include_once './model/mod-lik.php'; 

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['like']) && isset($_POST['recipe_id'])) {
    $recipe_id = $_POST['recipe_id']; 
    $user_id = $_SESSION['user']['id']; 
    
    addRecipeToFavorites($user_id, $recipe_id);
    
    echo "<script>alert('Recette ajoutée à vos favoris !');</script>";
}

$favorites = getLikedRecipes($_SESSION['user']['id']);
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="styles/accstyles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Favoris</title>
</head>
<body>
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
</body>
</html>