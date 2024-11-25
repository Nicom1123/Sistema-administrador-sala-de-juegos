<?php
require_once __DIR__ . '/../../Backend/config/conex.php';

// Lista de tablas permitidas con los nombres exactos de sus controladores
$allowedControllers = [
    'consolas' => 'ConsoleController',
    'pingpong' => 'PingPongController',
    'aerohockey' => 'AerohockeyController',
    'billar' => 'BillarController',
    'futbolito' => 'FutbolitoController'
];

// Verificar que los parámetros estén presentes
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_GET['table'])) {
    $id = $_GET['id'];
    $tableKey = strtolower($_GET['table']); // Convertir el parámetro `table` a minúsculas

    // Validar que exista un controlador para la tabla especificada
    if (!array_key_exists($tableKey, $allowedControllers)) {
        echo "Error: Tabla no válida.";
        exit();
    }

    // Cargar el controlador correspondiente
    $controllerName = $allowedControllers[$tableKey];
    require_once __DIR__ . "/../../Backend/controlador/$controllerName.php";

    // Instanciar el controlador y ejecutar la función de desbloqueo
    $controller = new $controllerName($mysqli);
    if ($controller->desbloquear($id)) {
        header("Location: " . ucfirst($tableKey) . ".php");
        exit();
    } else {
        echo "Error: No se pudo desbloquear el registro.";
    }
} else {
    echo "Error: Parámetros faltantes.";
}
