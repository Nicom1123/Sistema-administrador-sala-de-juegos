<?php
require_once __DIR__ . '/../../Backend/config/conex.php';
require_once __DIR__ . '/../../Backend/controlador/ReporteController.php';

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php?action=login');
    exit();
}

// Instanciar el controlador
$reportesController = new ReporteController($mysqli);
$total_inactivos = $reportesController->contarInactivos(); // Total de inactivos
$total_incidentes = $reportesController->contarIncidentesDelMes(); // Total de incidentes del mes
$graficoData = $reportesController->obtenerDatosGrafico(); // Datos del gráfico
$graficoLapsos = $reportesController->obtenerDatosPorLapso(); //  
$graficoSemanal = $reportesController->obtenerDatosSemanal();


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/WorldsTecnology-test2/Frontend/style/main.css">
    <title>Reportes</title>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>
<body>
    <?php include __DIR__ . '/../components/side-bar.php'; ?>
    <div class="container">
    <h1>Reporte de datos</h1>
    <div class="reportes-container">
    <!-- Reservas realizadas hoy (Arriba Izquierda) -->
    <div class="grafico-tiempo">
        <?php include __DIR__ . '/../components/grafico-lapsos.php'; ?>
    </div>

    <!-- Juegos reservados hoy (Arriba Derecha) -->
    <div class="grafico-reservas">
        <?php include __DIR__ . '/../components/grafico-reservas.php'; ?>
    </div>

    <!-- Reservas realizadas durante el mes (Abajo Izquierda) -->
    <div class="grafico-semanal">
        <?php include __DIR__ . '/../components/grafico-semanal.php'; ?>
    </div>

    <!-- Tarjetas (Abajo Derecha) -->
    <div class="tarjetas">
        <!-- Tarjeta de juegos inactivos -->
        <div class="card-inactivos">
            <h2>Juegos inactivos</h2>
            <p><?php echo htmlspecialchars($total_inactivos); ?></p>
        </div>

        <!-- Tarjeta de incidentes del mes -->
        <div class="card-incidentes">
            <h2>Incidentes del Mes</h2>
            <p><?php echo htmlspecialchars($total_incidentes); ?></p>
        </div>
    </div>
</div>

</body>
</html>
