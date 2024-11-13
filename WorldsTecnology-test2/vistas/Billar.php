<?php
require_once __DIR__ . '/../controlador/BillarController.php';
session_start();

// Verificar sesión
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php?action=login');
    exit();
}

$billarController = new BillarController($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/WorldsTecnology/style/main.css">
    <script src="scripts.js"></script>

    <title>Billar</title>
</head>
<body>
<?php include __DIR__ . '/../components/side-bar.php';
 ?>
<div class="container">
    <h1>Billar</h1>
    <div class="container-table">
        <?php include '../components/billar-table.php'; ?>
    </div>
</div>
</body>
</html>
