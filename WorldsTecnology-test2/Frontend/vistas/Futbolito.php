<?php
require_once __DIR__ . '/../../Backend/controlador/FutbolitoController.php';
session_start();

// Verificar sesión
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php?action=login');
    exit();
}

$futbolitoController = new FutbolitoController($mysqli);
$futbolitoData = $futbolitoController->displayAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/WorldsTecnology-test2/Frontend/style/main.css">
    <title>Futbolito</title>
</head>
<body>
<?php include '../components/side-bar.php'; ?>
    <div class="container">
        <div class="container-info">
            <div class="container-info-page-title">
                <h1>Futbolito</h1>
            </div>
        </div>
       
        <!-- Tabla -->
        <div class="container-table">
            <?php include '../components/futbolito-table.php'; ?>
        </div>
    </div>
</body>
</html>

