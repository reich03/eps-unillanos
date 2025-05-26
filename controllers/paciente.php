<?php

class Paciente extends Controller
{

    protected $model;

    function __construct()
    {
        parent::__construct();
        $this->model = $this->loadModel('paciente');
        error_log('Paciente::construct -> módulo cargado');
    }

    function render()
    {
        $pacientes = $this->model->getAll();
        $this->view->render('paciente/index', $pacientes);
    }

    function create()
    {
        $this->view->render('paciente/create');
    }

    function store()
    {
        $data = [
            'nom_pac' => $_POST['nom_pac'],
            'ape_pac' => $_POST['ape_pac'],
            'dni_pac' => $_POST['dni_pac'],
            'fec_pac' => $_POST['fec_pac'],
            'est_pac' => $_POST['est_pac'] ?? 'activo'
        ];

        if ($this->model->create($data)) {
            header('Location: /paciente');
        } else {
            echo "Error al crear paciente";
        }
    }

    function edit($params)
    {
        $id = $params[0];
        $paciente = $this->model->getById($id);
        $this->view->render('paciente/edit', ['paciente' => $paciente]);
    }

    function update()
    {
        $data = [
            'id_pac' => $_POST['id_pac'],
            'nom_pac' => $_POST['nom_pac'],
            'ape_pac' => $_POST['ape_pac'],
            'dni_pac' => $_POST['dni_pac'],
            'fec_pac' => $_POST['fec_pac'],
            'est_pac' => $_POST['est_pac']
        ];

        if ($this->model->update($data)) {
            header('Location: /paciente');
        } else {
            echo "Error al actualizar paciente";
        }
    }

    function delete($params)
    {
        $id = $params[0];
        if ($this->model->delete($id)) {
            header('Location: /paciente');
        } else {
            echo "Error al eliminar paciente";
        }
    }
}
