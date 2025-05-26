<?php require_once 'views/components/header.php'; ?>

<div class="max-w-4xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/medico" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-eps-blue-600 transition-colors duration-200">
                    <span class="mr-2">🩺</span>
                    Médicos
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500">Nuevo Médico</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-xl p-6 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">➕ Registrar Nuevo Médico</h2>
                <p class="text-gray-600">Añade un nuevo profesional médico al equipo</p>
            </div>
            <div class="w-16 h-16 bg-green-500 rounded-xl flex items-center justify-center">
                <span class="text-3xl text-white">🩺</span>
            </div>
        </div>
    </div>

    <!-- Pasos del proceso -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-eps-blue-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">1</div>
                <div class="ml-3">
                    <div class="text-sm font-medium text-gray-900">Información Personal</div>
                    <div class="text-xs text-gray-500">Nombre completo del médico</div>
                </div>
            </div>
            <div class="flex-1 h-px bg-gray-300 mx-4"></div>
            <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold">2</div>
                <div class="ml-3">
                    <div class="text-sm font-medium text-gray-500">Especialidad</div>
                    <div class="text-xs text-gray-400">Área de especialización</div>
                </div>
            </div>
            <div class="flex-1 h-px bg-gray-300 mx-4"></div>
            <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold">3</div>
                <div class="ml-3">
                    <div class="text-sm font-medium text-gray-500">Contacto</div>
                    <div class="text-xs text-gray-400">Información de contacto</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario principal -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-green-500 to-green-600 text-white">
            <h3 class="text-lg font-semibold">Información del Nuevo Médico</h3>
            <p class="text-green-100 text-sm">Completa todos los campos para registrar al médico</p>
        </div>

        <form action="/medico/store" method="POST" class="p-6 space-y-8" id="createMedicoForm">
            <!-- Sección 1: Información Personal -->
            <div class="space-y-4">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-eps-blue-600 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">1</div>
                    <h4 class="text-lg font-semibold text-gray-900">Información Personal</h4>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6">
                    <label for="nom_med" class="flex items-center text-sm font-medium text-gray-700 mb-3">
                        <span class="mr-2">👨‍⚕️</span>
                        Nombre Completo del Médico
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" 
                           name="nom_med" 
                           id="nom_med" 
                           placeholder="Ej: Juan Carlos Pérez Rodríguez" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                    <p class="text-xs text-gray-500 mt-2">Ingresa el nombre completo sin el título "Dr."</p>
                </div>
            </div>

            <!-- Sección 2: Especialidad -->
            <div class="space-y-4">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold mr-3" id="step2">2</div>
                    <h4 class="text-lg font-semibold text-gray-500" id="step2-title">Especialidad Médica</h4>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6">
                    <label for="id_esp" class="flex items-center text-sm font-medium text-gray-700 mb-3">
                        <span class="mr-2">⚕️</span>
                        Especialidad
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <select name="id_esp" 
                            id="id_esp" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                        <option value="">Seleccione la especialidad médica...</option>
                        <?php foreach ($this->d['especialidades'] as $e): ?>
                            <option value="<?= $e['id_esp'] ?>">
                                <?= htmlspecialchars($e['nom_esp']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="text-xs text-gray-500 mt-2">Selecciona el área de especialización del médico</p>
                    
                    <!-- Mostrar información de la especialidad seleccionada -->
                    <div id="especialidadInfo" class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg hidden">
                        <h5 class="text-sm font-semibold text-blue-800 mb-2">📋 Información de la Especialidad</h5>
                        <p class="text-sm text-blue-700" id="especialidadDescripcion">-</p>
                    </div>
                </div>
            </div>

            <!-- Sección 3: Información de Contacto -->
            <div class="space-y-4">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold mr-3" id="step3">3</div>
                    <h4 class="text-lg font-semibold text-gray-500" id="step3-title">Información de Contacto</h4>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6">
                    <label for="contacto_med" class="flex items-center text-sm font-medium text-gray-700 mb-3">
                        <span class="mr-2">📞</span>
                        Información de Contacto
                    </label>
                    <input type="text" 
                           name="contacto_med" 
                           id="contacto_med" 
                           placeholder="Ej: +57 300 123 4567 / email@ejemplo.com" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                    <p class="text-xs text-gray-500 mt-2">Teléfono, email u otra forma de contacto (opcional)</p>
                </div>
            </div>

            <!-- Resumen antes de enviar -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6" id="summary" style="display: none;">
                <h4 class="text-lg font-semibold text-blue-900 mb-4">📋 Resumen del Registro</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="font-medium text-blue-800">Médico:</span>
                        <span class="text-blue-700" id="summary-name">-</span>
                    </div>
                    <div>
                        <span class="font-medium text-blue-800">Especialidad:</span>
                        <span class="text-blue-700" id="summary-specialty">-</span>
                    </div>
                    <div>
                        <span class="font-medium text-blue-800">Contacto:</span>
                        <span class="text-blue-700" id="summary-contact">-</span>
                    </div>
                    <div>
                        <span class="font-medium text-blue-800">Estado inicial:</span>
                        <span class="text-green-700 font-semibold">Activo</span>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                <button type="submit" 
                        class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-xl hover:from-green-700 hover:to-green-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed"
                        id="submitBtn" disabled>
                    <span class="mr-2">💾</span>
                    Registrar Médico
                </button>
                
                <a href="/medico" 
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
                <h4 class="text-sm font-semibold text-yellow-800">Información importante</h4>
                <ul class="text-sm text-yellow-700 mt-1 space-y-1">
                    <li>• El médico se registrará con estado "Activo" por defecto</li>
                    <li>• Asegúrate de que la especialidad sea correcta antes de guardar</li>
                    <li>• La información de contacto es opcional pero recomendada</li>
                    <li>• Podrás editar toda la información después del registro</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
// Elementos del formulario
const form = document.getElementById('createMedicoForm');
const submitBtn = document.getElementById('submitBtn');
const summary = document.getElementById('summary');

// Elementos de pasos
const step2 = document.getElementById('step2');
const step2Title = document.getElementById('step2-title');
const step3 = document.getElementById('step3');
const step3Title = document.getElementById('step3-title');

// Campos del formulario
const nameInput = document.getElementById('nom_med');
const specialtySelect = document.getElementById('id_esp');
const contactInput = document.getElementById('contacto_med');

// Información de especialidades (puedes expandir esto)
const especialidadesInfo = {
    1: "Atención médica general, diagnóstico y tratamiento de enfermedades comunes.",
    2: "Especialización en enfermedades del corazón y sistema cardiovascular.",
    3: "Atención médica especializada para bebés, niños y adolescentes.",
    4: "Atención integral de la salud femenina y sistema reproductivo."
};

// Función para actualizar el estado de los pasos
function updateSteps() {
    // Paso 2
    if (nameInput.value.trim()) {
        step2.classList.remove('bg-gray-300', 'text-gray-600');
        step2.classList.add('bg-eps-blue-600', 'text-white');
        step2Title.classList.remove('text-gray-500');
        step2Title.classList.add('text-gray-900');
    }
    
    // Paso 3
    if (nameInput.value.trim() && specialtySelect.value) {
        step3.classList.remove('bg-gray-300', 'text-gray-600');
        step3.classList.add('bg-eps-blue-600', 'text-white');
        step3Title.classList.remove('text-gray-500');
        step3Title.classList.add('text-gray-900');
    }
    
    // Mostrar resumen y habilitar botón
    if (nameInput.value.trim() && specialtySelect.value) {
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
    document.getElementById('summary-name').textContent = 
        'Dr. ' + nameInput.value.trim() || '-';
    document.getElementById('summary-specialty').textContent = 
        specialtySelect.options[specialtySelect.selectedIndex].text || '-';
    document.getElementById('summary-contact').textContent = 
        contactInput.value.trim() || 'No especificado';
}

// Función para mostrar información de la especialidad
function showSpecialtyInfo() {
    const especialidadInfo = document.getElementById('especialidadInfo');
    const especialidadDescripcion = document.getElementById('especialidadDescripcion');
    
    if (specialtySelect.value) {
        const info = especialidadesInfo[specialtySelect.value] || 'Información no disponible para esta especialidad.';
        especialidadDescripcion.textContent = info;
        especialidadInfo.classList.remove('hidden');
    } else {
        especialidadInfo.classList.add('hidden');
    }
}

// Event listeners
nameInput.addEventListener('input', updateSteps);
specialtySelect.addEventListener('change', function() {
    updateSteps();
    showSpecialtyInfo();
});
contactInput.addEventListener('input', updateSummary);

// Validación del formulario
form.addEventListener('submit', function(e) {
    const requiredFields = [nameInput, specialtySelect];
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
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
    
    // Validación adicional para el nombre
    if (nameInput.value.trim().length < 3) {
        e.preventDefault();
        alert('El nombre del médico debe tener al menos 3 caracteres.');
        nameInput.classList.add('border-red-500');
        nameInput.focus();
        return;
    }
    
    // Confirmación antes de enviar
    if (!confirm('¿Confirmas que deseas registrar a este médico con la información proporcionada?')) {
        e.preventDefault();
    }
});

// Formateo automático del nombre (capitalizar)
nameInput.addEventListener('blur', function() {
    const words = this.value.toLowerCase().split(' ');
    const capitalizedWords = words.map(word => 
        word.charAt(0).toUpperCase() + word.slice(1)
    );
    this.value = capitalizedWords.join(' ');
    updateSummary();
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