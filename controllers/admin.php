<?php
session_start();

class Admin extends Controller
{

    protected $model;

    function __construct()
    {
        parent::__construct();
        $this->model = $this->loadModel('admin');

        error_log('Admin::construct -> Dashboard cargado');
    }

    function render()
    {
        $data = $this->model->getDashboardStats();
        $this->view->render('admin/index', $data);
    }
}
