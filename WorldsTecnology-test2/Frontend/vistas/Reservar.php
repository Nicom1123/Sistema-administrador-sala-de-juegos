<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservar Juego</title>
    <link rel="stylesheet" href="/WorldsTecnology-test2/Frontend/style/main.css">
</head>
<body>

    <?php
    require_once __DIR__ . '/../../Backend/config/conex.php';

    // Inicializar variables
    $tipo_util = $_POST['tipo_util'] ?? '';
    $estudiante = $_POST['estudiante'] ?? '';
    $hora_finalizacion = $_POST['hora_finalizacion'] ?? '';
    $juego = $_POST['juego'] ?? ''; // Nueva variable

    // Lista de tablas permitidas
    $allowedTables = ['consolas', 'pingpong', 'aerohockey', 'billar', 'futbolito'];

    // Obtener registros disponibles
    $registrosDisponibles = [];
    if ($tipo_util && in_array($tipo_util, $allowedTables)) {
        $query = "SELECT id FROM $tipo_util WHERE estudiante = '' AND estado = 'activo'";
        $result = $mysqli->query($query);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $registrosDisponibles[] = $row['id'];
            }
        }
    }
    ?>

    <div class="form-container">
        <h2>Reservar Juego</h2>
        <form action="reservar.php" method="POST">
            <label for="tipo_util">Selecciona el tipo de Juego:</label>
            <select name="tipo_util" id="tipo_util" required onchange="this.form.submit()">
                <option value="">Seleccione</option>
                <option value="consolas" <?php if ($tipo_util == 'consolas') echo 'selected'; ?>>Consolas</option>
                <option value="pingpong" <?php if ($tipo_util == 'pingpong') echo 'selected'; ?>>Ping Pong</option>
                <option value="aerohockey" <?php if ($tipo_util == 'aerohockey') echo 'selected'; ?>>Aerohockey</option>
                <option value="billar" <?php if ($tipo_util == 'billar') echo 'selected'; ?>>Billar</option>
                <option value="futbolito" <?php if ($tipo_util == 'futbolito') echo 'selected'; ?>>Futbolito</option>
            </select>

            <?php if ($tipo_util == 'consolas'): ?>
                <label for="juego">Nombre del Juego:</label>
                <input type="text" name="juego" id="juego" value="<?php echo htmlspecialchars($juego); ?>" required>
            <?php endif; ?>

            <?php if (!empty($registrosDisponibles)): ?>
                <label for="registro_id">Selecciona un registro disponible:</label>
                <select name="registro_id" id="registro_id" required>
                    <option value="">Seleccione</option>
                    <?php foreach ($registrosDisponibles as $id): ?>
                        <option value="<?php echo $id; ?>"><?php echo $id; ?></option>
                    <?php endforeach; ?>
                </select>
            <?php elseif ($tipo_util): ?>
                <p>No hay registros disponibles para el tipo de juego seleccionado.</p>
            <?php endif; ?>

            <label for="estudiante">Nombre del Estudiante:</label>
            <input type="text" name="estudiante" id="estudiante" value="<?php echo htmlspecialchars($estudiante); ?>" required>

            <label for="hora_finalizacion">Hora de Finalización:</label>
            <input type="time" name="hora_finalizacion" id="hora_finalizacion" value="<?php echo htmlspecialchars($hora_finalizacion); ?>" required>

            <button type="submit" class="btn-confirm">Reservar</button>
            <button type="button" class="btn-cancel" onclick="window.location.href='Consolas.php';">Cancelar</button>
        </form>
    </div>

    <?php
    // Procesamiento de la reserva al enviar el formulario completo
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $tipo_util && $estudiante && $hora_finalizacion) {
        if (in_array($tipo_util, $allowedTables)) {
            $registro_id = $_POST['registro_id'] ?? null;
            $juego = $_POST['juego'] ?? null;

            if ($registro_id) {
                // SQL dinámico según el tipo de útil
                $sql = $tipo_util === 'consolas'
                    ? "UPDATE $tipo_util SET juego = ?, estudiante = ?, hora_finalizacion = ? WHERE id = ?"
                    : "UPDATE $tipo_util SET estudiante = ?, hora_finalizacion = ? WHERE id = ?";

                $stmt = $mysqli->prepare($sql);
                if ($tipo_util === 'consolas') {
                    $stmt->bind_param("sssi", $juego, $estudiante, $hora_finalizacion, $registro_id);
                } else {
                    $stmt->bind_param("ssi", $estudiante, $hora_finalizacion, $registro_id);
                }

                if ($stmt->execute()) {
                    header("Location: Consolas.php");
                    exit();
                } else {
                    echo "<p>Error al realizar la reserva.</p>";
                }
            } else {
                echo "<p>Error: Debes seleccionar un registro disponible.</p>";
            }
        } else {
            echo "<p>Error: Tipo de útil no válido.</p>";
        }
    }
    ?>

</body>
</html>
