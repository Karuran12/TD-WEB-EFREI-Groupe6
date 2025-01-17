<?php
include_once './model/mod-acc.php'; 
include_once 'model/mod-rec.php';
$recipes = getAllRecipes();
$latestRecipes = getLatestRecipes(); 
$bestRatedRecipes = getTopRatedRecipes(); 
?>

<link rel="stylesheet" href="./styles/accstyles.css">

<div class="carousel-container">
    <div class="carousel" id="recipe-carousel">
        <?php foreach ($recipes as $recipe): ?>
            <div class="carousel-item">
                <img src="<?= htmlspecialchars($recipe['image'] ?? 'photos-recettes/default.jpg') ?>" alt="Image de <?= htmlspecialchars($recipe['name']) ?>">
                <div class="carousel-title">
                    <h3><?= htmlspecialchars($recipe['name']) ?></h3>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<div class="container">
    <h1>Les plats les plus récents</h1>
    <div class="recipes">
        <?php foreach ($latestRecipes as $recipe): ?>
            <div class="recipe-card">
                <img 
                    src="<?= htmlspecialchars($recipe['image'] ?? 'photos-recettes/default.jpg') ?>" 
                    alt="Image de <?= htmlspecialchars($recipe['name'] ?? 'Recette inconnue') ?>" 
                    class="recipe-image"
                >
                <div class="recipe-actions">
                    <a href="index.php?page=plus&id=<?= $recipe['id'] ?>" class="btn-action btn-plus">+</a>
                    <button 
                        class="btn-action btn-heart" 
                        data-recipe-id="<?= htmlspecialchars($recipe['id']) ?>" 
                        onclick="handleLike(this)">❤️
                    </button>

                </div>
                <div class="recipe-info">
                    <h2><?= htmlspecialchars($recipe['recipe_name'] ?? 'Recette sans nom') ?></h2>
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
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="container">
    <h1>Les plats les mieux notés</h1>
    <div class="recipes-infinite" x-data="infiniteCarousel()" x-init="startCarousel()">
        <div class="recipes-infinite-content" x-ref="recipes">
            <?php foreach ($bestRatedRecipes as $recipe): ?>
                <div class="recipe-card">
                    <img 
                        src="<?= htmlspecialchars($recipe['image'] ?? 'photos-recettes/default.jpg') ?>" 
                        alt="Image de <?= htmlspecialchars($recipe['name'] ?? 'Recette inconnue') ?>" 
                        class="recipe-image"
                    >
                    <div class="recipe-actions">
                    <a href="index.php?page=plus&id=<?= $recipe['id'] ?>" class="btn-action btn-plus">+</a>
                    <button 
                        class="btn-action btn-heart" 
                        data-recipe-id="<?= htmlspecialchars($recipe['id']) ?>" 
                        onclick="handleLike(this)">❤️
                    </button>

                    </div>
                    <div class="recipe-info">
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
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script src="./script/scr-acc.js"></script>
