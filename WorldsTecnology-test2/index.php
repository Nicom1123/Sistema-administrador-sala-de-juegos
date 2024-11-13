<?php
require_once __DIR__ . '/config/conex.php';
require_once __DIR__ . '/controlador/LoginController.php';

session_start();

$action = $_GET['action'] ?? 'login';
$loginController = new LoginController($mysqli);

if ($action === 'login') {
    $loginController->login();
} elseif ($action === 'logout') {
    $loginController->logout();
} else {
    // Aquí puedes redirigir a una página por defecto o mostrar un error
    header('Location: index.php?action=login');
}
