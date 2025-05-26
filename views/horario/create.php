<?php require_once 'views/components/header.php'; ?>

<div class="max-w-4xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/horario" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-eps-blue-600 transition-colors duration-200">
                    <span class="mr-2">🕒</span>
                    Horarios
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500">Nuevo Horario</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-xl p-6 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">➕ Registrar Nuevo Horario</h2>
                <p class="text-gray-600">Configura un nuevo horario de atención médica</p>
            </div>
            <div class="w-16 h-16 bg-green-500 rounded-xl flex items-center justify-center">
                <span class="text-3xl text-white">🕒</span>
            </div>
        </div>
    </div>

    <!-- Pasos del proceso -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-eps-blue-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">1</div>
                <div class="ml-3">
                    <div class="text-sm font-medium text-gray-900">Seleccionar Médico</div>
                    <div class="text-xs text-gray-500">Elige el profesional</div>
                </div>
            </div>
            <div class="flex-1 h-px bg-gray-300 mx-4"></div>
            <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold">2</div>
                <div class="ml-3">
                    <div class="text-sm font-medium text-gray-500">Fecha y Hora</div>
                    <div class="text-xs text-gray-400">Cuándo estará disponible</div>
                </div>
            </div>
            <div class="flex-1 h-px bg-gray-300 mx-4"></div>
            <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold">3</div>
                <div class="ml-3">
                    <div class="text-sm font-medium text-gray-500">Confirmación</div>
                    <div class="text-xs text-gray-400">Revisar y guardar</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario principal -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-green-500 to-green-600 text-white">
            <h3 class="text-lg font-semibold">Configuración del Nuevo Horario</h3>
            <p class="text-green-100 text-sm">Completa todos los campos para crear el horario</p>
        </div>

        <form action="/horario/store" method="POST" class="p-6 space-y-8" id="createHorarioForm">
            <!-- Sección 1: Selección de Médico -->
            <div class="space-y-4">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-eps-blue-600 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">1</div>
                    <h4 class="text-lg font-semibold text-gray-900">Selección de Médico</h4>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6">
                    <label for="id_med" class="flex items-center text-sm font-medium text-gray-700 mb-3">
                        <span class="mr-2">👨‍⚕️</span>
                        Médico
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <select name="id_med" 
                            id="id_med" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                        <option value="">Seleccione el médico...</option>
                        <?php foreach ($this->d['medicos'] as $m): ?>
                            <option value="<?= $m['id_med'] ?>" data-especialidad="Especialidad">
                                Dr. <?= htmlspecialchars($m['nom_med']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="text-xs text-gray-500 mt-2">Selecciona el médico que estará disponible en este horario</p>
                    
                    <!-- Información del médico seleccionado -->
                    <div id="medicoInfo" class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg hidden">
                        <h5 class="text-sm font-semibold text-blue-800 mb-2">👨‍⚕️ Información del Médico</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="font-medium text-blue-800">Nombre:</span>
                                <span class="text-blue-700" id="medicoNombre">-</span>
                            </div>
                            <div>
                                <span class="font-medium text-blue-800">Especialidad:</span>
                                <span class="text-blue-700" id="medicoEspecialidad">-</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección 2: Fecha y Hora -->
            <div class="space-y-4">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold mr-3" id="step2">2</div>
                    <h4 class="text-lg font-semibold text-gray-500" id="step2-title">Fecha y Hora</h4>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <label for="fecha" class="flex items-center text-sm font-medium text-gray-700 mb-3">
                            <span class="mr-2">📅</span>
                            Fecha de Atención
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="date" 
                               name="fecha" 
                               id="fecha" 
                               min="<?= date('Y-m-d') ?>"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                        <p class="text-xs text-gray-500 mt-2">Selecciona la fecha en que el médico estará disponible</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <label for="hora" class="flex items-center text-sm font-medium text-gray-700 mb-3">
                            <span class="mr-2">🕐</span>
                            Hora de Atención
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="time" 
                               name="hora" 
                               id="hora" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                        <p class="text-xs text-gray-500 mt-2">Hora exacta de inicio de la consulta</p>
                    </div>
                </div>

                <!-- Horarios sugeridos -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h5 class="text-sm font-semibold text-gray-700 mb-3">⚡ Horarios Sugeridos</h5>
                    <div class="grid grid-cols-3 md:grid-cols-6 gap-2">
                        <button type="button" onclick="setTime('08:00')" class="px-3 py-2 bg-white border border-gray-300 rounded text-sm hover:bg-eps-blue-50 hover:border-eps-blue-300 transition-all duration-200">08:00</button>
                        <button type="button" onclick="setTime('09:00')" class="px-3 py-2 bg-white border border-gray-300 rounded text-sm hover:bg-eps-blue-50 hover:border-eps-blue-300 transition-all duration-200">09:00</button>
                        <button type="button" onclick="setTime('10:00')" class="px-3 py-2 bg-white border border-gray-300 rounded text-sm hover:bg-eps-blue-50 hover:border-eps-blue-300 transition-all duration-200">10:00</button>
                        <button type="button" onclick="setTime('14:00')" class="px-3 py-2 bg-white border border-gray-300 rounded text-sm hover:bg-eps-blue-50 hover:border-eps-blue-300 transition-all duration-200">14:00</button>
                        <button type="button" onclick="setTime('15:00')" class="px-3 py-2 bg-white border border-gray-300 rounded text-sm hover:bg-eps-blue-50 hover:border-eps-blue-300 transition-all duration-200">15:00</button>
                        <button type="button" onclick="setTime('16:00')" class="px-3 py-2 bg-white border border-gray-300 rounded text-sm hover:bg-eps-blue-50 hover:border-eps-blue-300 transition-all duration-200">16:00</button>
                    </div>
                </div>
            </div>

            <!-- Sección 3: Confirmación -->
            <div class="space-y-4">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold mr-3" id="step3">3</div>
                    <h4 class="text-lg font-semibold text-gray-500" id="step3-title">Confirmación</h4>
                </div>
                
                <!-- Resumen del horario -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6" id="summary" style="display: none;">
                    <h4 class="text-lg font-semibold text-blue-900 mb-4">📋 Resumen del Horario</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-blue-800">Médico:</span>
                            <span class="text-blue-700" id="summary-medico">-</span>
                        </div>
                        <div>
                            <span class="font-medium text-blue-800">Fecha:</span>
                            <span class="text-blue-700" id="summary-fecha">-</span>
                        </div>
                        <div>
                            <span class="font-medium text-blue-800">Hora:</span>
                            <span class="text-blue-700" id="summary-hora">-</span>
                        </div>
                        <div>
                            <span class="font-medium text-blue-800">Estado:</span>
                            <span class="text-green-700 font-semibold">Disponible</span>
                        </div>
                    </div>
                    
                    <!-- Verificación de conflictos -->
                    <div id="conflictWarning" class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg hidden">
                        <div class="flex items-start">
                            <span class="text-yellow-600 text-lg mr-2">⚠️</span>
                            <div>
                                <h6 class="text-sm font-semibold text-yellow-800">Posible Conflicto</h6>
                                <p class="text-sm text-yellow-700 mt-1" id="conflictMessage"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                <button type="submit" 
                        class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-xl hover:from-green-700 hover:to-green-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed"
                        id="submitBtn" disabled>
                    <span class="mr-2">💾</span>
                    Crear Horario
                </button>
                
                <a href="/horario" 
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
                <h4 class="text-sm font-semibold text-yellow-800">Consejos para crear horarios</h4>
                <ul class="text-sm text-yellow-700 mt-1 space-y-1">
                    <li>• El horario se creará con estado "Disponible" por defecto</li>
                    <li>• Verifica que no haya conflictos con otros horarios del mismo médico</li>
                    <li>• Los horarios pasados no se pueden crear</li>
                    <li>• Considera los horarios de trabajo habituales (8:00 AM - 6:00 PM)</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
// Elementos del formulario
const form = document.getElementById('createHorarioForm');
const submitBtn = document.getElementById('submitBtn');
const summary = document.getElementById('summary');

// Elementos de pasos
const step2 = document.getElementById('step2');
const step2Title = document.getElementById('step2-title');
const step3 = document.getElementById('step3');
const step3Title = document.getElementById('step3-title');

// Campos del formulario
const medicoSelect = document.getElementById('id_med');
const fechaInput = document.getElementById('fecha');
const horaInput = document.getElementById('hora');

// Función para establecer hora rápida
function setTime(time) {
    horaInput.value = time;
    updateSteps();
}

// Función para actualizar el estado de los pasos
function updateSteps() {
    // Paso 2
    if (medicoSelect.value) {
        step2.classList.remove('bg-gray-300', 'text-gray-600');
        step2.classList.add('bg-eps-blue-600', 'text-white');
        step2Title.classList.remove('text-gray-500');
        step2Title.classList.add('text-gray-900');
        showMedicoInfo();
    }
    
    // Paso 3
    if (medicoSelect.value && fechaInput.value && horaInput.value) {
        step3.classList.remove('bg-gray-300', 'text-gray-600');
        step3.classList.add('bg-eps-blue-600', 'text-white');
        step3Title.classList.remove('text-gray-500');
        step3Title.classList.add('text-gray-900');
        
        updateSummary();
        summary.style.display = 'block';
        submitBtn.disabled = false;
        checkConflicts();
    } else {
        summary.style.display = 'none';
        submitBtn.disabled = true;
    }
}

// Función para mostrar información del médico
function showMedicoInfo() {
    const medicoInfo = document.getElementById('medicoInfo');
    const medicoNombre = document.getElementById('medicoNombre');
    const medicoEspecialidad = document.getElementById('medicoEspecialidad');
    
    if (medicoSelect.value) {
        const selectedOption = medicoSelect.options[medicoSelect.selectedIndex];
        medicoNombre.textContent = selectedOption.text;
        medicoEspecialidad.textContent = selectedOption.getAttribute('data-especialidad') || 'No especificada';
        medicoInfo.classList.remove('hidden');
    } else {
        medicoInfo.classList.add('hidden');
    }
}

// Función para actualizar el resumen
function updateSummary() {
    const selectedMedico = medicoSelect.options[medicoSelect.selectedIndex];
    
    document.getElementById('summary-medico').textContent = 
        selectedMedico ? selectedMedico.text : '-';
    
    if (fechaInput.value) {
        const fecha = new Date(fechaInput.value + 'T00:00:00');
        document.getElementById('summary-fecha').textContent = 
            fecha.toLocaleDateString('es-ES', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
    } else {
        document.getElementById('summary-fecha').textContent = '-';
    }
    
    if (horaInput.value) {
        const hora = new Date('2000-01-01T' + horaInput.value);
        document.getElementById('summary-hora').textContent = 
            hora.toLocaleTimeString('es-ES', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
    } else {
        document.getElementById('summary-hora').textContent = '-';
    }
}

// Función para verificar conflictos (simulada)
function checkConflicts() {
    const conflictWarning = document.getElementById('conflictWarning');
    const conflictMessage = document.getElementById('conflictMessage');
    
    // Aquí podrías hacer una verificación real con AJAX
    // Por ahora, simulamos una verificación básica
    
    const selectedTime = horaInput.value;
    const selectedDate = fechaInput.value;
    
    // Ejemplo de verificación básica
    if (selectedTime && (selectedTime < '07:00' || selectedTime > '18:00')) {
        conflictWarning.classList.remove('hidden');
        conflictMessage.textContent = 'El horario seleccionado está fuera del horario laboral normal (7:00 AM - 6:00 PM).';
    } else {
        conflictWarning.classList.add('hidden');
    }
}

// Event listeners
medicoSelect.addEventListener('change', updateSteps);
fechaInput.addEventListener('change', updateSteps);
horaInput.addEventListener('change', updateSteps);

// Validación del formulario
form.addEventListener('submit', function(e) {
    const requiredFields = [medicoSelect, fechaInput, horaInput];
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
    
    // Validar que la fecha no sea pasada
    const selectedDate = new Date(fechaInput.value);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    if (selectedDate < today) {
        e.preventDefault();
        alert('No se pueden crear horarios para fechas pasadas.');
        fechaInput.classList.add('border-red-500');
        fechaInput.focus();
        return;
    }
    
    // Confirmación antes de enviar
    if (!confirm('¿Confirmas que deseas crear este horario con la información proporcionada?')) {
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
    
    // Establecer fecha mínima como hoy
    fechaInput.min = new Date().toISOString().split('T')[0];
});

// Inicializar estado
updateSteps();
</script>

<?php require_once 'views/components/footer.php'; ?>