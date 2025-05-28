<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_log("Session started, session id: " . session_id());
error_log("Current _SESSION content: " . print_r($_SESSION, true));

require_once 'controllers/auth.php';
$auth = new Auth();
$isLoggedIn = $auth->isLoggedIn();
$userRole = $_SESSION['user_role'] ?? '';
$userName = $_SESSION['user_name'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>EPS Unillanos - Sistema de Gestión Médica</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'eps-blue': {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a'
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 text-gray-900 min-h-screen flex flex-col">
    <header class="bg-gradient-to-r from-eps-blue-800 via-eps-blue-700 to-eps-blue-800 text-white shadow-xl relative overflow-visible">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="absolute top-0 left-0 w-full h-full">
            
        </div>

        <div class="container mx-auto px-6 py-4 relative z-10">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                   
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight">EPS Unillanos</h1>
                        <p class="text-eps-blue-100 text-sm font-medium">Sistema de Gestión Médica</p>
                    </div>
                </div>

                <?php if ($isLoggedIn): ?>
                    <nav class="hidden md:flex space-x-1">
                        <a href="/" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                            <span class="font-medium">Inicio</span>
                        </a>

                        <?php if ($userRole === 'administrador'): ?>
                            <a href="/admin" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                                <span class="font-medium">Dashboard</span>
                            </a>
                            <a href="/usuario" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                                <span class="font-medium">Usuarios</span>
                            </a>
                        <?php endif; ?>

                        <?php if (in_array($userRole, ['administrador', 'recepcionista'])): ?>
                            <a href="/cita" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                                <span class="font-medium">Citas</span>
                            </a>
                            <a href="/paciente" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                                <span class="font-medium">Pacientes</span>
                            </a>
                        <?php endif; ?>

                        <?php if (in_array($userRole, ['administrador', 'medico'])): ?>
                            <a href="/horario" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                                <span class="font-medium">Horarios</span>
                            </a>
                        <?php endif; ?>

                        <?php if ($userRole === 'administrador'): ?>
                            <a href="/medico" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                                <span class="font-medium">Médicos</span>
                            </a>
                            <a href="/consultorio" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                                <span class="font-medium">Consultorios</span>
                            </a>
                            <a href="/servicio" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                                <span class="font-medium">Servicios</span>
                            </a>
                        <?php endif; ?>
                    </nav>

                    <div class="flex items-center space-x-4">
                        <div class="hidden md:block text-right">
                            <p class="text-sm font-medium"><?= htmlspecialchars($userName) ?></p>
                            <p class="text-xs text-eps-blue-200 capitalize"><?= htmlspecialchars($userRole) ?></p>
                        </div>
                        <!-- <div class="relative group">
                            <button class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-opacity-30 transition-all duration-200">
                                <span class="text-lg">👤</span>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50"
                                style="transform: translate(10px, 10px);">
                                <div class="py-2">
                                    <div class="px-4 py-2 border-b border-gray-200">
                                        <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($userName) ?></p>
                                        <p class="text-xs text-gray-500 capitalize"><?= htmlspecialchars($userRole) ?></p>
                                    </div>
                                    <a href="/perfil" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <span class="mr-2">⚙️</span>
                                        Mi Perfil
                                    </a>
                                    <a href="/auth/logout" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <span class="mr-2">🚪</span>
                                        Cerrar Sesión
                                    </a>
                                </div>
                            </div>

                        </div> -->
                        <div class="relative">
                            <button id="profile-button" class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-opacity-30 transition-all duration-200">
                                <span class="text-lg">👤</span>
                            </button>

                            <div id="profile-menu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden z-50" style="transform: translate(10px, 10px);">
                                <div class="py-2">
                                    <div class="px-4 py-2 border-b border-gray-200">
                                        <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($userName) ?></p>
                                        <p class="text-xs text-gray-500 capitalize"><?= htmlspecialchars($userRole) ?></p>
                                    </div>
                                    <a href="/perfil" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <span class="mr-2">⚙️</span>
                                        Mi Perfil
                                    </a>
                                    <a href="/auth/logout" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <span class="mr-2">🚪</span>
                                        Cerrar Sesión
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php else: ?>
                    <div class="flex items-center space-x-4">
                        <a href="/auth" class="inline-flex items-center px-6 py-2 bg-white bg-opacity-20 text-white font-medium rounded-lg hover:bg-opacity-30 transition-all duration-200 backdrop-blur-sm">
                            Iniciar Sesión
                        </a>
                    </div>
                <?php endif; ?>

                <div class="md:hidden">
                    <button id="mobile-menu-button" class="p-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <?php if ($isLoggedIn): ?>
                <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
                    <div class="space-y-2">
                        <a href="/" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                            <span class="font-medium">Inicio</span>
                        </a>

                        <?php if ($userRole === 'administrador'): ?>
                            <a href="/admin" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                                <span class="font-medium">Dashboard</span>
                            </a>
                            <a href="/usuario" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                                <span class="font-medium">Usuarios</span>
                            </a>
                        <?php endif; ?>

                        <?php if (in_array($userRole, ['administrador', 'recepcionista'])): ?>
                            <a href="/cita" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                                <span class="font-medium">Citas</span>
                            </a>
                            <a href="/paciente" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                                <span class="font-medium">Pacientes</span>
                            </a>
                        <?php endif; ?>

                        <?php if (in_array($userRole, ['administrador', 'medico'])): ?>
                            <a href="/horario" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                                <span class="font-medium">Horarios</span>
                            </a>
                        <?php endif; ?>

                        <?php if ($userRole === 'administrador'): ?>
                            <a href="/medico" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                                <span class="font-medium">Médicos</span>
                            </a>
                            <a href="/consultorio" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                                <span class="font-medium">Consultorios</span>
                            </a>
                            <a href="/servicio" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                                <span class="font-medium">Servicios</span>
                            </a>
                        <?php endif; ?>

                        <hr class="border-white border-opacity-20 my-2">
                        <a href="/auth/logout" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-red-500 hover:bg-opacity-20 transition-all duration-200 text-red-200">
                            <span class="text-lg">🚪</span>
                            <span class="font-medium">Cerrar Sesión</span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </header>
    <main class="flex-grow container mx-auto px-6 py-8">

        <script>
            document.getElementById('mobile-menu-button').addEventListener('click', function() {
                const menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
            });
        </script>

        <script>
            const profileButton = document.getElementById('profile-button');
            const profileMenu = document.getElementById('profile-menu');

            profileButton.addEventListener('click', (e) => {
                e.stopPropagation();
                profileMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', (e) => {
                if (!profileMenu.classList.contains('hidden')) {
                    profileMenu.classList.add('hidden');
                }
            });

            profileMenu.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        </script>