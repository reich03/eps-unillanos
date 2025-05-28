<?php
class Usuario extends Controller
{
    protected $model;
    protected $auth;

    function __construct()
    {
        parent::__construct();
        $this->model = $this->loadModel('usuario');
        $this->auth = $this->loadController('auth');
        
        $this->auth->requireRole('administrador');
        
        error_log('Usuario::construct -> Módulo de Usuarios cargado');
    }

    function render()
    {
        $usuarios = $this->model->getAll();
        $this->view->render('usuario/index', $usuarios);
    }

    function create()
    {
        $this->view->render('usuario/create', []);
    }

    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /usuario/create");
            exit;
        }

        $data = [
            'nom_usuario' => $_POST['nom_usuario'] ?? '',
            'ape_usuario' => $_POST['ape_usuario'] ?? '',
            'email_usuario' => $_POST['email_usuario'] ?? '',
            'pass_usuario' => $_POST['pass_usuario'] ?? '',
            'rol_usuario' => $_POST['rol_usuario'] ?? 'recepcionista',
            'est_usuario' => $_POST['est_usuario'] ?? 'activo'
        ];

        $errors = $this->validateUserData($data);
        if (!empty($errors)) {
            $this->view->render('usuario/create', [
                'errors' => $errors,
                'data' => $data
            ]);
            return;
        }

        if ($this->model->emailExists($data['email_usuario'])) {
            $errors[] = "El email ya está registrado";
            $this->view->render('usuario/create', [
                'errors' => $errors,
                'data' => $data
            ]);
            return;
        }

        $data['pass_usuario'] = password_hash($data['pass_usuario'], PASSWORD_DEFAULT);

        if ($this->model->create($data)) {
            header("Location: /usuario?success=Usuario creado correctamente");
        } else {
            $errors[] = "Error al crear el usuario";
            $this->view->render('usuario/create', [
                'errors' => $errors,
                'data' => $data
            ]);
        }
    }

    function edit($params)
    {
        $id = $params[0] ?? null;
        if (!$id) {
            header("Location: /usuario");
            exit;
        }

        $usuario = $this->model->getById($id);
        if (!$usuario) {
            header("Location: /usuario?error=Usuario no encontrado");
            exit;
        }

        $this->view->render('usuario/edit', ['usuario' => $usuario]);
    }

    function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /usuario");
            exit;
        }

        $data = [
            'id_usuario' => $_POST['id_usuario'] ?? '',
            'nom_usuario' => $_POST['nom_usuario'] ?? '',
            'ape_usuario' => $_POST['ape_usuario'] ?? '',
            'email_usuario' => $_POST['email_usuario'] ?? '',
            'rol_usuario' => $_POST['rol_usuario'] ?? 'recepcionista',
            'est_usuario' => $_POST['est_usuario'] ?? 'activo'
        ];

        $errors = $this->validateUserData($data, true);
        if (!empty($errors)) {
            $usuario = $this->model->getById($data['id_usuario']);
            $this->view->render('usuario/edit', [
                'errors' => $errors,
                'usuario' => array_merge($usuario, $data)
            ]);
            return;
        }

        if ($this->model->emailExists($data['email_usuario'], $data['id_usuario'])) {
            $errors[] = "El email ya está registrado";
            $usuario = $this->model->getById($data['id_usuario']);
            $this->view->render('usuario/edit', [
                'errors' => $errors,
                'usuario' => array_merge($usuario, $data)
            ]);
            return;
        }

        if (!empty($_POST['pass_usuario'])) {
            $data['pass_usuario'] = password_hash($_POST['pass_usuario'], PASSWORD_DEFAULT);
        }

        if ($this->model->update($data)) {
            header("Location: /usuario?success=Usuario actualizado correctamente");
        } else {
            $errors[] = "Error al actualizar el usuario";
            $usuario = $this->model->getById($data['id_usuario']);
            $this->view->render('usuario/edit', [
                'errors' => $errors,
                'usuario' => array_merge($usuario, $data)
            ]);
        }
    }

    function delete($params)
    {
        $id = $params[0] ?? null;
        if (!$id) {
            header("Location: /usuario");
            exit;
        }

        if ($id == $_SESSION['user_id']) {
            header("Location: /usuario?error=No puedes eliminar tu propio usuario");
            exit;
        }

        if ($this->model->delete($id)) {
            header("Location: /usuario?success=Usuario eliminado correctamente");
        } else {
            header("Location: /usuario?error=Error al eliminar el usuario");
        }
    }

    private function validateUserData($data, $isUpdate = false)
    {
        $errors = [];

        if (empty($data['nom_usuario'])) {
            $errors[] = "El nombre es requerido";
        }

        if (empty($data['ape_usuario'])) {
            $errors[] = "El apellido es requerido";
        }

        if (empty($data['email_usuario'])) {
            $errors[] = "El email es requerido";
        } elseif (!filter_var($data['email_usuario'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "El email no es válido";
        }

        if (!$isUpdate && empty($data['pass_usuario'])) {
            $errors[] = "La contraseña es requerida";
        } elseif (!empty($data['pass_usuario']) && strlen($data['pass_usuario']) < 6) {
            $errors[] = "La contraseña debe tener al menos 6 caracteres";
        }

        if (!in_array($data['rol_usuario'], ['administrador', 'recepcionista', 'medico'])) {
            $errors[] = "El rol seleccionado no es válido";
        }

        if (!in_array($data['est_usuario'], ['activo', 'inactivo'])) {
            $errors[] = "El estado seleccionado no es válido";
        }

        return $errors;
    }
}