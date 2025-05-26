<?php require_once 'views/components/header.php'; ?>

<div class="relative overflow-hidden bg-gradient-to-br from-eps-blue-50 via-white to-eps-blue-50 rounded-2xl shadow-xl mb-12">
  <div class="absolute inset-0">
    <div class="absolute top-10 left-10 w-32 h-32 bg-eps-blue-200 opacity-20 rounded-full blur-2xl"></div>
    <div class="absolute bottom-10 right-10 w-40 h-40 bg-eps-blue-300 opacity-15 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-eps-blue-100 to-transparent opacity-10 rounded-full blur-3xl"></div>
  </div>

  <div class="relative px-8 py-16 text-center">
    <div class="mb-6">
      <div class="inline-flex items-center justify-center w-20 h-20 bg-eps-blue-500 rounded-2xl shadow-lg mb-6">
        <span class="text-4xl text-white">🏥</span>
      </div>
    </div>

    <h1 class="text-5xl font-bold text-gray-900 mb-4 leading-tight">
      Bienvenido al Sistema
      <span class="bg-gradient-to-r from-eps-blue-600 to-eps-blue-800 bg-clip-text text-transparent">
        EPS Unillanos
      </span>
    </h1>

    <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed">
      Gestiona de manera eficiente citas médicas, horarios y servicios de salud con nuestra plataforma moderna y fácil de usar.
    </p>

    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="/cita" class="inline-flex items-center px-8 py-4 bg-eps-blue-600 text-white font-semibold rounded-xl hover:bg-eps-blue-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
        <span class="mr-2 text-xl">📅</span>
        Reservar Cita
      </a>
      <a href="/admin" class="inline-flex items-center px-8 py-4 bg-white text-eps-blue-600 font-semibold rounded-xl border-2 border-eps-blue-600 hover:bg-eps-blue-50 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
        <span class="mr-2 text-xl">📊</span>
        Ver Dashboard
      </a>
    </div>
  </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
  <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-eps-blue-500 transform hover:scale-105 transition-all duration-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Citas Programadas</p>
        <p class="text-2xl font-bold text-gray-900">150+</p>
      </div>
      <div class="w-12 h-12 bg-eps-blue-100 rounded-lg flex items-center justify-center">
        <span class="text-2xl">📅</span>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 transform hover:scale-105 transition-all duration-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Médicos Activos</p>
        <p class="text-2xl font-bold text-gray-900">25+</p>
      </div>
      <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
        <span class="text-2xl">🩺</span>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 transform hover:scale-105 transition-all duration-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Especialidades</p>
        <p class="text-2xl font-bold text-gray-900">15+</p>
      </div>
      <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
        <span class="text-2xl">⚕️</span>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-orange-500 transform hover:scale-105 transition-all duration-200">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600">Satisfacción</p>
        <p class="text-2xl font-bold text-gray-900">98%</p>
      </div>
      <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
        <span class="text-2xl">⭐</span>
      </div>
    </div>
  </div>
</div>

