<?php
include_once 'model/bdd.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=connexion');
    exit;
}

$pdo = Bdd::connexion();
$userId = $_SESSION['user']['id'];

if (empty($_SESSION['cart'])) {
    $query = "SELECT livre_id, quantite FROM panier WHERE user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId]);
    $cartData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION['cart'] = [];
    foreach ($cartData as $item) {
        $_SESSION['cart'][$item['livre_id']] = (int)$item['quantite'];
    }
}
$cart = $_SESSION['cart'];

$mangas = [];
$totalPrix = 0;
if (!empty($cart)) {
    $placeholders = str_repeat('?,', count($cart) - 1) . '?';
    $query = "SELECT * FROM livres WHERE id IN ($placeholders)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array_keys($cart));
    $mangas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($mangas as $manga) {
        $quantite = isset($cart[$manga['id']]) ? (int)$cart[$manga['id']] : 0;
        $totalPrix += $quantite * $manga['prix'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valider_panier'])) {
    foreach ($cart as $livreId => $quantite) {
        $query = "INSERT INTO panier (user_id, livre_id, quantite)
                  VALUES (?, ?, ?)
                  ON DUPLICATE KEY UPDATE quantite = quantite + VALUES(quantite)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$userId, $livreId, $quantite]);
    }

    unset($_SESSION['cart']);
    $message = "Votre panier a été validé avec succès.";
}
?>

<link rel="stylesheet" href="styles/styles.css">

<div class="container">
    <h1>Votre Panier</h1>
    <?php if (isset($message)): ?>
        <p style="color: green;"><?= $message; ?></p>
    <?php endif; ?>
    <?php if (empty($mangas)): ?>
        <p>Votre panier est vide, achetez des livres.</p>
    <?php else: ?>
        <div class="manga">
            <?php foreach ($mangas as $manga): ?>
                <div class="manga-carte">
                    <img src="<?= htmlspecialchars($manga['photo']) ?>" alt="Couverture de <?= htmlspecialchars($manga['titre']) ?>">
                    <h2><?= htmlspecialchars($manga['titre']) ?></h2>
                    <p><strong>Auteur :</strong> <?= htmlspecialchars($manga['auteur']) ?></p>
                    <p><strong>Prix :</strong> <?= number_format($manga['prix'], 2) ?> €</p>
                    <p><strong>Quantité :</strong> <?= is_array($cart) && isset($cart[$manga['id']]) ? (int)$cart[$manga['id']] : 0 ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="total">
            <h2>Total : <?= number_format($totalPrix, 2) ?> €</h2>
        </div>
        <form method="POST">
            <button type="submit" name="valider_panier" class="btn-valider">Valider le Panier</button>
        </form>
    <?php endif; ?>
</div>
