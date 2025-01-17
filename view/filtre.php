<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="styles/filtre.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Filtre</title>
    <script>
        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="ingredient-list">
            <div class="ingredient-group">
                <h3>Légumes</h3>
                <div class="ingredient">
                    <span>Tomate :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Salade :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Oignon :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Persil :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Poireau :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
            </div>

            <div class="ingredient-group">
                <h3>Fruits</h3>
                <div class="ingredient">
                    <span>Pomme :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Banane :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Orange :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Fraise :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Mangue :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
            </div>

            <div class="ingredient-group">
                <h3>Poissons et Fruits de Mer</h3>
                <div class="ingredient">
                    <span>Saumon :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Thon :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Crevettes :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Moules :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Calamars :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
            </div>

            <div class="ingredient-group">
                <h3>Produits</h3>
                <div class="ingredient">
                    <span>Lait :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Fromage :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Beurre :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Yaourt :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
            </div>

            <div class="ingredient-group">
                <h3>Produits Boulangerie</h3>
                <div class="ingredient">
                    <span>Pain :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Viennoiseries :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Bagels :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
                <div class="ingredient">
                    <span>Pizza :</span>
                    <button class="valid">✅</button>
                    <button class="invalid">❌</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>