<div class="mb-12">
  <div class="text-center mb-10">
    <h2 class="text-3xl font-bold text-gray-900 mb-4">Servicios Principales</h2>
    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
      Accede rápidamente a todas las funcionalidades del sistema de gestión médica
    </p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <a href="/cita" class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
      <div class="p-8">
        <div class="w-16 h-16 bg-gradient-to-br from-eps-blue-500 to-eps-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
          <span class="text-3xl text-white">📅</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Gestionar Citas</h3>
        <p class="text-gray-600 mb-4">Programa, modifica y cancela citas médicas de forma rápida y eficiente.</p>
        <div class="flex items-center text-eps-blue-600 font-semibold group-hover:text-eps-blue-700">
          <span>Acceder</span>
          <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </div>
      </div>
    </a>

    <a href="/medico" class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
      <div class="p-8">
        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
          <span class="text-3xl text-white">🩺</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Médicos</h3>
        <p class="text-gray-600 mb-4">Administra la información de médicos, especialidades y disponibilidad.</p>
        <div class="flex items-center text-green-600 font-semibold group-hover:text-green-700">
          <span>Acceder</span>
          <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </div>
      </div>
    </a>

    <a href="/horario" class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
      <div class="p-8">
        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
          <span class="text-3xl text-white">🕒</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Horarios</h3>
        <p class="text-gray-600 mb-4">Configura y gestiona los horarios de atención de los profesionales.</p>
        <div class="flex items-center text-purple-600 font-semibold group-hover:text-purple-700">
          <span>Acceder</span>
          <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </div>
      </div>
    </a>

    <a href="/consultorio" class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
      <div class="p-8">
        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
          <span class="text-3xl text-white">🏥</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Consultorios</h3>
        <p class="text-gray-600 mb-4">Administra espacios físicos y su asignación por especialidades.</p>
        <div class="flex items-center text-indigo-600 font-semibold group-hover:text-indigo-700">
          <span>Acceder</span>
          <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </div>
      </div>
    </a>

    <a href="/servicio" class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
      <div class="p-8">
        <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
          <span class="text-3xl text-white">🧾</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Servicios</h3>
        <p class="text-gray-600 mb-4">Gestiona el catálogo de servicios médicos y sus tarifas.</p>
        <div class="flex items-center text-orange-600 font-semibold group-hover:text-orange-700">
          <span>Acceder</span>
          <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </div>
      </div>
    </a>

    <a href="/admin" class="group bg-gradient-to-br from-eps-blue-500 to-eps-blue-600 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden text-white">
      <div class="p-8">
        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
          <span class="text-3xl">📊</span>
        </div>
        <h3 class="text-xl font-bold mb-3">Dashboard</h3>
        <p class="text-eps-blue-100 mb-4">Visualiza estadísticas y métricas importantes del sistema.</p>
        <div class="flex items-center font-semibold">
          <span>Acceder</span>
          <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </div>
      </div>
    </a>
  </div>
</div>

<div class="bg-gradient-to-r from-eps-blue-50 to-eps-blue-100 rounded-2xl p-8 mb-12">
  <div class="text-center mb-8">
    <h2 class="text-3xl font-bold text-gray-900 mb-4">¿Por qué elegir EPS Unillanos?</h2>
    <p class="text-lg text-gray-600">Características que nos hacen únicos</p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="text-center">
      <div class="w-16 h-16 bg-eps-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
        <span class="text-2xl text-white">⚡</span>
      </div>
      <h3 class="text-xl font-semibold text-gray-900 mb-2">Rápido y Eficiente</h3>
      <p class="text-gray-600">Sistema optimizado para gestión ágil de citas y servicios médicos.</p>
    </div>

    <div class="text-center">
      <div class="w-16 h-16 bg-eps-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
        <span class="text-2xl text-white">🔒</span>
      </div>
      <h3 class="text-xl font-semibold text-gray-900 mb-2">Seguro y Confiable</h3>
      <p class="text-gray-600">Protección de datos médicos con los más altos estándares de seguridad.</p>
    </div>

    <div class="text-center">
      <div class="w-16 h-16 bg-eps-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
        <span class="text-2xl text-white">📱</span>
      </div>
      <h3 class="text-xl font-semibold text-gray-900 mb-2">Acceso 24/7</h3>
      <p class="text-gray-600">Disponible en cualquier momento desde cualquier dispositivo.</p>
    </div>
  </div>
</div>

<style>
  @keyframes float {

    0%,
    100% {
      transform: translateY(0px);
    }

    50% {
      transform: translateY(-10px);
    }
  }

  .animate-float {
    animation: float 3s ease-in-out infinite;
  }

  .animate-float-delayed {
    animation: float 3s ease-in-out infinite;
    animation-delay: 1s;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.group');

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }, index * 100);
        }
      });
    }, {
      threshold: 0.1
    });

    cards.forEach(card => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(20px)';
      card.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
      observer.observe(card);
    });
  });
</script>

<?php require_once 'views/components/footer.php'; ?>