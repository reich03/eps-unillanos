<?php require_once 'views/components/header.php'; ?>

<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <a href="/paciente" class="inline-flex items-center text-eps-blue-600 hover:text-eps-blue-700 transition-colors duration-200 mr-4">
                <span class="mr-2">←</span>
                Volver a Pacientes
            </a>
        </div>
        <div class="flex items-start justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">✏️ Editar Paciente</h2>
                <p class="text-gray-600">Modifique la información del paciente registrado</p>
            </div>
            <div class="text-right">
                <div class="bg-eps-blue-100 rounded-lg px-4 py-2">
                    <p class="text-xs text-eps-blue-600 font-medium">ID del Paciente</p>
                    <p class="text-lg font-bold text-eps-blue-800">
                        #<?= str_pad($this->d['paciente']['id_pac'], 3, '0', STR_PAD_LEFT) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-eps-blue-50 to-indigo-50 rounded-xl p-6 mb-6 border border-eps-blue-200">
        <h3 class="text-lg font-semibold text-eps-blue-900 mb-4 flex items-center">
            <span class="mr-2">👤</span>
            Información Actual
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <p class="text-xs text-eps-blue-600 font-medium uppercase tracking-wide">Nombre Completo</p>
                <p class="text-sm font-semibold text-eps-blue-900">
                    <?= htmlspecialchars($this->d['paciente']['nom_pac'] . ' ' . $this->d['paciente']['ape_pac']) ?>
                </p>
            </div>
            <div>
                <p class="text-xs text-eps-blue-600 font-medium uppercase tracking-wide">Documento</p>
                <p class="text-sm font-semibold text-eps-blue-900">
                    <?= htmlspecialchars($this->d['paciente']['dni_pac']) ?>
                </p>
            </div>
            <div>
                <p class="text-xs text-eps-blue-600 font-medium uppercase tracking-wide">Edad</p>
                <p class="text-sm font-semibold text-eps-blue-900">
                    <?php
                    $fechaNac = new DateTime($this->d['paciente']['fec_pac']);
                    $hoy = new DateTime();
                    $edad = $hoy->diff($fechaNac)->y;
                    echo $edad . ' años';
                    ?>
                </p>
            </div>
            <div>
                <p class="text-xs text-eps-blue-600 font-medium uppercase tracking-wide">Estado</p>
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium <?= $this->d['paciente']['est_pac'] === 'activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                    <span class="mr-1"><?= $this->d['paciente']['est_pac'] === 'activo' ? '✅' : '⏸️' ?></span>
                    <?= ucfirst($this->d['paciente']['est_pac']) ?>
                </span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white">
            <h3 class="text-lg font-semibold">Modificar Información del Paciente</h3>
            <p class="text-orange-100 text-sm">Actualice los campos que necesite modificar</p>
        </div>

        <form action="/paciente/update" method="POST" class="p-6 space-y-6" id="pacienteEditForm">
            <input type="hidden" name="id_pac" value="<?= $this->d['paciente']['id_pac'] ?>">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nom_pac" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">👤</span>
                            Nombre *
                        </span>
                    </label>
                    <input type="text" 
                           id="nom_pac" 
                           name="nom_pac" 
                           value="<?= htmlspecialchars($this->d['paciente']['nom_pac']) ?>"
                           placeholder="Ingrese el nombre" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 text-gray-900"
                           required>
                    <p class="mt-1 text-xs text-gray-500">Nombre completo del paciente</p>
                </div>

                <div>
                    <label for="ape_pac" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">👤</span>
                            Apellido *
                        </span>
                    </label>
                    <input type="text" 
                           id="ape_pac" 
                           name="ape_pac" 
                           value="<?= htmlspecialchars($this->d['paciente']['ape_pac']) ?>"
                           placeholder="Ingrese el apellido" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 text-gray-900"
                           required>
                    <p class="mt-1 text-xs text-gray-500">Apellidos del paciente</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="dni_pac" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">🆔</span>
                            Documento de Identidad *
                        </span>
                    </label>
                    <input type="text" 
                           id="dni_pac" 
                           name="dni_pac" 
                           value="<?= htmlspecialchars($this->d['paciente']['dni_pac']) ?>"
                           placeholder="Número de documento" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 text-gray-900"
                           required>
                    <p class="mt-1 text-xs text-gray-500">DNI, pasaporte o documento oficial</p>
                </div>

                <div>
                    <label for="fec_pac" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">🎂</span>
                            Fecha de Nacimiento *
                        </span>
                    </label>
                    <input type="date" 
                           id="fec_pac" 
                           name="fec_pac" 
                           value="<?= $this->d['paciente']['fec_pac'] ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 text-gray-900"
                           required>
                    <p class="mt-1 text-xs text-gray-500">Fecha de nacimiento del paciente</p>
                    <div id="ageDisplay" class="mt-2 text-sm text-eps-blue-600 font-medium"></div>
                </div>
            </div>

            <div>
                <label for="est_pac" class="block text-sm font-medium text-gray-700 mb-2">
                    <span class="flex items-center">
                        <span class="mr-2">⚡</span>
                        Estado del Paciente
                    </span>
                </label>
                <select id="est_pac" 
                        name="est_pac" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 text-gray-900">
                    <option value="activo" <?= $this->d['paciente']['est_pac'] == 'activo' ? 'selected' : '' ?>>✅ Activo</option>
                    <option value="inactivo" <?= $this->d['paciente']['est_pac'] == 'inactivo' ? 'selected' : '' ?>>⏸️ Inactivo</option>
                </select>
                <p class="mt-1 text-xs text-gray-500">Estado actual del paciente en el sistema</p>
            </div>

            <div class="bg-amber-50 rounded-lg p-4 border-l-4 border-amber-500" id="changesPreview" style="display: none;">
                <h4 class="text-sm font-medium text-amber-900 mb-3 flex items-center">
                    <span class="mr-2">📝</span>
                    Cambios Detectados
                </h4>
                <div id="changesList" class="text-sm text-amber-800 space-y-1"></div>
            </div>

            <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-eps-blue-500">
                <h4 class="text-sm font-medium text-gray-900 mb-3 flex items-center">
                    <span class="mr-2">👁️</span>
                    Vista Previa de los Cambios
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Nombre completo:</span>
                        <span class="ml-2 font-medium text-gray-900" id="preview-nombre"><?= htmlspecialchars($this->d['paciente']['nom_pac'] . ' ' . $this->d['paciente']['ape_pac']) ?></span>
                    </div>
                    <div>
                        <span class="text-gray-600">Documento:</span>
                        <span class="ml-2 font-medium text-gray-900" id="preview-dni"><?= htmlspecialchars($this->d['paciente']['dni_pac']) ?></span>
                    </div>
                    <div>
                        <span class="text-gray-600">Fecha nacimiento:</span>
                        <span class="ml-2 font-medium text-gray-900" id="preview-fecha"><?= date('d/m/Y', strtotime($this->d['paciente']['fec_pac'])) ?></span>
                    </div>
                    <div>
                        <span class="text-gray-600">Estado:</span>
                        <span class="ml-2 font-medium text-gray-900" id="preview-estado"><?= ucfirst($this->d['paciente']['est_pac']) ?></span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                <button type="submit" 
                        class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-xl hover:from-orange-600 hover:to-orange-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <span class="mr-2">💾</span>
                    Actualizar Paciente
                </button>
                
                <button type="button" 
                        onclick="resetForm()"
                        class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-all duration-200">
                    <span class="mr-2">🔄</span>
                    Restaurar Valores
                </button>
                
                <a href="/paciente" 
                   class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-red-100 text-red-700 font-medium rounded-xl hover:bg-red-200 transition-all duration-200">
                    <span class="mr-2">❌</span>
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    <div class="mt-6 bg-yellow-50 rounded-lg p-4 border border-yellow-200">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <span class="text-yellow-500 text-xl">⚠️</span>
            </div>
            <div class="ml-3">
                <h4 class="text-sm font-medium text-yellow-900">Importante al editar:</h4>
                <ul class="mt-2 text-sm text-yellow-800 space-y-1">
                    <li>• Los cambios en el documento pueden afectar registros relacionados</li>
                    <li>• Verifique que los datos sean correctos antes de guardar</li>
                    <li>• Los cambios se aplicarán inmediatamente al confirmar</li>
                    <li>• Mantenga un respaldo de la información importante</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
