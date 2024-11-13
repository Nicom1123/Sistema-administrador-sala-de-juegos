<?php
require_once __DIR__ . '/../modelos/Admin.php';

class LoginController {
    private $adminModel;

    public function __construct($mysqli) {
        $this->adminModel = new Admin($mysqli);
    }

    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            if ($this->adminModel->authenticate($username, $password)) {
                // Autenticación exitosa
                $_SESSION['loggedin'] = true;
                header('Location: vistas/Console.php');
                exit();
            } else {
                // Autenticación fallida
                $error = "Credenciales incorrectas. Inténtalo de nuevo.";
                include __DIR__ . '/../vistas/login.php';
            }
        } else {
            // Mostrar el formulario de inicio de sesión si no es una solicitud POST
            include __DIR__ . '/../vistas/login.php';
        }
    }
    

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
