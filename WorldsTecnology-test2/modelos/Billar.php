<?php
require_once __DIR__ . '/../config/conex.php';

class Billar {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function getAll() {
        $sql = "SELECT * FROM billar";
        $result = $this->mysqli->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     // Método para editar el registro
     public function editarRegistro($id, $estudiante, $hora_finalizacion) {
        $stmt = $this->mysqli->prepare("UPDATE billar SET estudiante = ?, hora_finalizacion = ? WHERE id = ?");
        $stmt->bind_param("ssi", $estudiante, $hora_finalizacion, $id);
        return $stmt->execute();
    }

    // Método para limpiar el registro
    public function limpiarRegistro($id) {
        $stmt = $this->mysqli->prepare("UPDATE billar SET estudiante = '', hora_finalizacion = '00:00:00' WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Método para bloquear el registro
    public function bloquearRegistro($id) {
        $stmt = $this->mysqli->prepare("UPDATE billar SET estado = 'bloqueado' WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function desbloquearRegistro($id) {
        $stmt = $this->mysqli->prepare("UPDATE billar SET estado = 'activo' WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    

}