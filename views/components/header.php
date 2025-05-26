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
    <header class="bg-gradient-to-r from-eps-blue-800 via-eps-blue-700 to-eps-blue-800 text-white shadow-xl relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-4 left-10 w-20 h-20 bg-white opacity-5 rounded-full"></div>
            <div class="absolute top-12 right-20 w-16 h-16 bg-white opacity-5 rounded-full"></div>
            <div class="absolute bottom-6 left-1/3 w-12 h-12 bg-white opacity-5 rounded-full"></div>
        </div>
        
        <div class="container mx-auto px-6 py-4 relative z-10">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <span class="text-2xl">🏥</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight">EPS Unillanos</h1>
                        <p class="text-eps-blue-100 text-sm font-medium">Sistema de Gestión Médica</p>
                    </div>
                </div>

                <nav class="hidden md:flex space-x-1">
                  <a href="/" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                        <span class="text-lg group-hover:scale-110 transition-transform duration-200">🧾</span>
                        <span class="font-medium">Inicio</span>
                    </a>
                    <a href="/admin" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                        <span class="text-lg group-hover:scale-110 transition-transform duration-200">📊</span>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    <a href="/cita" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                        <span class="text-lg group-hover:scale-110 transition-transform duration-200">📅</span>
                        <span class="font-medium">Citas</span>
                    </a>
                    <a href="/medico" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                        <span class="text-lg group-hover:scale-110 transition-transform duration-200">🩺</span>
                        <span class="font-medium">Médicos</span>
                    </a>
                    <a href="/horario" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                        <span class="text-lg group-hover:scale-110 transition-transform duration-200">🕒</span>
                        <span class="font-medium">Horarios</span>
                    </a>
                    <a href="/consultorio" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                        <span class="text-lg group-hover:scale-110 transition-transform duration-200">🏥</span>
                        <span class="font-medium">Consultorios</span>
                    </a>
                    <a href="/servicio" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                        <span class="text-lg group-hover:scale-110 transition-transform duration-200">🧾</span>
                        <span class="font-medium">Servicios</span>
                    </a>
                      <a href="/paciente" class="group flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 hover:shadow-lg backdrop-blur-sm">
                        <span class="text-lg group-hover:scale-110 transition-transform duration-200">🤒</span>
                        <span class="font-medium">Pacientes</span>
                    </a>
                </nav>

                <div class="md:hidden">
                    <button id="mobile-menu-button" class="p-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
                <div class="space-y-2">
                    <a href="/admin" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                        <span class="text-lg">📊</span>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    <a href="/cita" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                        <span class="text-lg">📅</span>
                        <span class="font-medium">Citas</span>
                    </a>
                    <a href="/medico" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                        <span class="text-lg">🩺</span>
                        <span class="font-medium">Médicos</span>
                    </a>
                    <a href="/horario" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                        <span class="text-lg">🕒</span>
                        <span class="font-medium">Horarios</span>
                    </a>
                    <a href="/consultorio" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                        <span class="text-lg">🏥</span>
                        <span class="font-medium">Consultorios</span>
                    </a>
                    <a href="/servicio" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                        <span class="text-lg">🧾</span>
                        <span class="font-medium">Servicios</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow container mx-auto px-6 py-8">

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>