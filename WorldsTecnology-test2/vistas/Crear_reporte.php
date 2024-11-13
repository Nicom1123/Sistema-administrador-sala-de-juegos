<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Reporte</title>
    <link rel="stylesheet" href="/ruta/a/tu_estilo.css">
</head>
<body>
    <h2>Crear reporte</h2>
    <form action="guardar_reporte.php" method="POST">
        <label for="titulo">Título del reporte:</label>
        <input type="text" name="titulo" id="titulo" required>

        <label for="utensilio_afectado">Utensilio afectado:</label>
        <input type="text" name="utensilio_afectado" id="utensilio_afectado" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required></textarea>

        <button type="submit">Crear reporte</button>
        <a href="incidentes.php" class="btn-cancel">Cancelar</a>
    </form>
</body>
</html>
