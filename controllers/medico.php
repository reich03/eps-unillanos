<?php

class Medico extends Controller
{

    protected $model;

    function __construct()
    {
        parent::__construct();
        $this->model = $this->loadModel('medico');

        error_log('Medico::construct -> módulo cargado');
    }

    function render()
    {
        $medicos = $this->model->getAll();
        $this->view->render('medico/index', $medicos);
    }

    function create()
    {
        $especialidades = $this->model->getEspecialidades();
        $this->view->render('medico/create', ['especialidades' => $especialidades]);
    }

    function store()
    {
        $data = [
            'nom_med'       => $_POST['nom_med'],
            'id_esp'        => $_POST['id_esp'],
            'contacto_med'  => $_POST['contacto_med'],
            'est_med'       => 'activo'
        ];

        if ($this->model->create($data)) {
            header("Location: /medico");
        } else {
            echo "Error al crear médico.";
        }
    }

    function edit($params)
    {
        $id = $params[0];
        $medico = $this->model->getById($id);
        $especialidades = $this->model->getEspecialidades();
        $this->view->render('medico/edit', ['medico' => $medico, 'especialidades' => $especialidades]);
    }

    function update()
    {
        $data = [
            'id_med'       => $_POST['id_med'],
            'nom_med'      => $_POST['nom_med'],
            'id_esp'       => $_POST['id_esp'],
            'contacto_med' => $_POST['contacto_med'],
            'est_med'      => $_POST['est_med']
        ];

        $this->model->update($data);
        header("Location: /medico");
    }

    function delete($params)
    {
        $id = $params[0];
        $this->model->delete($id);
        header("Location: /medico");
    }
}
