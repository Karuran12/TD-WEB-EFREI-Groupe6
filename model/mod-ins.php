<?php
include_once './model/bdd.php';

$pdo = Bdd::connexion(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');
    $avatar = isset($_POST['avatar']) ? $_POST['avatar'] : 'avatar1.png'; // Avatar par défaut

    if ($username && $email && $password && $confirm_password) {
        // Vérification de l'adresse e-mail
        if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            $error = "Adresse e-mail invalide.";
        }
        // Vérification de la correspondance des mots de passe
        elseif ($password !== $confirm_password) {
            $error = "Les mots de passe ne correspondent pas.";
        }
        // Vérification des critères du mot de passe
        elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W]).{8,}$/', $password)) {
            $error = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
        } else {
            // Vérification si l'email ou le nom d'utilisateur existe déjà
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username OR email = :email");
            $stmt->execute(['username' => $username, 'email' => $email]);
            if ($stmt->fetchColumn() > 0) {
                $error = "Nom d'utilisateur ou adresse e-mail déjà utilisé.";
            } else {
                // Hachage du mot de passe
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                // Insertion dans la base de données
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password, avatar) VALUES (:username, :email, :password, :avatar)");
                $stmt->execute([
                    'username' => $username,
                    'email' => $email,
                    'password' => $hashedPassword,
                    'avatar' => $avatar  // Ajouter l'avatar à l'insertion
                ]);

                // Redirection après l'inscription réussie
                header('Location: index.php?page=accueil');
                exit();
            }
        }
    } else {
        $error = "Tous les champs sont requis.";
    }
}
?>
