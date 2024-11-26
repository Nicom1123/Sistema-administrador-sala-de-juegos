<?php
require_once __DIR__ . '/../../Backend/config/conex.php';
require_once __DIR__ . '/../../Backend/controlador/IncidenteController.php';

$incidenteController = new IncidenteController($mysqli);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $utensilio_afectado = $_POST['utensilio_afectado'];
    $descripcion = $_POST['descripcion'];

    if ($incidenteController->store($titulo, $utensilio_afectado, $descripcion)) {
        echo "Incidente guardado exitosamente.";
        header("Location: Incidentes.php");
        exit();
    } else {
        echo "Error al guardar el incidente.";
    }
}

?>
