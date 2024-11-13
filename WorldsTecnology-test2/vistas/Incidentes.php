<?php
require_once __DIR__ . '/../config/conex.php';
require_once __DIR__ . '/../controlador/IncidenteController.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/WorldsTecnology-test2/style/main.css">
    <title>Incidentes</title>
</head>
<body>
    <?php include '../components/side-bar.php'; ?>
    
    <div class="container">
        <div class="container-info">
            <div class="container-info-page-title">
                <h1>Incidentes</h1>
                <a href="Crear_reporte.php" class="create-report-button">+ Crear reporte</a> <!-- Botón para crear reporte -->
            </div>
            <div class="container-info-time">
                <script src="js/hour.js" defer></script>
                <h1 id="page-hour"></h1>
            </div>
        </div>

        <!-- Tabla de incidentes -->
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Utensilio afectado</th>
                        <th>Fecha de creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Instancia del controlador y obtención de los incidentes
                    $incidenteController = new IncidenteController($mysqli);
                    $incidentes = $incidenteController->getAll();
                    
                    foreach ($incidentes as $incidente) {
                        echo "<tr>";
                        echo "<td>" . $incidente['id'] . "</td>";
                        echo "<td>" . $incidente['titulo'] . "</td>";
                        echo "<td>" . $incidente['utensilio_afectado'] . "</td>";
                        echo "<td>" . $incidente['fecha_creacion'] . "</td>";
                        echo "<td><a href='abrir_reporte.php?id=" . $incidente['id'] . "' class='report-button'>Abrir reporte</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
