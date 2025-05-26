<?php

class Consultorio extends Controller
{

    protected $model;

    function __construct()
    {
        parent::__construct();
        $this->model = $this->loadModel('consultorio');

        error_log('Consultorio::construct -> módulo cargado');
    }

    function render()
    {
        $data = $this->model->getAll();
        $this->view->render('consultorio/index', $data);
    }

    function create()
    {
        $data = ['especialidades' => $this->model->getEspecialidades()];
        $this->view->render('consultorio/create', $data);
    }

    function store()
    {
        $data = [
            'nro_con'    => $_POST['nro_con'],
            'id_esp'     => $_POST['id_esp'],
            'ubicacion'  => $_POST['ubicacion']
        ];

        if ($this->model->create($data)) {
            header("Location: /consultorio");
        } else {
            echo "Error al registrar consultorio.";
        }
    }

    function edit($params)
    {
        $id = $params[0];
        $consultorio = $this->model->getById($id);
        $especialidades = $this->model->getEspecialidades();
        $this->view->render('consultorio/edit', [
            'consultorio' => $consultorio,
            'especialidades' => $especialidades
        ]);
    }

    function update()
    {
        $data = [
            'id_con'    => $_POST['id_con'],
            'nro_con'   => $_POST['nro_con'],
            'id_esp'    => $_POST['id_esp'],
            'ubicacion' => $_POST['ubicacion']
        ];

        $this->model->update($data);
        header("Location: /consultorio");
    }

    function delete($params)
    {
        $id = $params[0];
        $this->model->delete($id);
        header("Location: /consultorio");
    }
}
