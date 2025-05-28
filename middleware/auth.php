<?php
/**
 * Middleware de Autenticación
 * Maneja la autenticación y autorización de rutas
 */
class AuthMiddleware
{
    private $auth;
    
    public function __construct()
    {
        // Iniciar sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Verificar autenticación antes de acceder a rutas protegidas
     */
    public function handle($route, $controller, $method)
    {
        // Inicializar controlador de autenticación
        require_once 'controllers/auth.php';
        $this->auth = new Auth();

        // Rutas públicas que no requieren autenticación
        $publicRoutes = [
            'auth' => ['render', 'login'],
            'home' => ['render'] // Solo la página principal pública
        ];

        // Rutas que requieren autenticación
        $protectedRoutes = [
            'admin' => ['administrador'],
            'usuario' => ['administrador'],
            'cita' => ['administrador', 'recepcionista'],
            'paciente' => ['administrador', 'recepcionista'],
            'medico' => ['administrador'],
            'consultorio' => ['administrador'],
            'servicio' => ['administrador'],
            'horario' => ['administrador', 'medico']
        ];

        // Si es una ruta pública, permitir acceso
        if (isset($publicRoutes[$controller]) && 
            in_array($method, $publicRoutes[$controller])) {
            return true;
        }

        // Verificar si está logueado
        if (!$this->auth->isLoggedIn()) {
            $this->redirectToLogin();
            return false;
        }

        // Si es una ruta protegida, verificar permisos
        if (isset($protectedRoutes[$controller])) {
            $requiredRoles = $protectedRoutes[$controller];
            $userRole = $_SESSION['user_role'] ?? '';
            
            // Administrador tiene acceso a todo
            if ($userRole === 'administrador') {
                return true;
            }
            
            // Verificar si el rol del usuario está permitido
            if (!in_array($userRole, $requiredRoles)) {
                $this->redirectUnauthorized();
                return false;
            }
        }

        return true;
    }

    /**
     * Redirigir a login
     */
    private function redirectToLogin()
    {
        header("Location: /auth");
        exit;
    }

    /**
     * Redirigir a página de no autorizado
     */
    private function redirectUnauthorized()
    {
        header("Location: /auth/unauthorized");
        exit;
    }

    /**
     * Verificar si el usuario tiene un rol específico
     */
    public static function hasRole($role)
    {
        if (!isset($_SESSION['user_role'])) {
            return false;
        }

        $userRole = $_SESSION['user_role'];
        
        // Administrador tiene todos los permisos
        if ($userRole === 'administrador') {
            return true;
        }

        return $userRole === $role;
    }

    /**
     * Verificar si el usuario puede acceder a un módulo
     */
    public static function canAccess($module)
    {
        $permissions = [
            'dashboard' => ['administrador'],
            'usuarios' => ['administrador'],
            'citas' => ['administrador', 'recepcionista'],
            'pacientes' => ['administrador', 'recepcionista'],
            'medicos' => ['administrador'],
            'consultorios' => ['administrador'],
            'servicios' => ['administrador'],
            'horarios' => ['administrador', 'medico']
        ];

        if (!isset($permissions[$module])) {
            return false;
        }

        $userRole = $_SESSION['user_role'] ?? '';
        
        // Administrador tiene acceso a todo
        if ($userRole === 'administrador') {
            return true;
        }

        return in_array($userRole, $permissions[$module]);
    }

    /**
     * Limpiar sesiones expiradas (llamar periódicamente)
     */
    public function cleanupSessions()
    {
        if ($this->auth) {
            $this->auth->model->cleanExpiredSessions();
        }
    }
}