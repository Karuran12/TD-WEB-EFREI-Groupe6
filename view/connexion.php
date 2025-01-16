<?php 
include_once __DIR__ . '/../model/mod-con.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion d'administrateur</title>
    <link rel="stylesheet" href="../styles/connexion.css">
</head>
<body>
<div class="admin-banner">
    <h3>Administrateur</h3>
</div>
    <div class="form-container">
        <form method="POST">
            <h2>Connexion</h2>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <div class="button-container">
                <button type="submit">Se connecter</button>
            </div>
        </form>
    </div>
</body>
</html>
