<?php require_once 'views/components/header.php'; ?>

<div class="max-w-4xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/cita" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-eps-blue-600 transition-colors duration-200">
                    <span class="mr-2">📅</span>
                    Citas
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500">Nueva Cita</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-xl p-6 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">➕ Nueva Cita Médica</h2>
                <p class="text-gray-600">Programa una nueva cita para un paciente</p>
            </div>
            <div class="w-16 h-16 bg-green-500 rounded-xl flex items-center justify-center">
                <span class="text-3xl text-white">📅</span>
            </div>
        </div>
    </div>

    <!-- Pasos del proceso -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-eps-blue-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">1</div>
                <div class="ml-3">
                    <div class="text-sm font-medium text-gray-900">Información del Paciente</div>
                    <div class="text-xs text-gray-500">Selecciona el paciente</div>
                </div>
            </div>
            <div class="flex-1 h-px bg-gray-300 mx-4"></div>
            <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold">2</div>
                <div class="ml-3">
                    <div class="text-sm font-medium text-gray-500">Horario y Lugar</div>
                    <div class="text-xs text-gray-400">Fecha, hora y consultorio</div>
                </div>
            </div>
            <div class="flex-1 h-px bg-gray-300 mx-4"></div>
            <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold">3</div>
                <div class="ml-3">
                    <div class="text-sm font-medium text-gray-500">Servicio</div>
                    <div class="text-xs text-gray-400">Tipo de consulta</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario principal -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-green-500 to-green-600 text-white">
            <h3 class="text-lg font-semibold">Información de la Nueva Cita</h3>
            <p class="text-green-100 text-sm">Completa todos los campos para programar la cita</p>
        </div>

        <form action="/cita/store" method="POST" class="p-6 space-y-8" id="createCitaForm">
            <!-- Sección 1: Paciente -->
            <div class="space-y-4">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-eps-blue-600 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">1</div>
                    <h4 class="text-lg font-semibold text-gray-900">Selección de Paciente</h4>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-4">
                    <label for="id_pac" class="flex items-center text-sm font-medium text-gray-700 mb-3">
                        <span class="mr-2">👤</span>
                        Paciente
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <select name="id_pac" id="id_pac" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 bg-white">
                        <option value="">Seleccionar paciente...</option>
                        <?php foreach ($this->d['pacientes'] as $p): ?>
                            <option value="<?= $p['id_pac'] ?>">
                                <?= htmlspecialchars($p['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="text-xs text-gray-500 mt-2">Busca y selecciona el paciente que necesita la cita médica</p>
                </div>
            </div>

            <!-- Sección 2: Horario y Consultorio -->
            <div class="space-y-4">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold mr-3" id="step2">2</div>
                    <h4 class="text-lg font-semibold text-gray-500" id="step2-title">Horario y Ubicación</h4>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <label for="id_horario" class="flex items-center text-sm font-medium text-gray-700 mb-3">
                            <span class="mr-2">🕒</span>
                            Horario Disponible
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <select name="id_horario" id="id_horario" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 bg-white">
                            <option value="">Seleccionar horario...</option>
                            <?php foreach ($this->d['horarios'] as $h): ?>
                                <option value="<?= $h['id_horario'] ?>">
                                    <?= htmlspecialchars($h['detalle']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="text-xs text-gray-500 mt-2">Elige la fecha y hora disponible</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <label for="id_con" class="flex items-center text-sm font-medium text-gray-700 mb-3">
                            <span class="mr-2">🏥</span>
                            Consultorio
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <select name="id_con" id="id_con" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 bg-white">
                            <option value="">Seleccionar consultorio...</option>
                            <?php foreach ($this->d['consultorios'] as $c): ?>
                                <option value="<?= $c['id_con'] ?>">
                                    <?= htmlspecialchars($c['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="text-xs text-gray-500 mt-2">Ubicación donde se realizará la consulta</p>
                    </div>
                </div>
            </div>

            <!-- Sección 3: Servicio -->
            <div class="space-y-4">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold mr-3" id="step3">3</div>
                    <h4 class="text-lg font-semibold text-gray-500" id="step3-title">Tipo de Servicio</h4>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-4">
                    <label for="id_serv" class="flex items-center text-sm font-medium text-gray-700 mb-3">
                        <span class="mr-2">🧾</span>
                        Servicio Médico
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <select name="id_serv" id="id_serv" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 bg-white">
                        <option value="">Seleccionar servicio...</option>
                        <?php foreach ($this->d['servicios'] as $s): ?>
                            <option value="<?= $s['id_serv'] ?>">
                                <?= htmlspecialchars($s['desc_serv']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="text-xs text-gray-500 mt-2">Tipo de consulta o procedimiento médico</p>
                </div>
            </div>

            <!-- Resumen antes de enviar -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6" id="summary" style="display: none;">
                <h4 class="text-lg font-semibold text-blue-900 mb-4">📋 Resumen de la Cita</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="font-medium text-blue-800">Paciente:</span>
                        <span class="text-blue-700" id="summary-patient">-</span>
                    </div>
                    <div>
                        <span class="font-medium text-blue-800">Horario:</span>
                        <span class="text-blue-700" id="summary-schedule">-</span>
                    </div>
                    <div>
                        <span class="font-medium text-blue-800">Consultorio:</span>
                        <span class="text-blue-700" id="summary-office">-</span>
                    </div>
                    <div>
                        <span class="font-medium text-blue-800">Servicio:</span>
                        <span class="text-blue-700" id="summary-service">-</span>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                <button type="submit" 
                        class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-xl hover:from-green-700 hover:to-green-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed"
                        id="submitBtn" disabled>
                    <span class="mr-2">💾</span>
                    Crear Cita
                </button>
                
                <a href="/cita" 
                   class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-200 border border-gray-300">
                    <span class="mr-2">↩️</span>
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    <!-- Información de ayuda -->
    <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-xl p-4">
        <div class="flex items-start">
            <span class="text-yellow-600 text-xl mr-3">💡</span>
            <div>
                <h4 class="text-sm font-semibold text-yellow-800">Consejos para crear citas</h4>
                <ul class="text-sm text-yellow-700 mt-1 space-y-1">
                    <li>• Verifica que el horario seleccionado esté realmente disponible</li>
                    <li>• El consultorio debe ser apropiado para el tipo de servicio</li>
                    <li>• Confirma los datos del paciente antes de guardar</li>
                    <li>• La cita se creará con estado "Pendiente" por defecto</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
// Elementos del formulario
const form = document.getElementById('createCitaForm');
const submitBtn = document.getElementById('submitBtn');
const summary = document.getElementById('summary');

// Elementos de pasos
const step2 = document.getElementById('step2');
const step2Title = document.getElementById('step2-title');
const step3 = document.getElementById('step3');
const step3Title = document.getElementById('step3-title');

// Campos del formulario
const patientSelect = document.getElementById('id_pac');
const scheduleSelect = document.getElementById('id_horario');
const officeSelect = document.getElementById('id_con');
const serviceSelect = document.getElementById('id_serv');

// Función para actualizar el estado de los pasos
function updateSteps() {
    // Paso 2
    if (patientSelect.value) {
        step2.classList.remove('bg-gray-300', 'text-gray-600');
        step2.classList.add('bg-eps-blue-600', 'text-white');
        step2Title.classList.remove('text-gray-500');
        step2Title.classList.add('text-gray-900');
    }
    
    // Paso 3
    if (patientSelect.value && scheduleSelect.value && officeSelect.value) {
        step3.classList.remove('bg-gray-300', 'text-gray-600');
        step3.classList.add('bg-eps-blue-600', 'text-white');
        step3Title.classList.remove('text-gray-500');
        step3Title.classList.add('text-gray-900');
    }
    
    // Mostrar resumen y habilitar botón
    if (patientSelect.value && scheduleSelect.value && officeSelect.value && serviceSelect.value) {
        updateSummary();
        summary.style.display = 'block';
        submitBtn.disabled = false;
    } else {
        summary.style.display = 'none';
        submitBtn.disabled = true;
    }
}

// Función para actualizar el resumen
function updateSummary() {
    document.getElementById('summary-patient').textContent = 
        patientSelect.options[patientSelect.selectedIndex].text || '-';
    document.getElementById('summary-schedule').textContent = 
        scheduleSelect.options[scheduleSelect.selectedIndex].text || '-';
    document.getElementById('summary-office').textContent = 
        officeSelect.options[officeSelect.selectedIndex].text || '-';
    document.getElementById('summary-service').textContent = 
        serviceSelect.options[serviceSelect.selectedIndex].text || '-';
}

// Event listeners
patientSelect.addEventListener('change', updateSteps);
scheduleSelect.addEventListener('change', updateSteps);
officeSelect.addEventListener('change', updateSteps);
serviceSelect.addEventListener('change', updateSteps);

// Validación del formulario
form.addEventListener('submit', function(e) {
    const requiredFields = [patientSelect, scheduleSelect, officeSelect, serviceSelect];
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value) {
            isValid = false;
            field.classList.add('border-red-500');
        } else {
            field.classList.remove('border-red-500');
        }
    });
    
    if (!isValid) {
        e.preventDefault();
        alert('Por favor, completa todos los campos obligatorios.');
        return;
    }
    
    // Confirmación antes de enviar
    if (!confirm('¿Confirmas que deseas crear esta cita con la información proporcionada?')) {
        e.preventDefault();
    }
});

// Animaciones de entrada
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.space-y-4, .bg-white.rounded-xl');
    sections.forEach((section, index) => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        setTimeout(() => {
            section.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
            section.style.opacity = '1';
            section.style.transform = 'translateY(0)';
        }, index * 100);
    });
});

// Inicializar estado
updateSteps();
</script>

<?php require_once 'views/components/footer.php'; ?>