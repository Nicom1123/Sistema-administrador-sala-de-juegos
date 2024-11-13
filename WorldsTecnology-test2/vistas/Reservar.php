<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservar Útil</title>
    <link rel="stylesheet" href="ruta/a/tu_estilo.css">
</head>
<body>
    <h2>Reservar Útil</h2>

    <?php
    require_once __DIR__ . '/../config/conex.php';

    // Inicializar variables
    $tipo_util = $_POST['tipo_util'] ?? '';
    $estudiante = $_POST['estudiante'] ?? '';
    $juego = $_POST['juego'] ?? '';
    $hora_finalizacion = $_POST['hora_finalizacion'] ?? '';

    // Lista de tablas permitidas
    $allowedTables = ['consolas', 'pingpong', 'aerohockey', 'billar', 'futbolito'];
    ?>

    <form action="reservar.php" method="POST">
        <!-- Selector de tipo de útil -->
        <label for="tipo_util">Selecciona el tipo de útil:</label>
        <select name="tipo_util" id="tipo_util" required onchange="this.form.submit()">
            <option value="">Seleccione</option>
            <option value="consolas" <?php if ($tipo_util == 'consolas') echo 'selected'; ?>>Consolas</option>
            <option value="pingpong" <?php if ($tipo_util == 'pingpong') echo 'selected'; ?>>Ping Pong</option>
            <option value="aerohockey" <?php if ($tipo_util == 'aerohockey') echo 'selected'; ?>>Aerohockey</option>
            <option value="billar" <?php if ($tipo_util == 'billar') echo 'selected'; ?>>Billar</option>
            <option value="futbolito" <?php if ($tipo_util == 'futbolito') echo 'selected'; ?>>Futbolito</option>
        </select>

        <!-- Campo para el nombre del juego (solo si es necesario) -->
        <?php if ($tipo_util == 'consolas'): ?>
            <label for="juego">Nombre del Juego:</label>
            <input type="text" name="juego" id="juego" value="<?php echo htmlspecialchars($juego); ?>" required>
        <?php endif; ?>

        <!-- Campo para el nombre del estudiante -->
        <label for="estudiante">Nombre del Estudiante:</label>
        <input type="text" name="estudiante" id="estudiante" value="<?php echo htmlspecialchars($estudiante); ?>" required>

        <!-- Campo para el tiempo de reserva -->
        <label for="hora_finalizacion">Hora de Finalización:</label>
        <input type="time" name="hora_finalizacion" id="hora_finalizacion" value="<?php echo htmlspecialchars($hora_finalizacion); ?>" required>
        
        <button type="submit">Reservar</button>
    </form>

    <?php
    // Procesamiento de la reserva al enviar el formulario completo
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $tipo_util && $estudiante && $hora_finalizacion) {
        if (in_array($tipo_util, $allowedTables)) {
            // Verificar si el campo `juego` es necesario en la tabla seleccionada
            $sql = $tipo_util === 'consolas'
                ? "INSERT INTO $tipo_util (juego, estudiante, hora_finalizacion, estado) VALUES (?, ?, ?, 'activo')"
                : "INSERT INTO $tipo_util (estudiante, hora_finalizacion, estado) VALUES (?, ?, 'activo')";

            $stmt = $mysqli->prepare($sql);
            if ($tipo_util === 'consolas') {
                $stmt->bind_param("sss", $juego, $estudiante, $hora_finalizacion);
            } else {
                $stmt->bind_param("ss", $estudiante, $hora_finalizacion);
            }

            if ($stmt->execute()) {
                // Redirigir a la página principal después de una reserva exitosa
                header("Location: Console.php");
                exit();
            } else {
                echo "<p>Error al realizar la reserva.</p>";
            }
        } else {
            echo "<p>Error: Tipo de útil no válido.</p>";
        }
    }
    ?>
</body>
</html>
