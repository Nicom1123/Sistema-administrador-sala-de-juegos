<?php
require_once __DIR__ . '/controlador/PingPongController.php';
$pingPongController = new PingPongController($mysqli);
$pingPongData = $pingPongController->displayAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Ping Pong</title>
</head>

<body>
    <?php include 'components/side-bar.php'; ?>
    <div class="container">
        <div class="container-info">
            <h1>Ping Pong</h1>
        </div>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Estudiante</th>
                        <th>Tiempo Restante</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pingPongData as $row) : ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['estudiante']; ?></td>
                            <td><?= $row['tiempo_restante']; ?></td>
                            <td><?php include 'components/buttons.php'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
