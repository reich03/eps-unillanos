<?php
session_start();

class Auth extends Controller
{
    protected $model;

    function __construct()
    {
        parent::__construct();
        $this->model = $this->loadModel('auth');
        error_log('Auth::construct -> Módulo de Autenticación cargado');
    }

    function render()
    {
        error_log('Auth::render -> Verificando si usuario está logueado');
        if ($this->isLoggedIn()) {
            error_log('Auth::render -> Usuario ya logueado, redirigiendo a /admin');
            header("Location: /admin");
            exit;
        }
        error_log('Auth::render -> Mostrando vista login');
        $this->view->render('auth/login', []);
    }

    function login()
    {
        error_log('Auth::login -> Inicio del proceso de login');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            error_log('Auth::login -> Método HTTP no permitido: ' . $_SERVER['REQUEST_METHOD']);
            header("Location: /auth");
            exit;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        error_log("Auth::login -> Datos recibidos - email: $email, password: " . ($password !== '' ? '[oculto]' : '[vacío]'));

        if (empty($email) || empty($password)) {
            $error = "Email y contraseña son requeridos";
            error_log("Auth::login -> Error: $error");
            $this->view->render('auth/login', ['error' => $error]);
            return;
        }

        $user = $this->model->getUserByEmail($email);
        error_log('Auth::login -> Usuario obtenido: ' . print_r($user, true));

        if (!$user) {
            error_log("Auth::login -> No se encontró usuario con email $email");
            $error = "Credenciales incorrectas";
            $this->view->render('auth/login', ['error' => $error, 'email' => $email]);
            return;
        }

        if (!password_verify($password, $user['pass_usuario'])) {
            error_log("Auth::login -> password_verify falló para email $email");
            $error = "Credenciales incorrectas";
            $this->view->render('auth/login', ['error' => $error, 'email' => $email]);
            return;
        }

        if ($user['est_usuario'] === 'inactivo') {
            $error = "Tu cuenta está inactiva. Contacta al administrador.";
            error_log("Auth::login -> Usuario $email está inactivo");
            $this->view->render('auth/login', ['error' => $error, 'email' => $email]);
            return;
        }

        $this->createSession($user);

        error_log("Auth::login -> Sesión creada para usuario {$user['email_usuario']}");

        $this->redirectByRole($user['rol_usuario']);
    }

    function logout()
    {
        error_log('Auth::logout -> Cerrando sesión');
        if (isset($_SESSION['token_sesion'])) {
            error_log('Auth::logout -> Destruyendo sesión en BD para token: ' . $_SESSION['token_sesion']);
            $this->model->destroySession($_SESSION['token_sesion']);
        }

        session_destroy();
        header("Location: /");
        exit;
    }

    function isLoggedIn()
    {
        error_log('Auth::isLoggedIn -> Comprobando sesión');
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['token_sesion'])) {
            error_log('Auth::isLoggedIn -> No hay datos de sesión en $_SESSION');
            return false;
        }

        $valid = $this->model->validateSession($_SESSION['token_sesion'], $_SESSION['user_id']);
        error_log('Auth::isLoggedIn -> Resultado de validateSession: ' . ($valid ? 'válida' : 'inválida'));
        return $valid;
    }

    function hasRole($requiredRole)
    {
        if (!$this->isLoggedIn()) {
            error_log('Auth::hasRole -> Usuario no logueado');
            return false;
        }

        $userRole = $_SESSION['user_role'] ?? '';
        error_log("Auth::hasRole -> Rol usuario: $userRole, Rol requerido: $requiredRole");

        if ($userRole === 'administrador') {
            return true;
        }

        return $userRole === $requiredRole;
    }

    function requireAuth()
    {
        if (!$this->isLoggedIn()) {
            error_log('Auth::requireAuth -> Usuario no autenticado, redirigiendo a /auth');
            header("Location: /auth");
            exit;
        }
    }

    function requireRole($role)
    {
        $this->requireAuth();

        if (!$this->hasRole($role)) {
            error_log('Auth::requireRole -> Usuario no autorizado para rol ' . $role);
            header("Location: /unauthorized");
            exit;
        }
    }

    private function createSession($user)
    {
        $token = bin2hex(random_bytes(32));
        $expiration = date('Y-m-d H:i:s', strtotime('+24 hours'));

        $sessionData = [
            'id_usuario' => $user['id_usuario'],
            'token_sesion' => $token,
            'fecha_expiracion' => $expiration,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
        ];
        error_log('Auth::login -> sesion informacion: ' . print_r($sessionData, true));

        error_log('Auth::createSession -> Creando sesión en BD con token ' . $token);
        $created = $this->model->createSession($sessionData);
        error_log('Condicional ' . ($created ? 'true' : 'false'));
        if ($created) {
            $_SESSION['user_id'] = $user['id_usuario'];
            $_SESSION['user_name'] = $user['nom_usuario'] . ' ' . $user['ape_usuario'];
            $_SESSION['user_email'] = $user['email_usuario'];
            $_SESSION['user_role'] = $user['rol_usuario'];
            $_SESSION['token_sesion'] = $token;
            error_log('Auth::createSession -> Sesión creada en $_SESSION para usuario ' . $_SESSION['user_email']);
            error_log('Auth::createSession -> Sesion guardada como ' . print_r($_SESSION, true));
        } else {
            error_log('Auth::createSession -> Error al crear sesión en BD');
        }
    }

    private function redirectByRole($role)
    {
        error_log("Auth::redirectByRole -> Redirigiendo según rol: $role");
        switch ($role) {
            case 'administrador':
                header("Location: /admin");
                break;
            case 'recepcionista':
                header("Location: /cita");
                break;
            case 'medico':
                header("Location: /horario");
                break;
            default:
                header("Location: /");
        }
        exit;
    }

    function unauthorized()
    {
        http_response_code(403);
        $this->view->render('auth/unauthorized', []);
    }
}
