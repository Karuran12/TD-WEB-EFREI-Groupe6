<?php 
include_once './model/mod-fil.php'; 
$ingredientsByCategory = getIngredientsByCategory();

?>

<link rel="stylesheet" href="./styles/filstyles.css">

<div class="filter-section">
    <h3>Filtrer par Ingrédients</h3>
    <form method="POST" action="index.php?page=filtre">
        <?php foreach ($ingredientsByCategory as $category => $ingredients): ?>
            <div class="ingredient-category">
                <h4><?= htmlspecialchars($category) ?></h4>
                <?php foreach ($ingredients as $ingredient): ?>
                    <label>
                        <input type="checkbox" name="ingredients[]" value="<?= $ingredient['id'] ?>">
                        <?= htmlspecialchars($ingredient['name']) ?>
                    </label>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn-filter">Filtrer</button>
    </form>
</div>

<div class="recipes-container">
    <?php if (isset($recipes) && empty($recipes)): ?>
        <p>Aucune recette ne correspond à vos critères.</p>
    <?php elseif (isset($recipes)): ?>
        <?php foreach ($recipes as $recipe): ?>
            <div class="recipe-card">
                <img src="<?= htmlspecialchars($recipe['image']) ?>" alt="<?= htmlspecialchars($recipe['name']) ?>" class="recipe-image">
                <h2><?= htmlspecialchars($recipe['name']) ?></h2>
                <p><?= htmlspecialchars($recipe['description']) ?></p>
                <p><strong>Catégorie :</strong> <?= htmlspecialchars($recipe['category']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

