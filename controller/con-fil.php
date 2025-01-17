<?php
include_once './model/mod-fil.php';

// Récupérer les ingrédients par catégorie depuis le modèle
$ingredientsByCategory = getIngredientsByCategory();

// Inclure la vue pour afficher la page de filtre
include './view/filtre.php';
?>
