<?php
require_once __DIR__ . '/../config/conex.php';

class PingPong {
    private $mysqli;
    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }
    public function getAll() {
        $sql = "SELECT * FROM PingPong";
        $result = $this->mysqli->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function editarRegistro($id, $estudiante, $hora_finalizacion) {
        $stmt = $this->mysqli->prepare("UPDATE PingPong SET estudiante = ?, hora_finalizacion = ? WHERE id = ?");
        $stmt->bind_param("ssi", $estudiante, $hora_finalizacion, $id);
        return $stmt->execute();
    }

    // Método para limpiar el registro
    public function limpiarRegistro($id) {
        $stmt = $this->mysqli->prepare("UPDATE PingPong SET estudiante = '', hora_finalizacion = '00:00:00' WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Método para bloquear el registro
    public function bloquearRegistro($id) {
        $stmt = $this->mysqli->prepare("UPDATE PingPong SET estado = 'inactivo' WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function desbloquearRegistro($id) {
        $stmt = $this->mysqli->prepare("UPDATE PingPong SET estado = 'activo' WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function countByStatus($status) {
        $sql = "SELECT COUNT(*) as count FROM PingPong WHERE estado = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $status);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'];
    }   
}