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

<!-- Nueva sección de consulta de citas -->
<div class="bg-white rounded-2xl shadow-xl p-8 mb-12">
  <div class="text-center mb-8">
    <h2 class="text-3xl font-bold text-gray-900 mb-4">🔍 Consultar Citas</h2>
    <p class="text-lg text-gray-600">Busca información de citas por número de cita o documento del paciente</p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Consultar por ID de cita -->
    <div class="bg-gradient-to-br from-eps-blue-50 to-eps-blue-100 rounded-xl p-6">
      <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
        <span class="mr-2">🆔</span>
        Consultar por Número de Cita
      </h3>
      <form id="consultarCitaForm" class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Número de Cita</label>
          <input type="number" id="id_cita" name="id_cita" placeholder="Ingrese el número de cita" 
                 class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
        </div>
        <button type="submit" class="w-full bg-eps-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-eps-blue-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
          <span class="mr-2">🔍</span>
          Buscar Cita
        </button>
      </form>
    </div>

    <!-- Consultar por documento -->
    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6">
      <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
        <span class="mr-2">👤</span>
        Consultar por Documento
      </h3>
      <form id="consultarPacienteForm" class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Número de Documento</label>
          <input type="text" id="dni_paciente" name="dni_paciente" placeholder="Ingrese el número de documento" 
                 class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200">
        </div>
        <button type="submit" class="w-full bg-green-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
          <span class="mr-2">👥</span>
          Buscar Citas del Paciente
        </button>
      </form>
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
    <a class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
      <div class="p-8">
        <div class="w-16 h-16 bg-gradient-to-br from-eps-blue-500 to-eps-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
          <span class="text-3xl text-white">📅</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Gestionar Citas</h3>
        <p class="text-gray-600 mb-4">Programa, modifica y cancela citas médicas de forma rápida y eficiente.</p>
        <div class="flex items-center text-eps-blue-600 font-semibold group-hover:text-eps-blue-700">
          <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </div>
      </div>
    </a>

    <a class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
      <div class="p-8">
        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
          <span class="text-3xl text-white">🩺</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Médicos</h3>
        <p class="text-gray-600 mb-4">Administra la información de médicos, especialidades y disponibilidad.</p>
        <div class="flex items-center text-green-600 font-semibold group-hover:text-green-700">
          <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </div>
      </div>
    </a>

    <a class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
      <div class="p-8">
        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
          <span class="text-3xl text-white">🕒</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Horarios</h3>
        <p class="text-gray-600 mb-4">Configura y gestiona los horarios de atención de los profesionales.</p>
        <div class="flex items-center text-purple-600 font-semibold group-hover:text-purple-700">
          <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </div>
      </div>
    </a>

    <a class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
      <div class="p-8">
        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
          <span class="text-3xl text-white">🏥</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Consultorios</h3>
        <p class="text-gray-600 mb-4">Administra espacios físicos y su asignación por especialidades.</p>
        <div class="flex items-center text-indigo-600 font-semibold group-hover:text-indigo-700">
          <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </div>
      </div>
    </a>

    <a class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
      <div class="p-8">
        <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
          <span class="text-3xl text-white">🧾</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Servicios</h3>
        <p class="text-gray-600 mb-4">Gestiona el catálogo de servicios médicos y sus tarifas.</p>
        <div class="flex items-center text-orange-600 font-semibold group-hover:text-orange-700">
          <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </div>
      </div>
    </a>

    <a class="group bg-gradient-to-br from-eps-blue-500 to-eps-blue-600 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden text-white">
      <div class="p-8">
        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
          <span class="text-3xl">📊</span>
        </div>
        <h3 class="text-xl font-bold mb-3">Dashboard</h3>
        <p class="text-eps-blue-100 mb-4">Visualiza estadísticas y métricas importantes del sistema.</p>
        <div class="flex items-center font-semibold">
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

<!-- Modal para mostrar información de la cita -->
<div id="citaModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
    <div class="p-8">
      <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-900">📄 Información de la Cita</h3>
        <button onclick="cerrarModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
      </div>
      
      <div id="citaContent">
        <!-- El contenido se llenará dinámicamente -->
      </div>
      
      <div class="flex gap-4 mt-8">
        <button onclick="imprimirCita()" class="flex-1 bg-eps-blue-600 text-white py-3 px-6 rounded-lg hover:bg-eps-blue-700 transition-colors">
          <span class="mr-2">🖨️</span>
          Imprimir
        </button>
        <button onclick="cerrarModal()" class="bg-gray-300 text-gray-700 py-3 px-6 rounded-lg hover:bg-gray-400 transition-colors">
          Cerrar
        </button>
      </div>
    </div>
  </div>
