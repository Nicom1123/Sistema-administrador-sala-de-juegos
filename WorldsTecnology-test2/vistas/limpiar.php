<?php
require_once __DIR__ . '/../config/conex.php';

// Lista de tablas permitidas y sus controladores asociados
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
    require_once __DIR__ . "/../controlador/$controllerName.php";

    // Instanciar el controlador y ejecutar la función de limpieza
    $controller = new $controllerName($mysqli);
    if ($controller->limpiar($id)) {
        header("Location: Console.php");
        exit();
    } else {
        echo "Error: No se pudo limpiar el registro.";
    }
}
?>
