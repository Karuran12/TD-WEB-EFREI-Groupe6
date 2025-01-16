<?php 
include_once './model/mod-con.php'; 
?>

<link rel="stylesheet" href="styles/insconstyles.css">

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
        <p>Toujours pas inscrit ! <a href="index.php?page=inscription">Inscrivez-vous</a></p>
    </form>
</div>