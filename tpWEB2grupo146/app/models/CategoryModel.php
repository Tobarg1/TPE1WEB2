<?php
class CategoryModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_tp146;charset=utf8', 'root', '');
    }

    public function getCategories() {
        $query = $this->db->prepare('SELECT * FROM categories');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getItemsByCategory($categoryId) {
        $query = $this->db->prepare('
            SELECT viaje.*, categories.name AS category_name 
            FROM viaje 
            LEFT JOIN categories ON viaje.category_id = categories.id
            WHERE viaje.category_id = ?
        ');
        $query->execute([$categoryId]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertCategory($name) {
        $query = $this->db->prepare('INSERT INTO categories (name) VALUES (?)');
        $query->execute([$name]);
    }

    public function deleteCategory($categoryId) {
        $query = $this->db->prepare('DELETE FROM categories WHERE id = ?');
        $query->execute([$categoryId]);
    }

    public function updateCategory($categoryId, $name) {
        $query = $this->db->prepare('UPDATE categories SET name = ? WHERE id = ?');
        $query->execute([$name, $categoryId]);
    }

    public function getCategory($categoryId) {
        $query = $this->db->prepare('SELECT * FROM categories WHERE id = ?');
        $query->execute([$categoryId]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
