<?php
include_once './model/bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['nom']); 
    $password = $_POST['password'];

    try {
        $bdd = Bdd::connexion();
        $stmt = $bdd->prepare("SELECT * FROM users WHERE username = ?");  
        $stmt->execute([$username]); 
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],  
            ];
            header('Location: index.php?page=accueil');
            exit;
        } else {
            $error = "Nom ou mot de passe incorrect";
        }
    } catch (Exception $e) {
        $error = "Erreur : " . $e->getMessage();
    }
}
?>
