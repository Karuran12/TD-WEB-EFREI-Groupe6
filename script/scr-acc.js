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
    }
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
    }
}
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

/**
 * Gestion du bouton "like".
 */
async function handleLike(button) {
    const recipeId = button.getAttribute('data-recipe-id');
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


