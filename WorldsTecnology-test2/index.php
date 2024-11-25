<?php
require_once __DIR__ . '/Backend/config/conex.php';
require_once __DIR__ . '/Backend/controlador/LoginController.php';
require_once __DIR__ . '/Backend/controlador/ConsoleController.php';

// Instanciar controladores
$loginController = new LoginController($mysqli);
$consoleController = new ConsoleController($mysqli);

// Obtener la acción desde la URL (por defecto: 'login')
$action = $_GET['action'] ?? 'login';

// Unificar todas las acciones en un solo switch
switch ($action) {
    // Acciones de Login
    case 'login':
        $loginController->login();
        break;
    case 'createAccount':
        $loginController->createAccount();
        break;
    case 'register':
        $loginController->register();
        break;
    case 'forgotPassword':
        $loginController->forgotPassword();
        break;
    case 'resetPassword':
        $loginController->resetPassword();
        break;

    // Acciones de Console
    case 'editarConsole':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Validar que sea una solicitud POST
            $id = $_POST['id'] ?? null;
            $estudiante = $_POST['estudiante'] ?? null;
            $hora_finalizacion = $_POST['hora_finalizacion'] ?? null;
    
            if ($id && $estudiante && $hora_finalizacion) {
                if ($consoleController->editar($id, $estudiante, $hora_finalizacion)) {
                    echo "Edición e inserción exitosas.";
                } else {
                    echo "Error al editar o insertar.";
                }
            } else {
                echo "Datos insuficientes para realizar la operación.";
            }
        } else {
            echo "Método no permitido.";
        }
        break;
    
    
    case 'verConsolas':
        $consolas = $consoleController->index();
        include __DIR__ . '/vistas/console-table.php';
        break;
    

    // Acción predeterminada
    default:
        $loginController->login();
        break;
}
