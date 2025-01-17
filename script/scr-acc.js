// === SECTION 1 : Définitions des carrousels ===

function manualCarousel() {
    return {
        currentIndex: 0,
        recipesCount: 0,
        canNext: false,
        canPrev: false,

        init() {
            this.recipesCount = this.$refs.recipes.children.length;
            this.updateButtons();
        },

        updateButtons() {
            this.canPrev = this.currentIndex > 0;
            this.canNext = this.currentIndex < this.recipesCount - 1;
        },

        prev() {
            if (this.currentIndex > 0) {
                this.currentIndex--;
                this.updateButtons();
                this.scrollToCurrent();
            }
        },

        next() {
            if (this.currentIndex < this.recipesCount - 1) {
                this.currentIndex++;
                this.updateButtons();
                this.scrollToCurrent();
            }
        },

        scrollToCurrent() {
            const width = this.$refs.recipes.offsetWidth;
            this.$refs.recipes.scrollTo({
                left: this.currentIndex * width,
                behavior: "smooth"
            });
        }
    };
}

function infiniteCarousel() {
    return {
        startCarousel() {
            const recipesContainer = this.$refs.recipes;

            if (!recipesContainer) return;

            let scrollAmount = 0;
            const step = 2;
            const interval = 30;

            setInterval(() => {
                scrollAmount += step;

                if (scrollAmount >= recipesContainer.scrollWidth) {
                    scrollAmount = 0;
                }

                recipesContainer.scrollTo({
                    left: scrollAmount,
                    behavior: "smooth"
                });
            }, interval);
        }
    };
}

// === SECTION 2 : Fonctions génériques et utilitaires ===

/**
 * Fonction générique pour envoyer une requête AJAX.
 */
async function sendAjaxRequest(url, method = 'GET', data = null) {
    const options = {
        method,
        headers: {
            'Content-Type': 'application/json',
        },
    };

    if (data) {
        options.body = JSON.stringify(data);
    }

    try {
        const response = await fetch(url, options);
        if (!response.ok) {
            throw new Error(`Erreur HTTP : ${response.status}`);
        }
        return await response.json();
    } catch (error) {
        console.error('Erreur AJAX :', error);
        throw error;
    }
}

// === SECTION 3 : Gestion des interactions utilisateur ===

/**
 * Gestion du bouton "like".
 */
async function handleLike(button) {
    const recipeId = button.getAttribute('data-recipe-id');
    console.log('Recipe ID envoyé :', recipeId);

    if (!recipeId) {
        alert('Erreur : ID de recette introuvable.');
        return;
    }

    try {
        const response = await fetch('model/mod-lik.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ recipe_id: recipeId }),
        });

        const result = await response.json();
        if (result.success) {
            alert('Recette ajoutée à vos favoris !');
        } else if (result.error) {
            alert('Erreur : ' + result.error);
        }
    } catch (error) {
        console.error('Erreur lors de la requête :', error);
        alert('Une erreur est survenue.');
    }
}

/**
 * Récupération des recettes likées.
 */
async function getLikedRecipes() {
    try {
        const response = await sendAjaxRequest('model/mod-lik.php', 'GET');
        console.log('Recettes likées :', response);

        const container = document.querySelector('#liked-recipes-container');
        if (!container) {
            console.error('Conteneur des recettes likées introuvable.');
            return;
        }

        container.innerHTML = '';
        response.forEach(recipe => {
            container.innerHTML += `
                <div class="recipe-card">
                    <img src="${recipe.image}" alt="${recipe.name}" />
                    <h3>${recipe.name}</h3>
                    <p>${recipe.description}</p>
                </div>
            `;
        });
    } catch (error) {
        console.error('Erreur lors de la récupération des recettes likées :', error);
    }
}

function toggleMenu() {
    const menu = document.getElementById('menu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

// === SECTION 4 : Recherche et affichage des recettes ===

const recipes = [
    { title: "Spaghetti Bolognese", description: "Un plat italien classique." },
    { title: "Curry de poulet", description: "Une délicieuse recette indienne." },
    { title: "Tarte aux pommes", description: "Un dessert français traditionnel." },
    { title: "Ratatouille", description: "Un plat végétarien méditerranéen." },
    { title: "Poulet rôti", description: "Un classique du dimanche." }
];

const searchBar = document.getElementById("searchBar");
const header = document.getElementById("header");
const cardsContainer = document.getElementById("cardsContainer");

// Fonction pour afficher les recettes sous forme de cartes
function displayRecipes(filteredRecipes) {
    cardsContainer.innerHTML = ""; // Réinitialise le conteneur

    if (filteredRecipes.length === 0) {
        cardsContainer.innerHTML = "<p>Aucune recette trouvée.</p>";
        return;
    }

    filteredRecipes.forEach(recipe => {
        const card = document.createElement("div");
        card.className = "card";

        const cardTitle = document.createElement("h2");
        cardTitle.textContent = recipe.title;

        const cardDescription = document.createElement("p");
        cardDescription.textContent = recipe.description;

        card.appendChild(cardTitle);
        card.appendChild(cardDescription);
        cardsContainer.appendChild(card);
    });
}

// Affiche toutes les recettes au début
displayRecipes(recipes);

// Ajout d'un événement pour le champ de recherche
searchBar.addEventListener("input", () => {
    const query = searchBar.value.toLowerCase();

    const filteredRecipes = recipes.filter(recipe =>
        recipe.title.toLowerCase().includes(query)
    );

    // Si une recherche est effectuée, réduire le titre principal
    if (query) {
        header.querySelector("h1").textContent = "Résultats de recherche";
    } else {
        header.querySelector("h1").textContent = "Les plats les plus récents";
    }

    displayRecipes(filteredRecipes);
});

// === SECTION 5 : Initialisation et comportements liés au DOM ===

const carousel = document.getElementById('recipe-carousel');
let offset = 0;

function scrollCarousel() {
    offset += 1;
    if (offset >= carousel.scrollWidth - carousel.clientWidth) {
        offset = 0;
    }
    carousel.style.transform = `translateX(-${offset}px)`;
}

setInterval(scrollCarousel, 30);
