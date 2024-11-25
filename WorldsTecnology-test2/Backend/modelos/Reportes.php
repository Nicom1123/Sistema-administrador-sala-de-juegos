<?php
class Reportes {
    private $mysqli; // Propiedad para la conexión

    public function __construct($mysqli) {
        $this->mysqli = $mysqli; // Inicializar la conexión
    }

    public function obtenerReservasHoy() {
        // Lista fija de juegos con claves en minúsculas
        $juegos = ['consolas', 'pingpong', 'billar', 'futbolito', 'aerohockey'];
        $data = array_fill_keys($juegos, 0); // Inicializa con 0
    
        $sql = "SELECT LOWER(juego) as juego, COUNT(*) as total 
                FROM reservas_historial 
                WHERE DATE(fecha) = CURDATE() 
                GROUP BY LOWER(juego)";
        $result = $this->mysqli->query($sql);
    
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                if (array_key_exists($row['juego'], $data)) {
                    $data[$row['juego']] = (int) $row['total'];
                }
            }
        }
    
        return $data; // Devuelve los juegos con sus valores
    }
    
    
    
    
    public function contarInactivos() {
        $tables = ['consolas', 'pingpong', 'aerohockey', 'billar', 'futbolito'];
        $total_inactivos = 0;

        foreach ($tables as $table) {
            $sql = "SELECT COUNT(*) as count FROM $table WHERE estado = 'inactivo'";
            $result = $this->mysqli->query($sql);
            if ($result) {
                $row = $result->fetch_assoc();
                $total_inactivos += $row['count'];
            }
        }

        return $total_inactivos;
    }
    public function contarIncidentesDelMes() {
        $sql = "SELECT COUNT(*) as total 
                FROM Incidentes 
                WHERE MONTH(fecha_creacion) = MONTH(CURDATE()) 
                  AND YEAR(fecha_creacion) = YEAR(CURDATE())";
        $result = $this->mysqli->query($sql);
    
        if ($row = $result->fetch_assoc()) {
            return $row['total'];
        }
        return 0; // Devuelve 0 si no hay incidentes este mes
    }
    public function obtenerReservasPorLapso() {
        $sql = "
            SELECT
                CASE
                    WHEN TIME(fecha) <= '12:30:00' THEN '9:30 AM - 12:30 PM'
                    WHEN TIME(fecha) > '12:30:00' AND TIME(fecha) <= '15:30:00' THEN '12:30 PM - 3:30 PM'
                    WHEN TIME(fecha) > '15:30:00' AND TIME(fecha) <= '17:30:00' THEN '3:30 PM - 5:30 PM'
                    ELSE '5:30 PM en adelante'
                END AS lapso,
                COUNT(*) as total
            FROM reservas_historial
            WHERE DATE(fecha) = CURDATE()
            GROUP BY lapso
            ORDER BY FIELD(lapso, 
                '9:30 AM - 12:30 PM', 
                '12:30 PM - 3:30 PM', 
                '3:30 PM - 5:30 PM', 
                '5:30 PM en adelante'
            );
        ";
    
        $result = $this->mysqli->query($sql);
    
        $data = ['labels' => [], 'values' => []];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data['labels'][] = $row['lapso'];
                $data['values'][] = (int)$row['total'];
            }
        }
        return $data;
    }
    public function obtenerReservasSemanal() {
        $sql = "
            SELECT 
                DAYNAME(fecha) AS dia,
                COUNT(*) AS total
            FROM reservas_historial
            WHERE MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())
            GROUP BY dia
            ORDER BY FIELD(dia, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')
        ";
    
        $result = $this->mysqli->query($sql);
    
        $data = ['labels' => [], 'values' => []];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data['labels'][] = $row['dia'];
                $data['values'][] = (int)$row['total'];
            }
        }
    
        return $data;
    }
    
    
    

}
?>
