<?php
class Bdd {
    public static function connexion() {
        try {
            $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=sauce", "postgres", "root");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo; 
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
}