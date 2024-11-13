<?php
require_once __DIR__ . '/../config/conex.php';

class Console {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function getAll() {
        $sql = "SELECT * FROM consolas";
        $result = $this->mysqli->query($sql);
        
        $consolas = [];
        while ($row = $result->fetch_assoc()) {
            $consolas[] = $row;
        }
        
        return $consolas;
    }

    public function getById($id) {
        $sql = "SELECT * FROM consolas WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Retorna el registro como un arreglo asociativo
    }

    public function editarRegistro($id, $estudiante, $hora_finalizacion) {
        $stmt = $this->mysqli->prepare("UPDATE consolas SET estudiante = ?, hora_finalizacion = ? WHERE id = ?");
        $stmt->bind_param("ssi", $estudiante, $hora_finalizacion, $id);
        return $stmt->execute();
    }

    public function limpiarRegistro($id) {
        // Actualizamos los campos estudiante y juego para que queden vacíos
        $sql = "UPDATE consolas SET estudiante = '', juego = '', hora_finalizacion = '00:00:00' WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    

    public function bloquearRegistro($id) {
        $sql = "UPDATE consolas SET estado = 'inactivo' WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    public function desbloquearRegistro($id) {
        // Aquí especificas directamente el nombre de la tabla de manera fija en el modelo
        $stmt = $this->mysqli->prepare("UPDATE consolas SET estado = 'activo' WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    
}