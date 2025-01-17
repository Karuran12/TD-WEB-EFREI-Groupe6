<?php
session_start();
require_once './model/bdd.php';

function getAllRecipes() {
    global $sauce;
    $query = $sauce->prepare('SELECT * FROM recipes ORDER BY created_at DESC');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getRecipeById($id) {
    global $sauce;
    $query = $sauce->prepare('SELECT * FROM recipes WHERE id = :id');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function addRecipe($name, $desc, $imagePath, $category) {
    global $sauce;
    $query = $sauce->prepare('
        INSERT INTO recipes (name, description, image, category, created_at) 
        VALUES (:name, :description, :image, :category, CURRENT_TIMESTAMP)
    ');
    $query->bindValue(':name', $name, PDO::PARAM_STR);
    $query->bindValue(':description', $desc, PDO::PARAM_STR);
    $query->bindValue(':image', $imagePath, PDO::PARAM_STR);
    $query->bindValue(':category', $category, PDO::PARAM_STR);
    $query->execute();
}

function updateRecipe($id, $name, $description, $imagePath, $category) {
    global $sauce;
    $query = $sauce->prepare('
        UPDATE recipes 
        SET name = :name, description = :description, image = :image, category = :category
        WHERE id = :id
    ');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->bindValue(':name', $name, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':image', $imagePath, PDO::PARAM_STR);
    $query->bindValue(':category', $category, PDO::PARAM_STR);
    $query->execute();
}

function deleteRecipe($id) {
    global $sauce;
    $query = $sauce->prepare('DELETE FROM recipes WHERE id = :id');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
}

function authenticateAdmin($username, $password) {
    global $sauce;
    $query = $sauce->prepare('SELECT * FROM admins WHERE username = :username');
    $query->bindValue(':username', $username, PDO::PARAM_STR);
    $query->execute();
    $admin = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($admin && password_verify($password, $admin['password'])) {
        return true;
    }
    return false;
}

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin-login.php');
    exit;
}

if (isset($_GET['id'])) {
    $recipeId = $_GET['id'];
    $recipe = getRecipeById($recipeId);
    
    if (!$recipe) {
        die('Erreur : Aucune recette trouvée.');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $recipeName = $_POST['name'];
        $description = $_POST['description'];
        $category = $_POST['category'];  // Nouveau champ category
        $image = $_FILES['image'];

        $imagePath = $recipe['image'];
        if ($image['size'] > 0) {
            $uploadDir = 'photos-recettes/';
            $imagePath = $uploadDir . basename($image['name']);
            move_uploaded_file($image['tmp_name'], $imagePath);
        }

        updateRecipe($recipeId, $recipeName, $description, $imagePath, $category);
        header('Location: admin-recipes.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_recipe'])) {
    $recipeName = $_POST['recipe_name'];
    $description = $_POST['description'];
    $category = $_POST['category'];  // Nouveau champ category
    $image = $_FILES['image'];

    $imagePath = 'photos-recettes/default.jpg';
    if ($image['size'] > 0) {
        $uploadDir = 'photos-recettes/';
        $imagePath = $uploadDir . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $imagePath);
    }

    addRecipe($recipeName, $description, $imagePath, $category);
    header('Location: admin-recipes.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (authenticateAdmin($username, $password)) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin-recipes.php');
        exit;
    } else {
        $error = "Identifiants incorrects";
    }
}

if (isset($_GET['delete_id'])) {
    $recipeId = $_GET['delete_id'];
    deleteRecipe($recipeId);
    header('Location: admin-recipes.php');
    exit;
}
?>
