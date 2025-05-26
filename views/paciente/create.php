<?php require_once 'views/components/header.php'; ?>

<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <a href="/paciente" class="inline-flex items-center text-eps-blue-600 hover:text-eps-blue-700 transition-colors duration-200 mr-4">
                <span class="mr-2">←</span>
                Volver a Pacientes
            </a>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">👤 Registrar Nuevo Paciente</h2>
            <p class="text-gray-600">Complete la información del paciente para su registro en el sistema</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-eps-blue-500 to-eps-blue-600 text-white">
            <h3 class="text-lg font-semibold">Información del Paciente</h3>
            <p class="text-eps-blue-100 text-sm">Todos los campos marcados con * son obligatorios</p>
        </div>

        <form action="/paciente/store" method="POST" class="p-6 space-y-6" id="pacienteForm">
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
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 text-gray-900"
                        required>
                    <p class="mt-1 text-xs text-gray-500">Fecha de nacimiento del paciente</p>
                    <div id="ageDisplay" class="mt-2 text-sm text-eps-blue-600 font-medium hidden"></div>
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
                    <option value="activo" selected>✅ Activo</option>
                    <option value="inactivo">⏸️ Inactivo</option>
                </select>
                <p class="mt-1 text-xs text-gray-500">Estado actual del paciente en el sistema</p>
            </div>

            <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-eps-blue-500">
                <h4 class="text-sm font-medium text-gray-900 mb-3 flex items-center">
                    <span class="mr-2">👁️</span>
                    Vista Previa del Registro
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Nombre completo:</span>
                        <span class="ml-2 font-medium text-gray-900" id="preview-nombre">-</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Documento:</span>
                        <span class="ml-2 font-medium text-gray-900" id="preview-dni">-</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Fecha nacimiento:</span>
                        <span class="ml-2 font-medium text-gray-900" id="preview-fecha">-</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Estado:</span>
                        <span class="ml-2 font-medium text-gray-900" id="preview-estado">Activo</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                <button type="submit"
                    class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <span class="mr-2">💾</span>
                    Guardar Paciente
                </button>

                <button type="button"
                    onclick="resetForm()"
                    class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-all duration-200">
                    <span class="mr-2">🔄</span>
                    Limpiar Formulario
                </button>

                <a href="/paciente"
                    class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-red-100 text-red-700 font-medium rounded-xl hover:bg-red-200 transition-all duration-200">
                    <span class="mr-2">❌</span>
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    <div class="mt-6 bg-blue-50 rounded-lg p-4 border border-blue-200">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <span class="text-blue-500 text-xl">💡</span>
            </div>
            <div class="ml-3">
                <h4 class="text-sm font-medium text-blue-900">Información importante:</h4>
                <ul class="mt-2 text-sm text-blue-800 space-y-1">
                    <li>• Asegúrese de que el documento de identidad sea único en el sistema</li>
                    <li>• La fecha de nacimiento se utilizará para calcular la edad automáticamente</li>
                    <li>• Los pacientes inactivos no aparecerán en las búsquedas principales</li>
                    <li>• Todos los datos pueden ser modificados posteriormente</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
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

            ageDisplay.textContent = `Edad: ${age} años`;
            ageDisplay.classList.remove('hidden');

            updatePreview();
        } else {
            ageDisplay.classList.add('hidden');
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
    }

    function resetForm() {
        if (confirm('¿Está seguro de que desea limpiar el formulario? Se perderán todos los datos ingresados.')) {
            document.getElementById('pacienteForm').reset();
            document.getElementById('ageDisplay').classList.add('hidden');
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

    document.getElementById('fec_pac').addEventListener('change', calculateAge);
    document.getElementById('est_pac').addEventListener('change', updatePreview);

    document.addEventListener('DOMContentLoaded', function() {
        setupValidation();

        const form = document.querySelector('.bg-white.rounded-xl');
        form.style.opacity = '0';
        form.style.transform = 'translateY(20px)';
        setTimeout(() => {
            form.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
            form.style.opacity = '1';
            form.style.transform = 'translateY(0)';
        }, 100);
    });

    document.getElementById('pacienteForm').addEventListener('submit', function(e) {
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
        }
    });
</script>

<?php require_once 'views/components/footer.php'; ?>