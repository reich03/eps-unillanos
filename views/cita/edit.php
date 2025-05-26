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
                    <span class="ml-1 text-sm font-medium text-gray-500">Editar Cita #<?= str_pad($this->d['cita']['id_cita'], 4, '0', STR_PAD_LEFT) ?></span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="bg-gradient-to-r from-eps-blue-50 to-eps-blue-100 rounded-xl p-6 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">✏️ Editar Cita Médica</h2>
                <p class="text-gray-600">Modifica los detalles de la cita seleccionada</p>
            </div>
            <div class="text-right">
                <div class="text-sm text-gray-500">ID de Cita</div>
                <div class="text-xl font-bold text-eps-blue-600">#<?= str_pad($this->d['cita']['id_cita'], 4, '0', STR_PAD_LEFT) ?></div>
            </div>
        </div>
    </div>

    <!-- Formulario principal -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Información de la Cita</h3>
        </div>

        <form action="/cita/update" method="POST" class="p-6 space-y-6" id="editCitaForm">
            <input type="hidden" name="id_cita" value="<?= $this->d['cita']['id_cita'] ?>">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Selección de Paciente -->
                <div class="space-y-2">
                    <label for="id_pac" class="flex items-center text-sm font-medium text-gray-700">
                        <span class="mr-2">👤</span>
                        Paciente
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <select name="id_pac" id="id_pac" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 bg-white">
                        <option value="">Seleccionar paciente...</option>
                        <?php foreach ($this->d['pacientes'] as $p): ?>
                            <option value="<?= $p['id_pac'] ?>" <?= $p['id_pac'] == $this->d['cita']['id_pac'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Selección de Horario -->
                <div class="space-y-2">
                    <label for="id_horario" class="flex items-center text-sm font-medium text-gray-700">
                        <span class="mr-2">🕒</span>
                        Horario Disponible
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <select name="id_horario" id="id_horario" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 bg-white">
                        <option value="">Seleccionar horario...</option>
                        <?php foreach ($this->d['horarios'] as $h): ?>
                            <option value="<?= $h['id_horario'] ?>" <?= $h['id_horario'] == $this->d['cita']['id_horario'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($h['detalle']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Selección de Consultorio -->
                <div class="space-y-2">
                    <label for="id_con" class="flex items-center text-sm font-medium text-gray-700">
                        <span class="mr-2">🏥</span>
                        Consultorio
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <select name="id_con" id="id_con" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 bg-white">
                        <option value="">Seleccionar consultorio...</option>
                        <?php foreach ($this->d['consultorios'] as $c): ?>
                            <option value="<?= $c['id_con'] ?>" <?= $c['id_con'] == $this->d['cita']['id_con'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($c['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Selección de Servicio -->
                <div class="space-y-2">
                    <label for="id_serv" class="flex items-center text-sm font-medium text-gray-700">
                        <span class="mr-2">🧾</span>
                        Servicio Médico
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <select name="id_serv" id="id_serv" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 bg-white">
                        <option value="">Seleccionar servicio...</option>
                        <?php foreach ($this->d['servicios'] as $s): ?>
                            <option value="<?= $s['id_serv'] ?>" <?= $s['id_serv'] == $this->d['cita']['id_serv'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($s['desc_serv']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Estado de la cita -->
            <div class="space-y-2">
                <label for="est_cita" class="flex items-center text-sm font-medium text-gray-700">
                    <span class="mr-2">📋</span>
                    Estado de la Cita
                </label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <label class="relative">
                        <input type="radio" name="est_cita" value="pendiente" 
                               <?= $this->d['cita']['est_cita'] == 'pendiente' ? 'checked' : '' ?>
                               class="sr-only peer">
                        <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-yellow-500 peer-checked:bg-yellow-50 hover:bg-gray-50 transition-all duration-200">
                            <span class="text-2xl mr-3">⏳</span>
                            <div>
                                <div class="font-medium text-gray-900">Pendiente</div>
                                <div class="text-sm text-gray-500">Cita programada</div>
                            </div>
                        </div>
                    </label>

                    <label class="relative">
                        <input type="radio" name="est_cita" value="completada" 
                               <?= $this->d['cita']['est_cita'] == 'completada' ? 'checked' : '' ?>
                               class="sr-only peer">
                        <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-green-500 peer-checked:bg-green-50 hover:bg-gray-50 transition-all duration-200">
                            <span class="text-2xl mr-3">✅</span>
                            <div>
                                <div class="font-medium text-gray-900">Completada</div>
                                <div class="text-sm text-gray-500">Cita realizada</div>
                            </div>
                        </div>
                    </label>

                    <label class="relative">
                        <input type="radio" name="est_cita" value="cancelada" 
                               <?= $this->d['cita']['est_cita'] == 'cancelada' ? 'checked' : '' ?>
                               class="sr-only peer">
                        <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-red-500 peer-checked:bg-red-50 hover:bg-gray-50 transition-all duration-200">
                            <span class="text-2xl mr-3">❌</span>
                            <div>
                                <div class="font-medium text-gray-900">Cancelada</div>
                                <div class="text-sm text-gray-500">Cita cancelada</div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                <button type="submit" 
                        class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-eps-blue-600 to-eps-blue-700 text-white font-semibold rounded-xl hover:from-eps-blue-700 hover:to-eps-blue-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <span class="mr-2">💾</span>
                    Actualizar Cita
                </button>
                
                <a href="/cita" 
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
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4">
        <div class="flex items-start">
            <span class="text-blue-500 text-xl mr-3">💡</span>
            <div>
                <h4 class="text-sm font-semibold text-blue-800">Información importante</h4>
                <ul class="text-sm text-blue-700 mt-1 space-y-1">
                    <li>• Los cambios se guardarán inmediatamente al confirmar</li>
                    <li>• Verifica que el horario seleccionado esté disponible</li>
                    <li>• El consultorio debe corresponder a la especialidad del médico</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
// Función para confirmar eliminación
function confirmDelete() {
    if (confirm('¿Estás seguro de que deseas eliminar esta cita? Esta acción no se puede deshacer.')) {
        window.location.href = '/cita/delete/<?= $this->d['cita']['id_cita'] ?>';
    }
}

// Validación del formulario
document.getElementById('editCitaForm').addEventListener('submit', function(e) {
    const requiredFields = ['id_pac', 'id_horario', 'id_con', 'id_serv'];
    let isValid = true;
    
    requiredFields.forEach(field => {
        const element = document.getElementById(field);
        if (!element.value) {
            isValid = false;
            element.classList.add('border-red-500');
            element.focus();
        } else {
            element.classList.remove('border-red-500');
        }
    });
    
    if (!isValid) {
        e.preventDefault();
        alert('Por favor, completa todos los campos obligatorios.');
    }
});

// Animaciones de entrada
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.bg-white.rounded-xl');
    form.style.opacity = '0';
    form.style.transform = 'translateY(20px)';
    setTimeout(() => {
        form.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
        form.style.opacity = '1';
        form.style.transform = 'translateY(0)';
    }, 100);
});
</script>

<?php require_once 'views/components/footer.php'; ?>