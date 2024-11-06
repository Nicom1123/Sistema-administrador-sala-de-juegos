<?php
require_once __DIR__ . '/../config/conex.php';

class Admin {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function authenticate($username, $password) {
        $sql = "SELECT * FROM administradores WHERE username = ? AND password = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Verificar si se encontró un usuario con las credenciales dadas
        return $result->num_rows === 1;
    }
}
