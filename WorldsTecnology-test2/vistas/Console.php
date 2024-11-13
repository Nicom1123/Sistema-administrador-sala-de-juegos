<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php?action=login');
    exit();
}

require_once __DIR__ . '/../config/conex.php';
require_once __DIR__ . '/../controlador/ConsoleController.php';

$consoleController = new ConsoleController($mysqli);
$consolas = $consoleController->index(); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/WorldsTecnology-test2/style/main.css">
    <script src="scripts.js"></script>
    <title>Consolas</title>
</head>
<body>
    <?php include '../components/side-bar.php'; ?>
    <div class="container">
        <div class="container-info">
            <div class="container-info-page-title">
                <h1>Consolas</h1>
            </div>
            <div class="container-info-time">
                <script src="js/hour.js" defer></script>
                <h1 id="page-hour"></h1>
            </div>
        </div>
        <div class="container-table">
            <?php include '../components/console-table.php'; ?>
        </div>
    </div>

</body>
</html>