</div>

<style>
  @keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
  }

  .animate-float {
    animation: float 3s ease-in-out infinite;
  }

  .animate-float-delayed {
    animation: float 3s ease-in-out infinite;
    animation-delay: 1s;
  }

  @media print {
    .no-print {
      display: none !important;
    }
    
    .print-only {
      display: block !important;
    }
  }
</style>

<script>
  // Función para consultar cita por ID
  document.getElementById('consultarCitaForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const idCita = document.getElementById('id_cita').value;
    if (!idCita) {
      alert('Por favor ingrese el número de cita');
      return;
    }
    
    try {
      const response = await fetch('/main/consultarCita', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id_cita=${encodeURIComponent(idCita)}`
      });
      
      const data = await response.json();
      
      if (data.success) {
        mostrarCitaEnModal(data.data);
      } else {
        alert(data.message || 'No se encontró la cita');
      }
    } catch (error) {
      console.error('Error:', error);
      alert('Error al consultar la cita');
    }
  });

  // Función para consultar citas por documento
  document.getElementById('consultarPacienteForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const dniPaciente = document.getElementById('dni_paciente').value;
    if (!dniPaciente) {
      alert('Por favor ingrese el número de documento');
      return;
    }
    
    try {
      const response = await fetch('/main/consultarCitasPaciente', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `dni_paciente=${encodeURIComponent(dniPaciente)}`
      });
      
      const data = await response.json();
      
      if (data.success) {
        mostrarCitasPacienteEnModal(data.data);
      } else {
        alert(data.message || 'No se encontraron citas para este documento');
      }
    } catch (error) {
      console.error('Error:', error);
      alert('Error al consultar las citas');
    }
  });

  // Función para mostrar una cita individual en el modal
  function mostrarCitaEnModal(cita) {
    const statusClasses = {
      'pendiente': 'bg-yellow-100 text-yellow-800',
      'completada': 'bg-green-100 text-green-800',
      'cancelada': 'bg-red-100 text-red-800'
    };
    
    const statusIcons = {
      'pendiente': '⏳',
      'completada': '✅',
      'cancelada': '❌'
    };

    const content = `
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-4">
          <div class="bg-eps-blue-50 p-4 rounded-lg">
            <h4 class="font-semibold text-eps-blue-800 mb-2">📋 Información de la Cita</h4>
            <p><strong>ID Cita:</strong> #${String(cita.id_cita).padStart(4, '0')}</p>
            <p><strong>Estado:</strong> 
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusClasses[cita.est_cita] || 'bg-gray-100 text-gray-800'}">
                <span class="mr-1">${statusIcons[cita.est_cita] || '❓'}</span>
                ${cita.est_cita.charAt(0).toUpperCase() + cita.est_cita.slice(1)}
              </span>
            </p>
          </div>

          <div class="bg-green-50 p-4 rounded-lg">
            <h4 class="font-semibold text-green-800 mb-2">👤 Información del Paciente</h4>
            <p><strong>Nombre:</strong> ${cita.nombre_completo_paciente}</p>
            <p><strong>Documento:</strong> ${cita.dni_pac}</p>
            <p><strong>Fecha de Nacimiento:</strong> ${new Date(cita.fec_pac).toLocaleDateString()}</p>
          </div>

          <div class="bg-purple-50 p-4 rounded-lg">
            <h4 class="font-semibold text-purple-800 mb-2">🩺 Información Médica</h4>
            <p><strong>Médico:</strong> ${cita.nom_med}</p>
            <p><strong>Especialidad:</strong> ${cita.nom_esp}</p>
            <p><strong>Contacto:</strong> ${cita.contacto_med}</p>
          </div>
        </div>

        <div class="space-y-4">
          <div class="bg-indigo-50 p-4 rounded-lg">
            <h4 class="font-semibold text-indigo-800 mb-2">📅 Fecha y Hora</h4>
            <p><strong>Fecha:</strong> ${new Date(cita.fecha).toLocaleDateString()}</p>
            <p><strong>Hora:</strong> ${cita.hora}</p>
          </div>

          <div class="bg-orange-50 p-4 rounded-lg">
            <h4 class="font-semibold text-orange-800 mb-2">🏥 Consultorio</h4>
            <p><strong>Consultorio:</strong> ${cita.nro_con}</p>
            <p><strong>Ubicación:</strong> ${cita.ubicacion}</p>
          </div>

          <div class="bg-red-50 p-4 rounded-lg">
            <h4 class="font-semibold text-red-800 mb-2">🧾 Servicio</h4>
            <p><strong>Servicio:</strong> ${cita.desc_serv}</p>
            <p><strong>Costo:</strong> ${parseFloat(cita.costo_serv).toLocaleString()}</p>
          </div>
        </div>
      </div>
    `;
    
    document.getElementById('citaContent').innerHTML = content;
    document.getElementById('citaModal').classList.remove('hidden');
    document.getElementById('citaModal').classList.add('flex');
  }

  // Función para mostrar múltiples citas de un paciente
  function mostrarCitasPacienteEnModal(citas) {
    const statusClasses = {
      'pendiente': 'bg-yellow-100 text-yellow-800',
      'completada': 'bg-green-100 text-green-800',
      'cancelada': 'bg-red-100 text-red-800'
    };
    
    const statusIcons = {
      'pendiente': '⏳',
      'completada': '✅',
      'cancelada': '❌'
    };

    let citasHtml = '';
    citas.forEach(cita => {
      citasHtml += `
        <div class="border border-gray-200 rounded-lg p-4 mb-4 hover:shadow-md transition-shadow">
          <div class="flex justify-between items-start mb-3">
            <div>
              <h5 class="font-semibold text-lg">Cita #${String(cita.id_cita).padStart(4, '0')}</h5>
              <p class="text-gray-600">${new Date(cita.fecha).toLocaleDateString()} - ${cita.hora}</p>
            </div>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusClasses[cita.est_cita] || 'bg-gray-100 text-gray-800'}">
              <span class="mr-1">${statusIcons[cita.est_cita] || '❓'}</span>
              ${cita.est_cita.charAt(0).toUpperCase() + cita.est_cita.slice(1)}
            </span>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
              <p><strong>Médico:</strong> ${cita.nom_med}</p>
              <p><strong>Especialidad:</strong> ${cita.nom_esp}</p>
            </div>
            <div>
              <p><strong>Consultorio:</strong> ${cita.nro_con} - ${cita.ubicacion}</p>
              <p><strong>Servicio:</strong> ${cita.desc_serv}</p>
            </div>
          </div>
        </div>
      `;
    });

    const content = `
      <div class="mb-4">
        <div class="bg-eps-blue-50 p-4 rounded-lg mb-4">
          <h4 class="font-semibold text-eps-blue-800 mb-2">👤 Paciente: ${citas[0].nombre_completo_paciente}</h4>
          <p><strong>Documento:</strong> ${citas[0].dni_pac}</p>
          <p><strong>Total de citas:</strong> ${citas.length}</p>
        </div>
      </div>
      
      <div class="max-h-96 overflow-y-auto">
        ${citasHtml}
      </div>
    `;
    
    document.getElementById('citaContent').innerHTML = content;
    document.getElementById('citaModal').classList.remove('hidden');
    document.getElementById('citaModal').classList.add('flex');
  }

  // Función para cerrar el modal
  function cerrarModal() {
    document.getElementById('citaModal').classList.add('hidden');
    document.getElementById('citaModal').classList.remove('flex');
  }

  // Función para imprimir la cita
  function imprimirCita() {
    const modalContent = document.getElementById('citaContent').innerHTML;
    const printWindow = window.open('', '_blank');
    
    printWindow.document.write(`
      <!DOCTYPE html>
      <html>
        <head>
          <title>Información de Cita - EPS Unillanos</title>
          <style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #1e40af; padding-bottom: 20px; }
            .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
            .section { background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 15px; }
            .section h4 { margin: 0 0 10px 0; color: #1e40af; }
            .section p { margin: 5px 0; }
            @media print { body { margin: 0; } }
          </style>
        </head>
        <body>
          <div class="header">
            <h1>🏥 EPS Unillanos</h1>
            <h2>Información de Cita Médica</h2>
            <p>Fecha de impresión: ${new Date().toLocaleDateString()} ${new Date().toLocaleTimeString()}</p>
          </div>
          ${modalContent}
        </body>
      </html>
    `);
    
    printWindow.document.close();
    printWindow.print();
  }

  // Cerrar modal al hacer clic fuera de él
  document.getElementById('citaModal').addEventListener('click', function(e) {
    if (e.target === this) {
      cerrarModal();
    }
  });

  // Animaciones al cargar la página
  document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.group, .shadow-lg');

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