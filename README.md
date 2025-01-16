# TD-WEB-EFREI-Groupe6

Karuran GAJAROOBAN B2-IN
Nathan BOUCHE B2-IN 
Tom GUITTET B2-IN


-----------SQL----------------------
-- DROP DATABASE IF EXISTS sauce;

CREATE DATABASE sauce
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'C'
    LC_CTYPE = 'C'
    LOCALE_PROVIDER = 'libc'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;


-- Création de la table users
CREATE TABLE users (
    id SERIAL PRIMARY KEY, 
    username VARCHAR(20) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL, 
    password VARCHAR(255) NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    avatar VARCHAR(255) DEFAULT 'photos/avatar1.png'
);

-- Création de la table admins
CREATE TABLE admins (
    id SERIAL PRIMARY KEY, 
    username VARCHAR(20) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

-- Table des recettes
CREATE TABLE recipes (
    id SERIAL PRIMARY KEY, 
    name VARCHAR(100) NOT NULL, 
    description TEXT, 
    image VARCHAR(255)
);

-- Table des ingrédients
CREATE TABLE ingredients (
    id SERIAL PRIMARY KEY, 
    name VARCHAR(100) NOT NULL, 
    quantity VARCHAR(50), 
    category VARCHAR(50)
);

-- Table pivot pour associer recettes et ingrédients
CREATE TABLE recipe_ingredients (
    recipe_id INT NOT NULL, 
    ingredient_id INT NOT NULL, 
    PRIMARY KEY (recipe_id, ingredient_id),
    CONSTRAINT fk_recipe FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE,
    CONSTRAINT fk_ingredient FOREIGN KEY (ingredient_id) REFERENCES ingredients(id) ON DELETE CASCADE
);

-- Création de la table ratings
CREATE TABLE ratings (
    id SERIAL PRIMARY KEY, 
    recipe_id INT NOT NULL,
    user_id INT NOT NULL, 
    rating SMALLINT NOT NULL CHECK (rating BETWEEN 1 AND 5), 
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    CONSTRAINT fk_ratings_recipes FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE, 
    CONSTRAINT fk_ratings_users FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Ajouter des recettes
INSERT INTO recipes (name, description, image) VALUES
('Tarte aux pommes', 'Une délicieuse tarte aux pommes maison.', 'photos-recettes/tarte_pommes.jpeg'),
('Pizza Margherita', 'Une pizza italienne classique.', 'photos-recettes/pizzamar.jpeg'),
('Tarte aux fraises', 'Une tarte fraîche avec des fraises juteuses.', 'photos-recettes/tarte_fraises.jpeg'),
('Quiche Lorraine', 'Une quiche classique avec lardons et crème.', 'photos-recettes/quiche_lorraine.jpeg'),
('Boeuf Bourguignon', 'Un ragoût français traditionnel au vin rouge.', 'photos-recettes/boeuf_bourguignon.jpeg'),
('Ratatouille', 'Un plat végétarien provençal avec des légumes frais.', 'photos-recettes/ratatouille.jpeg'),
('Pâtes Carbonara', 'Des pâtes italiennes avec une sauce crémeuse aux lardons.', 'photos-recettes/pates_carbonara.jpeg'),
('Soupe à l’oignon', 'Une soupe traditionnelle française gratinée.', 'photos-recettes/soupe_oignon.jpeg'),
('Brownies au chocolat', 'Des brownies fondants et riches en chocolat.', 'photos-recettes/brownies.jpeg'),
('Lasagnes', 'Des lasagnes riches avec de la viande et de la sauce béchamel.', 'photos-recettes/lasagnes.jpeg'),
('Crêpes Suzette', 'Des crêpes classiques flambées à l’orange.', 'photos-recettes/crepes_suzette.jpeg'),
('Salade César', 'Une salade légère avec poulet, croûtons et parmesan.', 'photos-recettes/salade_cesar.jpeg');

-- Ajouter des ingrédients pour les nouvelles recettes
INSERT INTO ingredients (name, quantity, category) VALUES
('Pommes', '4', 'Fruit'),
('Sucre', '100g', 'Épice'),
('Farine', '200g', 'Autre'),
('Tomates', '3', 'Légume'),
('Mozzarella', '200g', 'Fromage'),
('Basilic', 'Quelques feuilles', 'Herbe'),
('Fraises', '300g', 'Fruit'),
('Pâte sablée', '1 rouleau', 'Autre'),
('Crème pâtissière', '200g', 'Produit laitier'),
('Lardons', '150g', 'Viande'),
('Œufs', '3', 'Produit laitier'),
('Crème fraîche', '200ml', 'Produit laitier'),
('Pâte brisée', '1 rouleau', 'Autre'),
('Bœuf', '500g', 'Viande'),
('Vin rouge', '500ml', 'Boisson'),
('Carottes', '3', 'Légume'),
('Oignons', '2', 'Légume'),
('Aubergines', '2', 'Légume'),
('Courgettes', '2', 'Légume'),
('Poivrons', '2', 'Légume'),
('Pâtes', '300g', 'Céréale'),
('Parmesan', '50g', 'Fromage'),
('Bouillon de volaille', '500ml', 'Autre'),
('Pain', 'Quelques tranches', 'Céréale'),
('Gruyère râpé', '100g', 'Fromage'),
('Chocolat noir', '200g', 'Autre'),
('Beurre', '150g', 'Produit laitier'),
('Pâtes à lasagne', '1 paquet', 'Céréale'),
('Viande hachée', '300g', 'Viande'),
('Béchamel', '200ml', 'Produit laitier'),
('Crêpes', '6', 'Céréale'),
('Orange', '2', 'Fruit'),
('Salade romaine', '1', 'Légume'),
('Poulet', '200g', 'Viande'),
('Croûtons', '50g', 'Céréale');


-- Associer les ingrédients aux recettes
INSERT INTO recipe_ingredients (recipe_id, ingredient_id) VALUES
-- Tarte aux pommes
(1, 1),
(1, 2),
(1, 3), 

-- Pizza Margherita
(2, 4),
(2, 5),
(2, 6),

-- Tarte aux fraises
(3, 7),
(3, 8),
(3, 9), 

-- Quiche Lorraine
(4, 10),
(4, 11),
(4, 12),
(4, 13),

-- Boeuf Bourguignon
(5, 14),
(5, 15),
(5, 16),
(5, 17),

-- Ratatouille
(6, 18),
(6, 19),
(6, 4),
(6, 20),

-- Pâtes Carbonara
(7, 21),
(7, 10),
(7, 11),
(7, 22),

-- Soupe à l’oignon
(8, 17),
(8, 23),
(8, 24),
(8, 25),

-- Brownies au chocolat
(9, 26),
(9, 27), 
(9, 2),
(9, 11),

-- Lasagnes
(10, 28),
(10, 29),
(10, 4),
(10, 30),

-- Crêpes Suzette
(11, 31),
(11, 32),
(11, 27),
(11, 2),

-- Salade César
(12, 33),
(12, 34),
(12, 35),
(12, 22);