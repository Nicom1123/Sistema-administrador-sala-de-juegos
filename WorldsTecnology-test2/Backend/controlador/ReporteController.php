<?php
require_once __DIR__ . '/../modelos/Reportes.php';

class ReporteController {
    private $model; // Propiedad para el modelo
    private $mysqli; // Propiedad para la conexión

    public function __construct($mysqli) {
        $this->mysqli = $mysqli; // Inicializar la conexión
        $this->model = new Reportes($mysqli); // Pasar la conexión al modelo
    }

    public function obtenerReservasHoy() {
        return $this->model->obtenerReservasHoy();
    }
    public function contarInactivos() {
        return $this->model->contarInactivos(); // Llama al método en el modelo
    }
    public function obtenerDatosGrafico() {
        $data = $this->model->obtenerReservasHoy(); // Datos del modelo
    
        return [
            'labels' => array_keys($data), // Los nombres de los juegos
            'values' => array_values($data) // Los totales de reservas
        ];
        
    }
    public function contarIncidentesDelMes() {
        return $this->model->contarIncidentesDelMes();
    }
    
    public function obtenerDatosPorLapso() {
        return $this->model->obtenerReservasPorLapso();
    }
    public function obtenerDatosSemanal() {
        return $this->model->obtenerReservasSemanal();
    }
    
    
    

}
?>
