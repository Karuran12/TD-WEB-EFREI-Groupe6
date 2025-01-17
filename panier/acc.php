<?php
include_once 'model/bdd.php';

$pdo = Bdd::connexion();

try {
    $query = "SELECT * FROM livres";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $mangas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des mangas : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['manga_id']) && isset($_POST['quantite'])) {
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?page=connexion');
        exit;
    }

    $mangaId = $_POST['manga_id'];
    $quantite = (int)$_POST['quantite'];

    if (!isset($_SESSION['cart'][$mangaId])) {
        $_SESSION['cart'][$mangaId] = 0;
    }
    $_SESSION['cart'][$mangaId] += $quantite;

    header('Location: index.php?page=panier');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <title>Liste des Mangas</title>
</head>
<body>
<div class="container">
    <h1>Liste des Mangas</h1>
    <div class="manga">
        <?php foreach ($mangas as $manga): ?>
            <div class="manga-carte">
                <img src="<?= htmlspecialchars($manga['photo']) ?>" alt="Couverture de <?= htmlspecialchars($manga['titre']) ?>">
                <h2><?= htmlspecialchars($manga['titre']) ?></h2>
                <p><strong>Auteur :</strong> <?= htmlspecialchars($manga['auteur']) ?></p>
                <p><?= htmlspecialchars($manga['description']) ?></p>
                <p><strong>Prix :</strong> <?= number_format($manga['prix'], 2) ?> €</p>
                <p><strong>Stock :</strong> <?= htmlspecialchars($manga['stock']) ?></p>
                <?php if (isset($_SESSION['user']) && $manga['stock'] > 0): ?>
                    <form method="POST" class="quantite-form">
                        <input type="hidden" name="manga_id" value="<?= $manga['id'] ?>">
                        <label for="quantite-<?= $manga['id'] ?>" class="quantite-label">Quantité:</label>
                        <input type="number" name="quantite" id="quantite-<?= $manga['id'] ?>" min="1" max="<?= $manga['stock'] ?>" value="1" required>
                        <button type="submit" class="btn-acheter">Ajouter au Panier</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
