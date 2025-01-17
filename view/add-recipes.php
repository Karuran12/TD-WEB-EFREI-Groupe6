<?php
include_once './model/bdd.php';
include_once 'mod-adm.php';
include_once 'mod-acc.php';
?>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="recipe_name" placeholder="Nom de la recette" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <textarea name="ingredients" placeholder="Ingrédients" required></textarea>
    <input type="file" name="image" required>
    <button type="submit" name="add_recipe">Ajouter</button>
</form>