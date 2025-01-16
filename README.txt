Karuran GAJAROOBAN B2-IN


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

--- Création de la table recipes
CREATE TABLE recipes (
    id SERIAL PRIMARY KEY, 
    name VARCHAR(100) NOT NULL,
    description TEXT, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by INT, 
    CONSTRAINT fk_recipes_users FOREIGN KEY (created_by) REFERENCES users(id) 
);
-- Création de la table ingredients
CREATE TABLE ingredients (
    id SERIAL PRIMARY KEY, 
    recipe_id INT NOT NULL, 
    name VARCHAR(100) NOT NULL, 
    quantity VARCHAR(50), 
    CONSTRAINT fk_ingredients_recipes FOREIGN KEY (recipe_id) REFERENCES recipes(id) 
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

SELECT * FROM users;
