<?php
require_once __DIR__ . '/../../Backend/config/conex.php';
require_once __DIR__ . '/../../Backend/controlador/IncidenteController.php';

// Verificar que el parámetro 'id' esté presente en la URL
if (!isset($_GET['id'])) {
    echo "Error: Parámetros faltantes.";
    exit();
}

$id = $_GET['id'];

// Instanciar el controlador de incidentes y obtener el reporte específico
$incidenteController = new IncidenteController($mysqli);
$incidente = $incidenteController->getById($id);

if (!$incidente) {
    echo "Error: No se encontró el reporte de incidente.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/WorldsTecnology-test2/Frontend/style/main.css">
    <title>Detalles del Incidente</title>
</head>
<body>
    <?php include '../components/side-bar.php'; ?>
    
    <div class="container">
        <div class="container-info">
            <div class="container-info-page-title">
                <h1>Detalles del Incidente</h1>
            </div>
        </div>

        <div class="container-details">
            <h2><?php echo htmlspecialchars($incidente['titulo']); ?></h2>
            <p><strong>Juego afectado:</strong> <?php echo htmlspecialchars($incidente['utensilio_afectado']); ?></p>
            <p><strong>Fecha de creación:</strong> <?php echo htmlspecialchars($incidente['fecha_creacion']); ?></p>
            <p><strong>Descripción:</strong></p>
            <p><?php echo nl2br(htmlspecialchars($incidente['descripcion'])); ?></p>
        </div>

        <div class="container-actions">
            <a href="Incidentes.php" class="back-button">Volver a la lista de incidentes</a>
        </div>
    </div>
</body>
</html>
