<?php
require_once __DIR__ . '/../../Backend/config/conex.php';

// Lista de tablas permitidas
$allowedTables = ['consolas', 'PingPong', 'aerohockey', 'billar', 'futbolito']; // Agrega otras tablas válidas

// Verificar que los parámetros estén presentes
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_GET['table'])) {
    $id = $_GET['id'];
    $table = $_GET['table'];

    // Validar la tabla
    if (!in_array($table, $allowedTables)) {
        echo "Error: Tabla no válida.";
        exit();
    }

    // Obtener datos actuales del registro en la tabla especificada
    $sql = $table === 'consolas' 
        ? "SELECT estudiante, hora_finalizacion, juego FROM $table WHERE id = ?"
        : "SELECT estudiante, hora_finalizacion FROM $table WHERE id = ?";
    
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "Error: Registro no encontrado.";
        exit();
    }
}

// Procesamiento del formulario al enviarlo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['table'])) {
    $id = $_POST['id'];
    $table = $_POST['table'];
    $estudiante = $_POST['estudiante'];
    $hora_finalizacion = $_POST['hora_finalizacion'];

    // Lista de tablas permitidas (definirla nuevamente en esta sección)
    $allowedTables = ['consolas', 'PingPong', 'aerohockey', 'billar', 'futbolito'];

    // Validar la tabla
    if (!in_array($table, $allowedTables)) {
        echo "Error: Tabla no válida.";
        exit();
    }

    // Actualizar registro en la tabla especificada
    if ($table === 'consolas') {
        $juego = $_POST['juego'] ?? null;
        $sql = "UPDATE $table SET estudiante = ?, hora_finalizacion = ?, juego = ? WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssi", $estudiante, $hora_finalizacion, $juego, $id);
    } else {
        $sql = "UPDATE $table SET estudiante = ?, hora_finalizacion = ? WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssi", $estudiante, $hora_finalizacion, $id);
    }

    $stmt->execute();

    // Registrar en reservas_historial
    $historialStmt = $mysqli->prepare("INSERT INTO reservas_historial (juego) VALUES (?)");
    $historialStmt->bind_param("s", $table);
    $historialStmt->execute();

    // Redirigir de nuevo a la lista de consolas (o tabla correspondiente)
    header("Location: " . ucfirst($table) . ".php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="/WorldsTecnology-test2/Frontend/style/main.css">
</head>
<body>
<div class="edit-container">
    <h2>Editar Registro de <?php echo ucfirst($table); ?></h2>
    <form action="editar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <input type="hidden" name="table" value="<?php echo htmlspecialchars($table); ?>">

        <label for="estudiante">Estudiante:</label>
        <input type="text" name="estudiante" id="estudiante" value="<?php echo htmlspecialchars($row['estudiante']); ?>" required>

        <label for="hora_finalizacion">Hora de Finalización:</label>
        <input type="time" name="hora_finalizacion" id="hora_finalizacion" value="<?php echo htmlspecialchars($row['hora_finalizacion']); ?>" required>

        <?php if ($table === 'consolas'): ?>
            <label for="juego">Juego:</label>
            <input type="text" name="juego" id="juego" value="<?php echo htmlspecialchars($row['juego'] ?? ''); ?>" required>
        <?php endif; ?>

        <button type="submit" class="btn-confirm">Guardar Cambios</button>
        <a href="<?php echo ucfirst($table); ?>.php" class="btn-cancel">Cancelar</a>
    </form>
</div>
</body>
</html>
