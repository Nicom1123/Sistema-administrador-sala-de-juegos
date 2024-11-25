<?php

class IncidenteController {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function getAll() {
        $sql = "SELECT * FROM incidentes";
        $result = $this->mysqli->query($sql);
        
        $incidentes = [];
        while ($row = $result->fetch_assoc()) {
            $incidentes[] = $row;
        }
        
        return $incidentes;
    }

    public function getById($id) {
        $stmt = $this->mysqli->prepare("SELECT * FROM incidentes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Método para guardar un nuevo incidente
    public function store($titulo, $utensilio_afectado, $descripcion) {
        $stmt = $this->mysqli->prepare("INSERT INTO incidentes (titulo, utensilio_afectado, descripcion, fecha_creacion) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $titulo, $utensilio_afectado, $descripcion);
        
        if ($stmt->execute()) {
            return true; // Éxito al guardar el incidente
        } else {
            return false; // Error al guardar el incidente
        }
    }
}
