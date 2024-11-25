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
        // Ejecutar el UPDATE en la tabla consolas
        $stmt = $this->mysqli->prepare("UPDATE consolas SET estudiante = ?, hora_finalizacion = ? WHERE id = ?");
        $stmt->bind_param("ssi", $estudiante, $hora_finalizacion, $id);
        $resultado = $stmt->execute();
    
        if ($resultado) {
            // Si el UPDATE fue exitoso, registrar en reservas_historial
            $juego = 'consolas'; // Nombre del juego (o tabla)
            
            // Preparar el INSERT para reservas_historial
            $insertStmt = $this->mysqli->prepare("INSERT INTO reservas_historial (juego) VALUES (?)");
            if (!$insertStmt) {
                error_log("Error en la preparación del INSERT: " . $this->mysqli->error);
            } else {
                $insertStmt->bind_param("s", $juego);
    
                // Ejecutar el INSERT y registrar errores si ocurren
                if (!$insertStmt->execute()) {
                    error_log("Error al ejecutar el INSERT en reservas_historial: " . $this->mysqli->error);
                } else {
                    error_log("Registro exitoso en reservas_historial para el juego: $juego");
                }
    
                $insertStmt->close(); // Cerrar el statement del INSERT
            }
        } else {
            error_log("Error al ejecutar el UPDATE en consolas: " . $this->mysqli->error);
        }
    
        $stmt->close(); // Cerrar el statement del UPDATE
        return $resultado; // Retornar el resultado del UPDATE
    }

    public function insertarEnHistorial($juego) {
        // Preparar la consulta
        $stmt = $this->mysqli->prepare("INSERT INTO reservas_historial (juego) VALUES (?)");
    
        // Verificar si la preparación falló
        if (!$stmt) {
            error_log("Error en la preparación del INSERT: " . $this->mysqli->error);
            return false;
        }
    
        // Asignar el valor al parámetro
        $stmt->bind_param("s", $juego);
    
        // Ejecutar la consulta e identificar errores
        if (!$stmt->execute()) {
            error_log("Error al ejecutar el INSERT en reservas_historial: " . $this->mysqli->error);
            return false;
        }
    
        // Registro exitoso
        error_log("Registro exitoso en reservas_historial para el juego: $juego");
    
        // Cerrar el statement
        $stmt->close();
    
        return true; // Retornar true si todo fue exitoso
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
    public function countByStatus($status) {
        $sql = "SELECT COUNT(*) as count FROM consolas WHERE estado = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $status);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    
    
}