const originalValues = {
    nom_pac: "<?= htmlspecialchars($this->d['paciente']['nom_pac']) ?>",
    ape_pac: "<?= htmlspecialchars($this->d['paciente']['ape_pac']) ?>",
    dni_pac: "<?= htmlspecialchars($this->d['paciente']['dni_pac']) ?>",
    fec_pac: "<?= $this->d['paciente']['fec_pac'] ?>",
    est_pac: "<?= $this->d['paciente']['est_pac'] ?>"
};

function calculateAge() {
    const birthDate = document.getElementById('fec_pac').value;
    const ageDisplay = document.getElementById('ageDisplay');
    
    if (birthDate) {
        const today = new Date();
        const birth = new Date(birthDate);
        let age = today.getFullYear() - birth.getFullYear();
        const monthDiff = today.getMonth() - birth.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
            age--;
        }
        
        ageDisplay.textContent = `Edad actualizada: ${age} años`;
    }
}

function detectChanges() {
    const currentValues = {
        nom_pac: document.getElementById('nom_pac').value,
        ape_pac: document.getElementById('ape_pac').value,
        dni_pac: document.getElementById('dni_pac').value,
        fec_pac: document.getElementById('fec_pac').value,
        est_pac: document.getElementById('est_pac').value
    };
    
    const changes = [];
    const labels = {
        nom_pac: 'Nombre',
        ape_pac: 'Apellido',
        dni_pac: 'Documento',
        fec_pac: 'Fecha de Nacimiento',
        est_pac: 'Estado'
    };
    
    Object.keys(originalValues).forEach(key => {
        if (originalValues[key] !== currentValues[key]) {
            changes.push(`${labels[key]}: "${originalValues[key]}" → "${currentValues[key]}"`);
        }
    });
    
    const changesPreview = document.getElementById('changesPreview');
    const changesList = document.getElementById('changesList');
    
    if (changes.length > 0) {
        changesList.innerHTML = changes.map(change => `• ${change}`).join('<br>');
        changesPreview.style.display = 'block';
    } else {
        changesPreview.style.display = 'none';
    }
}

