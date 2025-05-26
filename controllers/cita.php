<?php

class Cita extends Controller
{

    protected $model;

    function __construct()
    {
        parent::__construct();
        $this->model = $this->loadModel('cita');

        error_log('Cita::construct -> Módulo de Citas cargado');
    }

    function render()
    {
        $citas = $this->model->getAllWithDetails();
        $this->view->render('cita/index', $citas);
    }

    function create()
    {
        $data = [
            'pacientes'     => $this->model->getPacientes(),
            'horarios'      => $this->model->getHorarios(),
            'consultorios'  => $this->model->getConsultorios(),
            'servicios'     => $this->model->getServicios()
        ];

        $this->view->render('cita/create', $data);
    }


    function store()
    {
        $data = [
            'id_pac'     => $_POST['id_pac'],
            'id_horario' => $_POST['id_horario'],
            'id_con'     => $_POST['id_con'],
            'id_serv'    => $_POST['id_serv'],
            'est_cita'   => 'pendiente'
        ];

        if ($this->model->create($data)) {
            header("Location: /cita");
        } else {
            echo "Error al registrar la cita.";
        }
    }

    function edit($params)
    {
        $id = $params[0];
        $cita = $this->model->getById($id);

        $data = [
            'cita'         => $cita,
            'pacientes'    => $this->model->getPacientes(),
            'horarios'     => $this->model->getHorarios(),
            'consultorios' => $this->model->getConsultorios(),
            'servicios'    => $this->model->getServicios()
        ];

        $this->view->render('cita/edit', $data);
    }

    function update()
    {
        $data = [
            'id_cita'    => $_POST['id_cita'],
            'id_pac'     => $_POST['id_pac'],
            'id_horario' => $_POST['id_horario'],
            'id_con'     => $_POST['id_con'],
            'id_serv'    => $_POST['id_serv'],
            'est_cita'   => $_POST['est_cita']
        ];

        $this->model->update($data);
        header("Location: /cita");
    }

    function delete($params)
    {
        $id = $params[0];
        $this->model->delete($id);
        header("Location: /cita");
    }
}
