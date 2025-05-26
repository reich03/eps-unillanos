<?php

class Horario extends Controller
{

    protected $model;

    function __construct()
    {
        parent::__construct();
        $this->model = $this->loadModel('horario');

        error_log('Horario::construct -> módulo cargado');
    }

    function render()
    {
        $horarios = $this->model->getAll();
        $this->view->render('horario/index', $horarios);
    }

    function create()
    {
        $medicos = $this->model->getMedicos();
        $this->view->render('horario/create', ['medicos' => $medicos]);
    }

    function store()
    {
        $data = [
            'id_med'       => $_POST['id_med'],
            'fecha'        => $_POST['fecha'],
            'hora'         => $_POST['hora'],
            'est_horario'  => 'disponible'
        ];

        if ($this->model->create($data)) {
            header("Location: /horario");
        } else {
            echo "Error al crear horario.";
        }
    }

    function edit($params)
    {
        $id = $params[0];
        $horario = $this->model->getById($id);
        $medicos = $this->model->getMedicos();
        $this->view->render('horario/edit', ['horario' => $horario, 'medicos' => $medicos]);
    }

    function update()
    {
        $data = [
            'id_horario'   => $_POST['id_horario'],
            'id_med'       => $_POST['id_med'],
            'fecha'        => $_POST['fecha'],
            'hora'         => $_POST['hora'],
            'est_horario'  => $_POST['est_horario']
        ];

        $this->model->update($data);
        header("Location: /horario");
    }

    function delete($params)
    {
        $id = $params[0];
        $this->model->delete($id);
        header("Location: /horario");
    }
}
