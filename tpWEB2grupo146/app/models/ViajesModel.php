<?php
class ViajesModel {
    private $db;

    public function __construct() {
       $this->db = $db = new PDO('mysql:host=localhost;dbname=db_tp146;charset=utf8', 'root', '');
    }

    public function obtenerTodosViajes() {
        $query = $this->db->prepare('SELECT viaje.*, categories.name AS category_name 
                                     FROM viaje 
                                     LEFT JOIN categories ON viaje.category_id = categories.id');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    

    function obtenerViajeId($id) {
            $query = $this->db->prepare('SELECT * FROM viaje WHERE id_viaje = ?');
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_OBJ);
    }

    function agregarViaje($origen, $destino, $fecha_viaje, $id_colectivo, $category_id) {
        $query = $this->db->prepare('INSERT INTO viaje (origen, destino, fecha_viaje, id_colectivo, category_id) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$origen, $destino, $fecha_viaje, $id_colectivo, $category_id]);
        return $this->db->lastInsertId();
    }
    
    function eliminarViaje($id) {
        $query = $this->db->prepare('DELETE FROM viaje WHERE id_viaje = ?');
        $query->execute([$id]);
    }

    function actualizarViaje($origen, $destino, $fecha_viaje, $id_colectivo, $category_id, $id) {
        $query = $this->db->prepare('UPDATE viaje SET origen = ?, destino = ?, fecha_viaje = ?, id_colectivo = ?, category_id = ? WHERE id_viaje = ?');
        $query->execute([$origen, $destino, $fecha_viaje, $id_colectivo, $category_id, $id]);
    }
    
    public function getItemsByCategory($categoryId) {
        $query = $this->db->prepare('SELECT viaje.*, categories.name AS category_name 
            FROM viaje 
            LEFT JOIN categories ON viaje.category_id = categories.id
            WHERE viaje.category_id = ?
        ');
        $query->execute([$categoryId]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getCategories() {
        $query = $this->db->prepare('SELECT * FROM categories');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    
    
}