<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'config.php';

$averageRating = 4.2;

$totalVotes = 35;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="styles/plat.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plat</title>
    <link rel="stylesheet" href="LSDC/view/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<header class="header">
    <div class="logo">Logo</div>
</header>
<div class="container">
    <section class="plat-container">
        <!-- Image et avis -->
        <div class="plat-card">
            <div class="plat-image-container">
                <img src="path/to/plat-image.jpg" alt="Image du plat" class="plat-image">
            </div>
            <div class="plat-details">
                <div class="plat-stars">
                    <div class="stars-display">
                        <?php 
                        // Génération dynamique des étoiles en fonction de la moyenne
                        for ($i = 1; $i <= 5; $i++) {
                            echo $i <= $averageRating ? '⭐' : '☆';
                        }
                        ?>
                        <span>(<?php echo $totalVotes; ?> votes)</span>
                    </div>
                    <button class="add-button" id="rateButton">Noter cette recette</button>
                </div>
            </div>
        </div>

        <!-- Description centrée dans une bulle -->
        <div class="plat-description-container">
            <div class="plat-description">
                Plongez dans un univers de saveurs authentiques avec cette recette traditionnelle de Bœuf Bourguignon...
                (Texte complet ici.)
            </div>
        </div>
    </section>
</div>

<!-- Popup de notation -->
<div class="rating-popup" id="ratingPopup">
    <div class="popup-content">
        <h3>Notez cette recette</h3>
        <div class="rating-input">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <span class="rating-star" data-value="<?php echo $i; ?>">☆</span>
            <?php endfor; ?>
        </div>
        <button class="submit-rating" id="submitRating">Soumettre</button>
        <button class="close-popup" id="closePopup">Annuler</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const rateButton = document.getElementById('rateButton');
        const ratingPopup = document.getElementById('ratingPopup');
        const closePopup = document.getElementById('closePopup');

        rateButton.addEventListener('click', () => {
            ratingPopup.style.display = 'block';
        });

        closePopup.addEventListener('click', () => {
            ratingPopup.style.display = 'none';
        });

        // Gestion des étoiles
        const stars = document.querySelectorAll('.rating-star');
        stars.forEach(star => {
            star.addEventListener('click', () => {
                stars.forEach(s => s.textContent = '☆'); // Réinitialise toutes les étoiles
                for (let i = 0; i < star.dataset.value; i++) {
                    stars[i].textContent = '⭐'; // Ajoute des étoiles pleines
                }
            });
        });
    });
</script>

</body>
</html>
