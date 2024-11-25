<?php
    session_start();

require_once __DIR__ . '/../../Backend/controlador/PingPongController.php';
$pingPongController = new PingPongController($mysqli);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/WorldsTecnology-test2/Frontend/style/main.css">
    <title>Ping Pong</title>
</head>

<body>
<?php
include __DIR__ . '/../components/side-bar.php';
  ?>
  <div class="container">
    <div class="container-info">
      <div class="container-info-page-title">
        <h1>Pingpong</h1>
      </div>
      <div class="container-info-time">
        <script src="js/hour.js" defer></script>
        <h1 id="page-hour">
        </h1>
      </div>
    </div>
    <div class="container-table">
      <?php
include __DIR__ . '/../components/pingpong-table.php';
?>
    </div>
  </div>
</body>

</html>
