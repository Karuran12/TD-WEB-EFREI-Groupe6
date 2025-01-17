<?php 
include_once './model/mod-pla.php'; 
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
        <div class="plat-card">
            <div class="plat-image-container">
                <img src="path/to/plat-image.jpg" alt="Image du plat" class="plat-image">
            </div>
            <div class="plat-details">
                <div class="plat-stars">
                    <div class="stars-display">
                        <?php 
                        for ($i = 1; $i <= 5; $i++) {
                            echo $i <= $averageRating ? '⭐' : '☆';
                        }
                        ?>
                        <span>(<?php echo $totalVotes; ?> votes)</span>
                    </div>
                    <button class="add-button" id="rateButton">Noter cette recette</button>
                </div>
            </div>
                <?php if (isset($_SESSION['user'])): ?>
                    <form method="POST" action="like.php" class="like-form">
                        <input type="hidden" name="recipe_id" value="<?= $recipeId ?>">
                        <button type="submit" name="like">LIKE</button>
                    </form>
                <?php endif; ?>
        </div>
        <div class="plat-description-container">
            <div class="plat-description">
                Plongez dans un univers de saveurs authentiques avec cette recette traditionnelle de Bœuf Bourguignon...
                (Texte complet ici.)
            </div>
        </div>
    </section>
</div>

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

        const stars = document.querySelectorAll('.rating-star');
        stars.forEach(star => {
            star.addEventListener('click', () => {
                stars.forEach(s => s.textContent = '☆'); 
                for (let i = 0; i < star.dataset.value; i++) {
                    stars[i].textContent = '⭐'; 
                }
            });
        });
    });

    $(document).ready(function(){
        $('form.like-form').on('submit', function(event) {
            event.preventDefault();
            var form = $(this);

            $.post(form.attr('action'), form.serialize(), function() {
                alert("Recette ajoutée aux favoris !");
            });
        });
    });

</script>

</body>
</html>
