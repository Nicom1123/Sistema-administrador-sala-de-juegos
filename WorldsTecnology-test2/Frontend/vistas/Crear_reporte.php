<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Reporte</title>
    <link rel="stylesheet" href="/WorldsTecnology-test2/Frontend/style/main.css">
</head>
<body>
<div class="report-container">
    <h2>Crear reporte</h2>
    <form action="guardar_reporte.php" method="POST">
        <label for="titulo">Título del reporte:</label>
        <input type="text" name="titulo" id="titulo" required>

        <label for="utensilio_afectado">Juego afectado:</label>
        <input type="text" name="utensilio_afectado" id="utensilio_afectado" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" rows="5" required></textarea>

        <button type="submit" class="btn-confirm">Crear reporte</button>
        <a href="incidentes.php" class="btn-cancel">Cancelar</a>
    </form>
</div>

</body>
</html>
