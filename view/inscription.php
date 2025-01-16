<?php 
include_once './model/mod-ins.php'; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="./styles/insconstyles.css">
</head>
<body>
    <div class="form-container">
        <h1>Inscription</h1>

        <?php if (!empty($error)) : ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <br>
            <input type="email" name="email" placeholder="Adresse e-mail" required>
            <br>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <br>
            <input type="password" name="confirm_password" placeholder="Confirmez le mot de passe" required>
            <br>
            <br><br>
            <button type="submit">S'inscrire</button>
        </form>

        <p>Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a></p>
    </div>
</body>
</html>
