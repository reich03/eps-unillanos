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
                    <span class="ml-1 text-sm font-medium text-gray-500">Editar Dr. <?= htmlspecialchars($this->d['medico']['nom_med']) ?></span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="bg-gradient-to-r from-eps-blue-50 to-eps-blue-100 rounded-xl p-6 mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-gradient-to-r from-eps-blue-500 to-eps-blue-600 rounded-full flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-xl">
                        <?= strtoupper(substr($this->d['medico']['nom_med'], 0, 2)) ?>
                    </span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">✏️ Editar Información Médica</h2>
                    <p class="text-gray-600">Dr. <?= htmlspecialchars($this->d['medico']['nom_med']) ?></p>
                </div>
            </div>
            <div class="text-right">
                <div class="text-sm text-gray-500">ID Médico</div>
                <div class="text-xl font-bold text-eps-blue-600">#<?= str_pad($this->d['medico']['id_med'], 3, '0', STR_PAD_LEFT) ?></div>
            </div>
        </div>
    </div>

    <!-- Estado actual del médico -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">📊 Estado Actual</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="flex items-center">
                <span class="text-2xl mr-3">👨‍⚕️</span>
                <div>
                    <div class="text-sm text-gray-500">Médico</div>
                    <div class="font-medium">Dr. <?= htmlspecialchars($this->d['medico']['nom_med']) ?></div>
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-2xl mr-3">⚕️</span>
                <div>
                    <div class="text-sm text-gray-500">Especialidad</div>
                    <div class="font-medium">
                        <?php 
                        $currentSpecialty = array_filter($this->d['especialidades'], fn($e) => $e['id_esp'] == $this->d['medico']['id_esp']);
                        echo htmlspecialchars(reset($currentSpecialty)['nom_esp'] ?? 'No especificado');
                        ?>
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-2xl mr-3">
                    <?= $this->d['medico']['est_med'] === 'activo' ? '✅' : '⏸️' ?>
                </span>
                <div>
                    <div class="text-sm text-gray-500">Estado</div>
                    <div class="font-medium <?= $this->d['medico']['est_med'] === 'activo' ? 'text-green-600' : 'text-red-600' ?>">
                        <?= ucfirst($this->d['medico']['est_med']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario principal -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-eps-blue-500 to-eps-blue-600 text-white">
            <h3 class="text-lg font-semibold">Actualizar Información del Médico</h3>
            <p class="text-eps-blue-100 text-sm">Modifica los datos según sea necesario</p>
        </div>

        <form action="/medico/update" method="POST" class="p-6 space-y-6" id="editMedicoForm">
            <input type="hidden" name="id_med" value="<?= $this->d['medico']['id_med'] ?>">

            <!-- Información básica -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombre del médico -->
                <div class="space-y-2">
                    <label for="nom_med" class="flex items-center text-sm font-medium text-gray-700">
                        <span class="mr-2">👨‍⚕️</span>
                        Nombre Completo
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" 
                           name="nom_med" 
                           id="nom_med" 
                           value="<?= htmlspecialchars($this->d['medico']['nom_med']) ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                    <p class="text-xs text-gray-500">Nombre completo sin el título "Dr."</p>
                </div>

                <!-- Especialidad -->
                <div class="space-y-2">
                    <label for="id_esp" class="flex items-center text-sm font-medium text-gray-700">
                        <span class="mr-2">⚕️</span>
                        Especialidad Médica
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <select name="id_esp" 
                            id="id_esp" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                        <?php foreach ($this->d['especialidades'] as $e): ?>
                            <option value="<?= $e['id_esp'] ?>" <?= $e['id_esp'] == $this->d['medico']['id_esp'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($e['nom_esp']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="text-xs text-gray-500">Área de especialización del médico</p>
                </div>
            </div>

            <!-- Información de contacto -->
            <div class="space-y-2">
                <label for="contacto_med" class="flex items-center text-sm font-medium text-gray-700">
                    <span class="mr-2">📞</span>
                    Información de Contacto
                </label>
                <input type="text" 
                       name="contacto_med" 
                       id="contacto_med" 
                       value="<?= htmlspecialchars($this->d['medico']['contacto_med']) ?>"
                       placeholder="Teléfono, email u otra forma de contacto"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                <p class="text-xs text-gray-500">Información de contacto del médico (opcional)</p>
            </div>

            <!-- Estado del médico -->
            <div class="space-y-2">
                <label class="flex items-center text-sm font-medium text-gray-700 mb-4">
                    <span class="mr-2">📋</span>
                    Estado del Médico
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="relative">
                        <input type="radio" name="est_med" value="activo" 
                               <?= $this->d['medico']['est_med'] == 'activo' ? 'checked' : '' ?>
                               class="sr-only peer">
                        <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-green-500 peer-checked:bg-green-50 hover:bg-gray-50 transition-all duration-200">
                            <span class="text-2xl mr-3">✅</span>
                            <div>
                                <div class="font-medium text-gray-900">Activo</div>
                                <div class="text-sm text-gray-500">El médico está disponible para consultas</div>
                            </div>
                        </div>
                    </label>

                    <label class="relative">
                        <input type="radio" name="est_med" value="inactivo" 
                               <?= $this->d['medico']['est_med'] == 'inactivo' ? 'checked' : '' ?>
                               class="sr-only peer">
                        <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-red-500 peer-checked:bg-red-50 hover:bg-gray-50 transition-all duration-200">
                            <span class="text-2xl mr-3">⏸️</span>
                            <div>
                                <div class="font-medium text-gray-900">Inactivo</div>
                                <div class="text-sm text-gray-500">El médico no está disponible temporalmente</div>
                            </div>
                        </div>
                    </label>
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
                    Actualizar Información
                </button>
                
                <a href="/medico" 
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
                    <li>• Cambiar el estado a "Inactivo" afectará la disponibilidad para nuevas citas</li>
                    <li>• Verificar que los datos de contacto sean correctos</li>
                    <li>• La eliminación del médico es permanente y no se puede deshacer</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
// Datos originales para detectar cambios
const originalData = {
    nom_med: "<?= htmlspecialchars($this->d['medico']['nom_med']) ?>",
    id_esp: "<?= $this->d['medico']['id_esp'] ?>",
    contacto_med: "<?= htmlspecialchars($this->d['medico']['contacto_med']) ?>",
    est_med: "<?= $this->d['medico']['est_med'] ?>"
};

// Función para confirmar eliminación
function confirmDelete() {
    if (confirm(`¿Estás seguro de que deseas eliminar al Dr. <?= htmlspecialchars($this->d['medico']['nom_med']) ?>? Esta acción no se puede deshacer.`)) {
        window.location.href = '/medico/delete/<?= $this->d['medico']['id_med'] ?>';
    }
}

// Función para detectar y mostrar cambios
function detectChanges() {
    const form = document.getElementById('editMedicoForm');
    const formData = new FormData(form);
    const changes = [];
    
    // Comparar cada campo
    if (formData.get('nom_med') !== originalData.nom_med) {
        changes.push(`Nombre: "${originalData.nom_med}" → "Dr. ${formData.get('nom_med')}"`);
    }
    
    if (formData.get('id_esp') !== originalData.id_esp) {
        const specialtySelect = document.getElementById('id_esp');
        const newSpecialty = specialtySelect.options[specialtySelect.selectedIndex].text;
        changes.push(`Especialidad: Cambió a "${newSpecialty}"`);
    }
    
    if (formData.get('contacto_med') !== originalData.contacto_med) {
        const newContact = formData.get('contacto_med') || 'No especificado';
        changes.push(`Contacto: "${originalData.contacto_med || 'No especificado'}" → "${newContact}"`);
    }
    
    if (formData.get('est_med') !== originalData.est_med) {
        const newStatus = formData.get('est_med') === 'activo' ? 'Activo' : 'Inactivo';
        const oldStatus = originalData.est_med === 'activo' ? 'Activo' : 'Inactivo';
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
document.getElementById('nom_med').addEventListener('input', detectChanges);
document.getElementById('id_esp').addEventListener('change', detectChanges);
document.getElementById('contacto_med').addEventListener('input', detectChanges);
document.querySelectorAll('input[name="est_med"]').forEach(radio => {
    radio.addEventListener('change', detectChanges);
});

// Validación del formulario
document.getElementById('editMedicoForm').addEventListener('submit', function(e) {
    const nomMed = document.getElementById('nom_med');
    const idEsp = document.getElementById('id_esp');
    
    // Validar campos requeridos
    if (!nomMed.value.trim()) {
        e.preventDefault();
        alert('El nombre del médico es obligatorio.');
        nomMed.classList.add('border-red-500');
        nomMed.focus();
        return;
    }
    
    if (!idEsp.value) {
        e.preventDefault();
        alert('Debe seleccionar una especialidad.');
        idEsp.classList.add('border-red-500');
        idEsp.focus();
        return;
    }
    
    // Validar longitud del nombre
    if (nomMed.value.trim().length < 3) {
        e.preventDefault();
        alert('El nombre del médico debe tener al menos 3 caracteres.');
        nomMed.classList.add('border-red-500');
        nomMed.focus();
        return;
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
    }
    
    // Limpiar clases de error
    nomMed.classList.remove('border-red-500');
    idEsp.classList.remove('border-red-500');
});

// Formateo automático del nombre
document.getElementById('nom_med').addEventListener('blur', function() {
    const words = this.value.toLowerCase().split(' ');
    const capitalizedWords = words.map(word => 
        word.charAt(0).toUpperCase() + word.slice(1)
    );
    this.value = capitalizedWords.join(' ');
    detectChanges();
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
