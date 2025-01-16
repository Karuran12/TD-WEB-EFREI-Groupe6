<?php
include_once './model/mod-acc.php'; 
?>

<link rel="stylesheet" href="./styles/accstyles.css">

<div class="container">
    <h1>Liste des Recettes</h1>
    <div class="recipes">
        <?php foreach ($recipes as $recipe): ?>
            <div class="recipe-card">
                <img src="<?= htmlspecialchars($recipe['image']) ?>" alt="Image de <?= htmlspecialchars($recipe['titre']) ?>" class="recipe-image">
                <h2><?= htmlspecialchars($recipe['titre']) ?></h2>
                <p><strong>Description :</strong> <?= htmlspecialchars($recipe['description']) ?></p>
                <p><strong>Note Moyenne :</strong> <?= number_format($recipe['moyenne_note'], 1) ?> / 5</p>
                <p><strong>Ingrédients :</strong> <?= htmlspecialchars($recipe['ingredients']) ?></p>
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

</body>
</html>
