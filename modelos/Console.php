<?php
require_once __DIR__ . '/../config/conex.php';

class Console {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function getAll() {
        $sql = "SELECT * FROM consolas";
        return $this->mysqli->query($sql);
    }

    public function getById($id) {
        $sql = "SELECT * FROM consolas WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
