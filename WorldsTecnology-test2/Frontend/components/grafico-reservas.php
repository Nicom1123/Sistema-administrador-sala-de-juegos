<?php
// Asegúrate de que `$graficoData` está disponible antes de incluir este archivo.
if (!isset($graficoData)) {
    throw new Exception("Los datos del gráfico no están definidos.");
}
?>

<div class="chart-container">
    <h2>Juegos reservados hoy</h2>
    <div id="reservasChart" style="height: 200px; width: 100%;"></div>
</div>

<script>
    // Datos desde PHP
    const dataPoints = [];
    const labels = <?php echo json_encode($graficoData['labels']); ?>; // Nombres de los juegos
    const values = <?php echo json_encode($graficoData['values']); ?>; // Totales de reservas

    for (let i = 0; i < labels.length; i++) {
        dataPoints.push({ label: labels[i], y: values[i] });
    }

    // Definir un conjunto de colores personalizados
    CanvasJS.addColorSet("blueShades", [ "#0260AE" ]);

    // Configuración del gráfico
    const chart = new CanvasJS.Chart("reservasChart", {
        animationEnabled: true,
        colorSet: "blueShades", // Aplica el conjunto de colores personalizado
        axisY: {
            title: "Cantidad de Reservas",
            includeZero: true
        },
        axisX: {
            title: "Juegos",
            labelFontSize: 12,
            labelAngle: 0,
            interval: 1
        },
        data: [{
            type: "column",
            dataPoints: dataPoints
        }]
    });

    chart.render();
</script>