function updatePreview() {
    const nombre = document.getElementById('nom_pac').value;
    const apellido = document.getElementById('ape_pac').value;
    const dni = document.getElementById('dni_pac').value;
    const fecha = document.getElementById('fec_pac').value;
    const estado = document.getElementById('est_pac').value;
    
    document.getElementById('preview-nombre').textContent = 
        (nombre && apellido) ? `${nombre} ${apellido}` : '-';
    document.getElementById('preview-dni').textContent = dni || '-';
    document.getElementById('preview-fecha').textContent = 
        fecha ? new Date(fecha).toLocaleDateString('es-ES') : '-';
    document.getElementById('preview-estado').textContent = 
        estado === 'activo' ? 'Activo' : 'Inactivo';
    
    calculateAge();
    detectChanges();
}

function resetForm() {
    if (confirm('¿Está seguro de que desea restaurar los valores originales? Se perderán los cambios realizados.')) {
        Object.keys(originalValues).forEach(key => {
            document.getElementById(key).value = originalValues[key];
        });
        updatePreview();
    }
}

function setupValidation() {
    const dniInput = document.getElementById('dni_pac');
    const nombreInput = document.getElementById('nom_pac');
    const apellidoInput = document.getElementById('ape_pac');
    
    dniInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
        updatePreview();
    });
    
    [nombreInput, apellidoInput].forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
            updatePreview();
        });
    });
}

document.getElementById('fec_pac').addEventListener('change', updatePreview);
document.getElementById('est_pac').addEventListener('change', updatePreview);

['nom_pac', 'ape_pac', 'dni_pac'].forEach(fieldId => {
    document.getElementById(fieldId).addEventListener('input', updatePreview);
});

document.addEventListener('DOMContentLoaded', function() {
    setupValidation();
    calculateAge(); 
    const form = document.querySelector('.bg-white.rounded-xl');
    form.style.opacity = '0';
    form.style.transform = 'translateY(20px)';
    setTimeout(() => {
        form.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
        form.style.opacity = '1';
        form.style.transform = 'translateY(0)';
    }, 100);
});

document.getElementById('pacienteEditForm').addEventListener('submit', function(e) {
    const requiredFields = ['nom_pac', 'ape_pac', 'dni_pac', 'fec_pac'];
    let isValid = true;
    
    requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (!field.value.trim()) {
            field.classList.add('border-red-500');
            isValid = false;
        } else {
            field.classList.remove('border-red-500');
        }
    });
    
    if (!isValid) {
        e.preventDefault();
        alert('Por favor, complete todos los campos obligatorios.');
        return;
    }
    
    const changesPreview = document.getElementById('changesPreview');
    if (changesPreview.style.display !== 'none') {
        if (!confirm('Se han detectado cambios. ¿Está seguro de que desea actualizar la información del paciente?')) {
            e.preventDefault();
        }
    }
});
</script>

<?php require_once 'views/components/footer.php'; ?>