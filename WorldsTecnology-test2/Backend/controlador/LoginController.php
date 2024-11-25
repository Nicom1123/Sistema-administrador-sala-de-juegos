<?php
require_once __DIR__ . '/../modelos/Admin.php';
class LoginController {
    private $adminModel;

    public function __construct($mysqli) {
        $this->adminModel = new Admin($mysqli);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($this->adminModel->authenticate($username, $password)) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header('Location: Frontend/vistas/Consolas.php');
                exit();
            } else {
                $error = "Credenciales incorrectas.";
                include __DIR__ . '/../../Frontend/vistas/Login.php';
            }
        } else {
            include __DIR__ . '/../../Frontend/vistas/Login.php';
        }
    }

    public function createAccount() {
        include __DIR__ . '/../../Frontend/vistas/Crear_cuenta.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['identificacion'];
            $password = $_POST['password'];

            if ($this->adminModel->createAccount($username, $password)) {
                header('Location: index.php?action=login');
                exit();
            } else {
                $error = "Error al registrar la cuenta.";
                include __DIR__ . '/../../Frontend/vistas/Crear_cuenta.php';
            }
        }
    }

    public function forgotPassword() {
        include __DIR__ . '/../../Frontend/vistas/Olvidar_contrasena.php';
    }

    public function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['identificacion'];
            $password = $_POST['password'];
    
            if ($this->adminModel->resetPassword($username, $password)) {
                $success = "Contraseña actualizada con éxito.";
                include __DIR__ . '/../../Frontend/vistas/Olvidar_contrasena.php';
            } else {
                $error = "Error: La identificación no existe.";
                include __DIR__ . '/../../Frontend/vistas/Olvidar_contrasena.php';
            }
        }
    }
    
}
?>
