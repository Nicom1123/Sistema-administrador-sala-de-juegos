<?php
require_once __DIR__ . '/../config/conex.php';

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
    $sql = "SELECT estudiante, hora_finalizacion FROM $table WHERE id = ?";
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="/WorldsTecnology-test2/style/main.css">
</head>
<body>
    <h2>Editar Registro de <?php echo ucfirst($table); ?></h2>
    <form action="editar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <input type="hidden" name="table" value="<?php echo htmlspecialchars($table); ?>">

        <label for="estudiante">Estudiante:</label>
        <input type="text" name="estudiante" id="estudiante" value="<?php echo htmlspecialchars($row['estudiante']); ?>" required>
        <br>

        <label for="hora_finalizacion">Hora de Finalización:</label>
        <input type="time" name="hora_finalizacion" id="hora_finalizacion" value="<?php echo htmlspecialchars($row['hora_finalizacion']); ?>" required>
        <br>

        <button type="submit">Guardar Cambios</button>
        <a href="Console.php">Cancelar</a>
    </form>
</body>
</html>

<?php
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
    $sql = "UPDATE $table SET estudiante = ?, hora_finalizacion = ? WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssi", $estudiante, $hora_finalizacion, $id);
    $stmt->execute();

    header("Location: Console.php");
    exit();
}
?>
