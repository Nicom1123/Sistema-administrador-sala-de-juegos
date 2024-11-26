<?php
require_once __DIR__ . '/../config/conex.php';

class Incidente {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function getAll() {
        $sql = "SELECT id, titulo, utensilio_afectado, DATE_FORMAT(fecha_creacion, '%d/%m/%Y - %h:%i %p') AS fecha_formateada FROM incidentes";
        $result = $this->mysqli->query($sql);

        $incidentes = [];
        while ($row = $result->fetch_assoc()) {
            $incidentes[] = $row;
        }
        return $incidentes;
    }

    public function add($titulo, $utensilio_afectado, $descripcion) {
        $stmt = $this->mysqli->prepare("INSERT INTO incidentes (titulo, utensilio_afectado, descripcion, fecha_creacion) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $titulo, $utensilio_afectado, $descripcion);
        return $stmt->execute();
    }
    public function getAllIncidentes() {
        $sql = "SELECT id, titulo, utensilio_afectado, fecha_creacion FROM incidentes";
        $result = $this->mysqli->query($sql);
        
        $incidentes = [];
        while ($row = $result->fetch_assoc()) {
            $incidentes[] = $row;
        }
        
        return $incidentes;
    }
}
?>
