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
    <title>Modifier la Recette</title>
    <link rel="stylesheet" href="./styles/admin-styles.css">
</head>
<body>
    <form action="edit-recipes.php?id=<?= $recipeId ?>" method="POST" enctype="multipart/form-data">
        <h1>Modifier la Recette</h1>
        <label for="name">Nom de la Recette :</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($recipe['name']) ?>" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($recipe['description']) ?></textarea>

        <label for="image">Changer l'image :</label>
        <input type="file" id="image" name="image" accept="image/*">

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
