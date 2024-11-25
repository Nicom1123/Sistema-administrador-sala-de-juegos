<?php
// Asegúrate de que `$graficoLapsos` está disponible antes de incluir este archivo.
if (!isset($graficoLapsos)) {
    throw new Exception("Los datos del gráfico no están definidos.");
}
?>

<div class="chart-container">
    <h2>Reservas realizadas Hoy</h2>
    <div id="lapsosChart" style="height: 200px; width: 100%;"></div>
</div>

<script>
    // Datos desde PHP
    const lapsosDataPoints = [];
    const lapsoLabels = <?php echo json_encode($graficoLapsos['labels']); ?>; // Nombres de los lapsos
    const lapsoValues = <?php echo json_encode($graficoLapsos['values']); ?>; // Totales de reservas por lapso

    for (let i = 0; i < lapsoLabels.length; i++) {
        lapsosDataPoints.push({ label: lapsoLabels[i], y: lapsoValues[i] });
    }

    // Configuración del gráfico
    const lapsosChart = new CanvasJS.Chart("lapsosChart", {
        animationEnabled: true,
        axisY: {
            title: "Cantidad de Reservas",
            includeZero: true
        },
        axisX: {
            title: "Lapso de Tiempo",
            labelFontSize: 12,
            labelAngle: 0,
            interval: 1
        },
        data: [{
            type: "area", //tipo de gráfico
            dataPoints: lapsosDataPoints
        }]
        
    });

    lapsosChart.render();
</script>

