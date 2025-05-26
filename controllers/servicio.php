<?php

class Servicio extends Controller
{
    protected $model;

    function __construct()
    {
        parent::__construct();
        $this->model = $this->loadModel('servicio');

        error_log('Servicio::construct -> módulo cargado');
    }

    function render()
    {
        $servicios = $this->model->getAll();
        $this->view->render('servicio/index', $servicios);
    }

    function create()
    {
        $this->view->render('servicio/create');
    }

    function store()
    {
        $data = [
            'desc_serv'  => $_POST['desc_serv'],
            'costo_serv' => $_POST['costo_serv'],
            'est_serv'   => 'activo'
        ];

        if ($this->model->create($data)) {
            header("Location: /servicio");
        } else {
            echo "Error al crear servicio.";
        }
    }

    function edit($params)
    {
        $id = $params[0];
        $servicio = $this->model->getById($id);
        $this->view->render('servicio/edit', ['servicio' => $servicio]);
    }

    function update()
    {
        $data = [
            'id_serv'    => $_POST['id_serv'],
            'desc_serv'  => $_POST['desc_serv'],
            'costo_serv' => $_POST['costo_serv'],
            'est_serv'   => $_POST['est_serv']
        ];

        $this->model->update($data);
        header("Location: /servicio");
    }

    function delete($params)
    {
        $id = $params[0];
        $this->model->delete($id);
        header("Location: /servicio");
    }
}
