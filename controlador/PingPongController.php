<?php
require_once __DIR__ . '/../modelos/PingPong.php';

class PingPongController {
    private $model;

    public function __construct($mysqli) {
        $this->model = new PingPong($mysqli);
    }

    public function displayAll() {
        return $this->model->getAll();
    }
}

