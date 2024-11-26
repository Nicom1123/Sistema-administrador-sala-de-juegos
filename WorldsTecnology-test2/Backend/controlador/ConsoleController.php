<?php
require_once __DIR__ . '/../modelos/Console.php';

class ConsoleController {
    private $model;

    public function __construct($mysqli) {
        $this->model = new Console($mysqli);
    }

    // Método para obtener todas las consolas
    public function index() {
        return $this->model->getAll();
    }

    public function getById($id) {
        return $this->model->getById($id);
    }
    public function limpiar($id) {
        return $this->model->limpiarRegistro($id);
    }
    public function bloquear($id) {
        return $this->model->bloquearRegistro($id);
    }
    
    public function desbloquear($id) {
        return $this->model->desbloquearRegistro($id);
    }
    public function displayAll() {
        $disponibles = $this->model->countByStatus('disponible');
        $bloqueadas = $this->model->countByStatus('bloqueada');

        include __DIR__ . '/../vistas/console-table.php';
    }
    public function editar($id, $estudiante, $hora_finalizacion) {
        return $this->model->editarRegistro($id, $estudiante, $hora_finalizacion);

    }

}


