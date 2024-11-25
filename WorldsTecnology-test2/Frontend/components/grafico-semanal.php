<?php
// Asegúrate de que `$graficoSemanal` está disponible antes de incluir este archivo.
if (!isset($graficoSemanal)) {
    throw new Exception("Los datos del gráfico semanal no están definidos.");
}
?>

<div class="chart-container">
    <h2>Reservas realizadas durante el mes</h2>
    <div id="semanalChart" style="height: 200px; width: 100%;"></div>
</div>

<script>
    // Datos desde PHP
    const semanalDataPoints = <?php echo json_encode(array_map(function($label, $value) {
        return ['label' => $label, 'y' => $value];
    }, $graficoSemanal['labels'], $graficoSemanal['values'])); ?>;

    // Configuración del gráfico
    const semanalChart = new CanvasJS.Chart("semanalChart", {
        animationEnabled: true,
        colorSet: "blueShades", // Usamos el color #0260AE
        title: {
        },
        axisY: {
            title: "Cantidad de Reservas",
            includeZero: true
        },
        axisX: {
            title: "Día de la Semana",
            interval: 1,
            labelFontSize: 12,
        },
        data: [{
            type: "area", // Gráfico de área
            markerSize: 8, // Tamaño de los puntos
            dataPoints: semanalDataPoints
        }]
    });

    semanalChart.render();
</script>
