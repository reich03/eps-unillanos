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
                    <span class="ml-1 text-sm font-medium text-gray-500">Editar Horario #<?= str_pad($this->d['horario']['id_horario'], 3, '0', STR_PAD_LEFT) ?></span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="bg-gradient-to-r from-eps-blue-50 to-eps-blue-100 rounded-xl p-6 mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-gradient-to-r from-eps-blue-500 to-eps-blue-600 rounded-full flex items-center justify-center mr-4">
                    <span class="text-white text-2xl">🕒</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">✏️ Editar Horario de Atención</h2>
                    <p class="text-gray-600">
                        <?php
                        $fecha = new DateTime($this->d['horario']['fecha']);
                        $hora = new DateTime($this->d['horario']['hora']);
                        echo $fecha->format('d/m/Y') . ' a las ' . $hora->format('H:i');
                        ?>
                    </p>
                </div>
            </div>
            <div class="text-right">
                <div class="text-sm text-gray-500">ID Horario</div>
                <div class="text-xl font-bold text-eps-blue-600">#<?= str_pad($this->d['horario']['id_horario'], 3, '0', STR_PAD_LEFT) ?></div>
            </div>
        </div>
    </div>

    <!-- Estado actual del horario -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">📊 Estado Actual</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="flex items-center">
                <span class="text-2xl mr-3">👨‍⚕️</span>
                <div>
                    <div class="text-sm text-gray-500">Médico</div>
                    <div class="font-medium">
                        Dr. <?php 
                        $currentMedico = array_filter($this->d['medicos'], fn($m) => $m['id_med'] == $this->d['horario']['id_med']);
                        echo htmlspecialchars(reset($currentMedico)['nom_med'] ?? 'No especificado');
                        ?>
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-2xl mr-3">📅</span>
                <div>
                    <div class="text-sm text-gray-500">Fecha</div>
                    <div class="font-medium">
                        <?php
                        $fecha = new DateTime($this->d['horario']['fecha']);
                        echo $fecha->format('d/m/Y');
                        ?>
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-2xl mr-3">🕐</span>
                <div>
                    <div class="text-sm text-gray-500">Hora</div>
                    <div class="font-medium">
                        <?php
                        $hora = new DateTime($this->d['horario']['hora']);
                        echo $hora->format('H:i');
                        ?>
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-2xl mr-3">
                    <?= $this->d['horario']['est_horario'] === 'disponible' ? '✅' : '🔒' ?>
                </span>
                <div>
                    <div class="text-sm text-gray-500">Estado</div>
                    <div class="font-medium <?= $this->d['horario']['est_horario'] === 'disponible' ? 'text-green-600' : 'text-red-600' ?>">
                        <?= ucfirst($this->d['horario']['est_horario']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario principal -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-eps-blue-500 to-eps-blue-600 text-white">
            <h3 class="text-lg font-semibold">Actualizar Información del Horario</h3>
            <p class="text-eps-blue-100 text-sm">Modifica los datos según sea necesario</p>
        </div>

        <form action="/horario/update" method="POST" class="p-6 space-y-6" id="editHorarioForm">
            <input type="hidden" name="id_horario" value="<?= $this->d['horario']['id_horario'] ?>">

            <!-- Información básica -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Médico -->
                <div class="space-y-2">
                    <label for="id_med" class="flex items-center text-sm font-medium text-gray-700">
                        <span class="mr-2">👨‍⚕️</span>
                        Médico Asignado
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <select name="id_med" 
                            id="id_med" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                        <?php foreach ($this->d['medicos'] as $m): ?>
                            <option value="<?= $m['id_med'] ?>" <?= $m['id_med'] == $this->d['horario']['id_med'] ? 'selected' : '' ?>>
                                Dr. <?= htmlspecialchars($m['nom_med']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="text-xs text-gray-500">Médico responsable de este horario</p>
                </div>

                <!-- Estado del horario -->
                <div class="space-y-2">
                    <label class="flex items-center text-sm font-medium text-gray-700">
                        <span class="mr-2">📋</span>
                        Estado del Horario
                    </label>
                    <div class="grid grid-cols-1 gap-2">
                        <label class="relative">
                            <input type="radio" name="est_horario" value="disponible" 
                                   <?= $this->d['horario']['est_horario'] == 'disponible' ? 'checked' : '' ?>
                                   class="sr-only peer">
                            <div class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-green-500 peer-checked:bg-green-50 hover:bg-gray-50 transition-all duration-200">
                                <span class="text-xl mr-3">✅</span>
                                <div>
                                    <div class="font-medium text-gray-900">Disponible</div>
                                    <div class="text-sm text-gray-500">El horario está libre para citas</div>
                                </div>
                            </div>
                        </label>

                        <label class="relative">
                            <input type="radio" name="est_horario" value="ocupado" 
                                   <?= $this->d['horario']['est_horario'] == 'ocupado' ? 'checked' : '' ?>
                                   class="sr-only peer">
                            <div class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-red-500 peer-checked:bg-red-50 hover:bg-gray-50 transition-all duration-200">
                                <span class="text-xl mr-3">🔒</span>
                                <div>
                                    <div class="font-medium text-gray-900">Ocupado</div>
                                    <div class="text-sm text-gray-500">El horario ya tiene una cita asignada</div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Fecha y hora -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="fecha" class="flex items-center text-sm font-medium text-gray-700">
                        <span class="mr-2">📅</span>
                        Fecha de Atención
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="date" 
                           name="fecha" 
                           id="fecha" 
                           value="<?= $this->d['horario']['fecha'] ?>"
                           min="<?= date('Y-m-d') ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                    <p class="text-xs text-gray-500">Fecha en que el médico estará disponible</p>
                </div>

                <div class="space-y-2">
                    <label for="hora" class="flex items-center text-sm font-medium text-gray-700">
                        <span class="mr-2">🕐</span>
                        Hora de Atención
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="time" 
                           name="hora" 
                           id="hora" 
                           value="<?= $this->d['horario']['hora'] ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                    <p class="text-xs text-gray-500">Hora exacta de inicio de la consulta</p>
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

            <!-- Resumen de cambios -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6" id="changesSummary">
                <h4 class="text-lg font-semibold text-blue-900 mb-4">📋 Resumen de Cambios</h4>
                <div class="text-sm text-blue-700" id="changesContent">
                    Los cambios aparecerán aquí cuando modifiques algún campo.
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                <button type="submit" 
                        class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-eps-blue-600 to-eps-blue-700 text-white font-semibold rounded-xl hover:from-eps-blue-700 hover:to-eps-blue-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <span class="mr-2">💾</span>
                    Actualizar Horario
                </button>
                
                <a href="/horario" 
                   class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-200 border border-gray-300">
                    <span class="mr-2">↩️</span>
                    Cancelar
                </a>
                
                <button type="button" onclick="confirmDelete()" 
                        class="inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <span class="mr-2">🗑️</span>
                    Eliminar
                </button>
            </div>
        </form>
    </div>

    <!-- Información adicional -->
    <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-xl p-4">
        <div class="flex items-start">
            <span class="text-yellow-600 text-xl mr-3">⚠️</span>
            <div>
                <h4 class="text-sm font-semibold text-yellow-800">Información importante</h4>
                <ul class="text-sm text-yellow-700 mt-1 space-y-1">
                    <li>• Los cambios se guardarán inmediatamente al confirmar</li>
                    <li>• Si cambias el estado a "Ocupado", no estará disponible para nuevas citas</li>
                    <li>• Verificar que no haya conflictos con otros horarios del mismo médico</li>
                    <li>• La eliminación del horario es permanente y no se puede deshacer</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
// Datos originales para detectar cambios
const originalData = {
    id_med: "<?= $this->d['horario']['id_med'] ?>",
    fecha: "<?= $this->d['horario']['fecha'] ?>",
    hora: "<?= $this->d['horario']['hora'] ?>",
    est_horario: "<?= $this->d['horario']['est_horario'] ?>"
};

// Función para establecer hora rápida
function setTime(time) {
    document.getElementById('hora').value = time;
    detectChanges();
}

// Función para confirmar eliminación
function confirmDelete() {
    const fecha = new Date("<?= $this->d['horario']['fecha'] ?>");
    const hora = "<?= $this->d['horario']['hora'] ?>";
    const fechaStr = fecha.toLocaleDateString('es-ES');
    
    if (confirm(`¿Estás seguro de que deseas eliminar el horario del ${fechaStr} a las ${hora}? Esta acción no se puede deshacer.`)) {
        window.location.href = '/horario/delete/<?= $this->d['horario']['id_horario'] ?>';
    }
}

// Función para detectar y mostrar cambios
function detectChanges() {
    const form = document.getElementById('editHorarioForm');
    const formData = new FormData(form);
    const changes = [];
    
    // Comparar cada campo
    if (formData.get('id_med') !== originalData.id_med) {
        const medicoSelect = document.getElementById('id_med');
        const newMedico = medicoSelect.options[medicoSelect.selectedIndex].text;
        changes.push(`Médico: Cambió a "${newMedico}"`);
    }
    
    if (formData.get('fecha') !== originalData.fecha) {
        const newFecha = new Date(formData.get('fecha') + 'T00:00:00');
        const oldFecha = new Date(originalData.fecha + 'T00:00:00');
        changes.push(`Fecha: "${oldFecha.toLocaleDateString('es-ES')}" → "${newFecha.toLocaleDateString('es-ES')}"`);
    }
    
    if (formData.get('hora') !== originalData.hora) {
        const newHora = new Date('2000-01-01T' + formData.get('hora'));
        const oldHora = new Date('2000-01-01T' + originalData.hora);
        changes.push(`Hora: "${oldHora.toLocaleTimeString('es-ES', {hour: '2-digit', minute: '2-digit'})}" → "${newHora.toLocaleTimeString('es-ES', {hour: '2-digit', minute: '2-digit'})}"`);
    }
    
    if (formData.get('est_horario') !== originalData.est_horario) {
        const newStatus = formData.get('est_horario') === 'disponible' ? 'Disponible' : 'Ocupado';
        const oldStatus = originalData.est_horario === 'disponible' ? 'Disponible' : 'Ocupado';
        changes.push(`Estado: "${oldStatus}" → "${newStatus}"`);
    }
    
    // Mostrar cambios
    const changesContent = document.getElementById('changesContent');
    const changesSummary = document.getElementById('changesSummary');
    
    if (changes.length > 0) {
        changesContent.innerHTML = '<ul class="list-disc list-inside space-y-1">' + 
            changes.map(change => `<li>${change}</li>`).join('') + 
            '</ul>';
        changesSummary.classList.remove('hidden');
    } else {
        changesContent.textContent = 'Los cambios aparecerán aquí cuando modifiques algún campo.';
    }
}

// Event listeners para detectar cambios
document.getElementById('id_med').addEventListener('change', detectChanges);
document.getElementById('fecha').addEventListener('change', detectChanges);
document.getElementById('hora').addEventListener('change', detectChanges);
document.querySelectorAll('input[name="est_horario"]').forEach(radio => {
    radio.addEventListener('change', detectChanges);
});

// Validación del formulario
document.getElementById('editHorarioForm').addEventListener('submit', function(e) {
    const fecha = document.getElementById('fecha');
    const hora = document.getElementById('hora');
    const medico = document.getElementById('id_med');
    
    // Validar campos requeridos
    if (!medico.value) {
        e.preventDefault();
        alert('Debe seleccionar un médico.');
        medico.classList.add('border-red-500');
        medico.focus();
        return;
    }
    
    if (!fecha.value) {
        e.preventDefault();
        alert('La fecha es obligatoria.');
        fecha.classList.add('border-red-500');
        fecha.focus();
        return;
    }
    
    if (!hora.value) {
        e.preventDefault();
        alert('La hora es obligatoria.');
        hora.classList.add('border-red-500');
        hora.focus();
        return;
    }
    
    // Validar que la fecha no sea pasada (solo si se cambió)
    const selectedDate = new Date(fecha.value);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    if (selectedDate < today && fecha.value !== originalData.fecha) {
        e.preventDefault();
        alert('No se pueden programar horarios para fechas pasadas.');
        fecha.classList.add('border-red-500');
        fecha.focus();
        return;
    }
    
    // Verificar horarios laborales
    const selectedTime = hora.value;
    if (selectedTime < '07:00' || selectedTime > '18:00') {
        if (!confirm('El horario seleccionado está fuera del horario laboral normal (7:00 AM - 6:00 PM). ¿Deseas continuar?')) {
            e.preventDefault();
            return;
        }
    }
    
    // Confirmación de cambios
    const formData = new FormData(this);
    let hasChanges = false;
    
    for (let [key, value] of formData.entries()) {
        if (originalData[key] !== undefined && originalData[key] !== value) {
            hasChanges = true;
            break;
        }
    }
    
    if (hasChanges) {
        if (!confirm('¿Confirmas que deseas guardar los cambios realizados?')) {
            e.preventDefault();
        }
    } else {
        alert('No se han realizado cambios.');
        e.preventDefault();
    }
    
    // Limpiar clases de error
    medico.classList.remove('border-red-500');
    fecha.classList.remove('border-red-500');
    hora.classList.remove('border-red-500');
});

// Animaciones de entrada
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.bg-white.rounded-xl');
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

// Inicializar
detectChanges();
</script>

<?php require_once 'views/components/footer.php'; ?>