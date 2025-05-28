<?php
class Main extends Controller
{
    protected $model;
    
    function __construct()
    {
        parent::__construct();
        $this->model = $this->loadModel('main');
        error_log('Main::construct->Inicio de main o vista principal');
    }
    
    function render()
    {
        error_log('Main::render->Index de main');
        $this->view->render('main/index');
    }
    
    function consultarCita()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_cita = $_POST['id_cita'] ?? null;
            
            if ($id_cita) {
                $cita = $this->model->getCitaById($id_cita);
                
                if ($cita) {
                    echo json_encode([
                        'success' => true,
                        'data' => $cita
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'No se encontró la cita con el ID especificado'
                    ]);
                }
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'ID de cita requerido'
                ]);
            }
        }
        exit;
    }
    
    function consultarCitasPaciente()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dni_paciente = $_POST['dni_paciente'] ?? null;
            
            if ($dni_paciente) {
                $citas = $this->model->getCitasByPacienteDni($dni_paciente);
                
                if (!empty($citas)) {
                    echo json_encode([
                        'success' => true,
                        'data' => $citas
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'No se encontraron citas para el documento especificado'
                    ]);
                }
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Documento del paciente requerido'
                ]);
            }
        }
        exit;
    }
}