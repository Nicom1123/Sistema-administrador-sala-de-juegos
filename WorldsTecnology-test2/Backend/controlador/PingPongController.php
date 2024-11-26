<?php
require_once __DIR__ . '/../modelos/PingPong.php';

class PingPongController {
    private $model;

    public function __construct($mysqli) {
        $this->model = new PingPong($mysqli);
    }

    public function editar($id, $estudiante, $hora_finalizacion) {
        return $this->model->editarRegistro($id, $estudiante, $hora_finalizacion);
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
    public function displaystatus() {
        $disponibles = $this->model->countByStatus('activo');
        $bloqueadas = $this->model->countByStatus('inactivo');

        include __DIR__ . '/../vistas/PingPong-table.php';
    }
}

?>

