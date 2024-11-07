<?php include 'components/side-bar.php'; ?>
<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php?action=login');
    exit();
}
?>

<div class="container">
    <div class="container-info">
        <h1>Consolas</h1>
    </div>
    <div class="container-table">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Estudiante</th>
                    <th>Juego</th>
                    <th>Tiempo Restante</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $consolas->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['estudiante'] ?></td>
                        <td><?= $row['juego'] ?></td>
                        <td><?= $row['tiempo_restante'] ?></td>
                        <td><?php include 'components/buttons.php'; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
