
<?php
class UserModel {
    private $db;

    public function __construct() {
       $this->db = $db = new PDO('mysql:host=localhost;dbname=db_tp146;charset=utf8', 'root', '');
    }

    public function getUser($username) {
        $query = $this->db->prepare("SELECT * FROM usuario WHERE user = ?");
        $query->execute([$username]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
}