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


const carousel = document.getElementById('recipe-carousel');
    let offset = 0;

    function scrollCarousel() {
        offset += 1;
        if (offset >= carousel.scrollWidth - carousel.clientWidth) {
            offset = 0; // Réinitialise le défilement
        }
        carousel.style.transform = `translateX(-${offset}px)`;
    }

    setInterval(scrollCarousel, 30); // Vitesse de défilement

