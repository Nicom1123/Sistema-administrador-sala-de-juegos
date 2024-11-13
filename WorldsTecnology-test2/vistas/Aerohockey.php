<?php
require_once __DIR__ . '/../controlador/AerohockeyController.php';
session_start();

// Verificar sesión
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php?action=login');
    exit();
}

$aerohockeyController = new AerohockeyController($mysqli);
$aerohockeyData = $aerohockeyController->displayAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/WorldsTecnology/style/main.css">
    <title>Aerohockey</title>
</head>
<body>
<?php include __DIR__ . '/../components/side-bar.php';
?>
<div class="container">
    <h1>Aerohockey</h1>
    <div class="container-table">
        <?php include __DIR__ . '/../components/aerohockey-table.php';
; ?>
    </div>
</div>
</body>
</html>
