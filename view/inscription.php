<?php 
include_once './model/mod-ins.php'; 
?>

<link rel="stylesheet" href="./styles/insconstyles.css">

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

            <div class="avatar-selection">
                <h3>Choisissez un avatar :</h3>
                <label>
                    <input type="radio" name="avatar" value="avatar1.png" checked>
                    <img src="./photos/avatar1.png" alt="Avatar 1" style="width: 50px; height: 50px;">
                </label>
                <label>
                    <input type="radio" name="avatar" value="avatar2.png">
                    <img src="./photos/avatar2.png" alt="Avatar 2" style="width: 50px; height: 50px;">
                </label>
                <label>
                    <input type="radio" name="avatar" value="avatar3.png">
                    <img src="./photos/avatar3.png" alt="Avatar 3" style="width: 50px; height: 50px;">
                </label>
                <label>
                    <input type="radio" name="avatar" value="avatar4.png">
                    <img src="./photos/avatar4.png" alt="Avatar 4" style="width: 50px; height: 50px;">
                </label>
            </div>
            <br>
            <br>
            <button type="submit">S'inscrire</button>
        </form>

        <p>Déjà inscrit ? <a href="index.php?page=connexion">Connectez-vous ici</a></p>
    </div>
</body>
</html>