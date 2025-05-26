<?php require_once 'views/components/header.php'; ?>

<div class="max-w-4xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">✏️ Editar Consultorio</h2>
            <p class="text-gray-600">Modifica la información del Consultorio <?= htmlspecialchars($this->d['consultorio']['nro_con']) ?></p>
        </div>
        <div class="flex gap-3">
            <a href="/consultorio" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-all duration-200">
                <span class="mr-2">←</span>
                Volver al listado
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border-l-4 border-blue-500">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <span class="mr-2">🏥</span>
            Información Actual del Consultorio
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-50 rounded-lg p-4">
                <h5 class="text-sm font-medium text-blue-900 mb-1">Número</h5>
                <p class="text-lg font-bold text-blue-700"><?= htmlspecialchars($this->d['consultorio']['nro_con']) ?></p>
            </div>
            <div class="bg-purple-50 rounded-lg p-4">
                <h5 class="text-sm font-medium text-purple-900 mb-1">Especialidad</h5>
                <p class="text-lg font-bold text-purple-700">
                    <?php
                    foreach ($this->d['especialidades'] as $e) {
                        if ($e['id_esp'] == $this->d['consultorio']['id_esp']) {
                            echo htmlspecialchars($e['nom_esp']);
                            break;
                        }
                    }
                    ?>
                </p>
            </div>
            <div class="bg-green-50 rounded-lg p-4">
                <h5 class="text-sm font-medium text-green-900 mb-1">Ubicación</h5>
                <p class="text-lg font-bold text-green-700"><?= htmlspecialchars($this->d['consultorio']['ubicacion']) ?></p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-medium text-orange-600">Editando consultorio</span>
            <span class="text-sm text-gray-500">Actualización de datos</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 h-2 rounded-full w-full"></div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-orange-50 to-yellow-50">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <span class="mr-2">📝</span>
                Modificar Información
            </h3>
            <p class="text-sm text-gray-600 mt-1">Actualice los campos que desea modificar</p>
        </div>

        <form action="/consultorio/update" method="POST" class="p-6" id="editConsultorioForm">
            <input type="hidden" name="id_con" value="<?= $this->d['consultorio']['id_con'] ?>">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-1">
                    <label for="nro_con" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">🏠</span>
                            Número del Consultorio
                            <span class="text-red-500 ml-1">*</span>
                        </span>
                    </label>
                    <div class="relative">
                        <input type="text"
                            id="nro_con"
                            name="nro_con"
                            value="<?= htmlspecialchars($this->d['consultorio']['nro_con']) ?>"
                            placeholder="Ej: 101, A-15, B2..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 pl-12"
                            required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 text-lg">🏷️</span>
                        </div>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Identificador único del consultorio</p>
                </div>

                <div class="md:col-span-1">
                    <label for="id_esp" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">⚕️</span>
                            Especialidad Médica
                            <span class="text-red-500 ml-1">*</span>
                        </span>
                    </label>
                    <div class="relative">
                        <select id="id_esp"
                            name="id_esp"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 pl-12 appearance-none bg-white"
                            required>
                            <?php foreach ($this->d['especialidades'] as $e): ?>
                                <option value="<?= $e['id_esp'] ?>" <?= $e['id_esp'] == $this->d['consultorio']['id_esp'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($e['nom_esp']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 text-lg">🩺</span>
                        </div>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Área médica que se atenderá en este consultorio</p>
                </div>

                <div class="md:col-span-2">
                    <label for="ubicacion" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">📍</span>
                            Ubicación Física
                            <span class="text-red-500 ml-1">*</span>
                        </span>
                    </label>
                    <div class="relative">
                        <input type="text"
                            id="ubicacion"
                            name="ubicacion"
                            value="<?= htmlspecialchars($this->d['consultorio']['ubicacion']) ?>"
                            placeholder="Ej: Piso 2, Ala Norte, Sector A..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 pl-12"
                            required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 text-lg">🗺️</span>
                        </div>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Descripción detallada de dónde se encuentra el consultorio</p>
                </div>
            </div>

            <div class="mt-8 p-4 bg-yellow-50 rounded-lg border border-yellow-200" id="changesAlert" style="display: none;">
                <h4 class="text-sm font-medium text-yellow-900 mb-2 flex items-center">
                    <span class="mr-2">⚠️</span>
                    Cambios detectados
                </h4>
                <div id="changesList" class="text-sm text-yellow-800"></div>
            </div>

            <div class="mt-8 p-4 bg-orange-50 rounded-lg border border-orange-200">
                <h4 class="text-sm font-medium text-orange-900 mb-2 flex items-center">
                    <span class="mr-2">💡</span>
                    Importante
                </h4>
                <ul class="text-sm text-orange-800 space-y-1">
                    <li>• Los cambios se aplicarán inmediatamente</li>
                    <li>• El historial de citas previas se mantendrá intacto</li>
                    <li>• Verifique que la nueva información sea correcta</li>
                </ul>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 justify-end mt-8 pt-6 border-t border-gray-200">
                <a href="/consultorio"
                    class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-all duration-200 order-2 sm:order-1">
                    <span class="mr-2">✖️</span>
                    Cancelar
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-xl hover:from-orange-600 hover:to-orange-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl order-1 sm:order-2"
                    id="updateBtn">
                    <span class="mr-2">💾</span>
                    <span id="updateText">Actualizar Consultorio</span>
                </button>
            </div>
        </form>
    </div>

    <div class="mt-6 bg-white rounded-xl shadow-lg p-6" id="previewCard">
        <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <span class="mr-2">👀</span>
            Vista previa de los cambios
        </h4>
        <div class="bg-gray-50 rounded-lg p-4 border">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-lg" id="previewNumber"><?= htmlspecialchars($this->d['consultorio']['nro_con']) ?></span>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-900" id="previewTitle">Consultorio <?= htmlspecialchars($this->d['consultorio']['nro_con']) ?></div>
                    <div class="text-sm text-gray-500" id="previewLocation"><?= htmlspecialchars($this->d['consultorio']['ubicacion']) ?></div>
                </div>
                <div class="ml-auto">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800" id="previewSpecialty">
                        <span class="mr-1">⚕️</span>
                        <?php
                        foreach ($this->d['especialidades'] as $e) {
                            if ($e['id_esp'] == $this->d['consultorio']['id_esp']) {
                                echo htmlspecialchars($e['nom_esp']);
                                break;
                            }
                        }
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('editConsultorioForm');
        const updateBtn = document.getElementById('updateBtn');
        const updateText = document.getElementById('updateText');
        const changesAlert = document.getElementById('changesAlert');
        const changesList = document.getElementById('changesList');

        const nroConInput = document.getElementById('nro_con');
        const especialidadSelect = document.getElementById('id_esp');
        const ubicacionInput = document.getElementById('ubicacion');

        const previewNumber = document.getElementById('previewNumber');
        const previewTitle = document.getElementById('previewTitle');
        const previewLocation = document.getElementById('previewLocation');
        const previewSpecialty = document.getElementById('previewSpecialty');

        const originalValues = {
            numero: '<?= htmlspecialchars($this->d['consultorio']['nro_con']) ?>',
            especialidad: '<?= $this->d['consultorio']['id_esp'] ?>',
            ubicacion: '<?= htmlspecialchars($this->d['consultorio']['ubicacion']) ?>'
        };

        function updatePreviewAndDetectChanges() {
            const numero = nroConInput.value;
            const especialidadId = especialidadSelect.value;
            const especialidadText = especialidadSelect.options[especialidadSelect.selectedIndex]?.text || '';
            const ubicacion = ubicacionInput.value;
            previewNumber.textContent = numero;
            previewTitle.textContent = `Consultorio ${numero}`;
            previewLocation.textContent = ubicacion;
            previewSpecialty.innerHTML = `<span class="mr-1">⚕️</span>${especialidadText}`;

            const changes = [];

            if (numero !== originalValues.numero) {
                changes.push(`• Número: "${originalValues.numero}" → "${numero}"`);
            }

            if (especialidadId !== originalValues.especialidad) {
                const originalEspText = document.querySelector(`option[value="${originalValues.especialidad}"]`).textContent;
                changes.push(`• Especialidad: "${originalEspText}" → "${especialidadText}"`);
            }

            if (ubicacion !== originalValues.ubicacion) {
                changes.push(`• Ubicación: "${originalValues.ubicacion}" → "${ubicacion}"`);
            }

            if (changes.length > 0) {
                changesList.innerHTML = changes.join('<br>');
                changesAlert.style.display = 'block';
                updateBtn.classList.remove('from-orange-500', 'to-orange-600', 'hover:from-orange-600', 'hover:to-orange-700');
                updateBtn.classList.add('from-green-500', 'to-green-600', 'hover:from-green-600', 'hover:to-green-700');
            } else {
                changesAlert.style.display = 'none';
                updateBtn.classList.remove('from-green-500', 'to-green-600', 'hover:from-green-600', 'hover:to-green-700');
                updateBtn.classList.add('from-orange-500', 'to-orange-600', 'hover:from-orange-600', 'hover:to-orange-700');
            }
        }

        nroConInput.addEventListener('input', updatePreviewAndDetectChanges);
        especialidadSelect.addEventListener('change', updatePreviewAndDetectChanges);
        ubicacionInput.addEventListener('input', updatePreviewAndDetectChanges);

        form.addEventListener('submit', function(e) {
            const hasChanges = nroConInput.value !== originalValues.numero ||
                especialidadSelect.value !== originalValues.especialidad ||
                ubicacionInput.value !== originalValues.ubicacion;

            if (!hasChanges) {
                e.preventDefault();
                alert('No se han detectado cambios para actualizar.');
                return;
            }

            updateBtn.disabled = true;
            updateText.textContent = 'Actualizando...';
            updateBtn.classList.add('opacity-75');

            setTimeout(() => {
                updateText.textContent = 'Procesando...';
            }, 500);
        });

        const inputs = form.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-orange-500');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-orange-500');
            });
        });

        function validateForm() {
            const numero = nroConInput.value.trim();
            const especialidad = especialidadSelect.value;
            const ubicacion = ubicacionInput.value.trim();

            let isValid = true;

            [nroConInput, especialidadSelect, ubicacionInput].forEach(input => {
                input.classList.remove('border-red-500', 'border-green-500');
            });

            if (!numero) {
                nroConInput.classList.add('border-red-500');
                isValid = false;
            } else {
                nroConInput.classList.add('border-green-500');
            }

            if (!especialidad) {
                especialidadSelect.classList.add('border-red-500');
                isValid = false;
            } else {
                especialidadSelect.classList.add('border-green-500');
            }

            if (!ubicacion) {
                ubicacionInput.classList.add('border-red-500');
                isValid = false;
            } else {
                ubicacionInput.classList.add('border-green-500');
            }

            return isValid;
        }

        [nroConInput, especialidadSelect, ubicacionInput].forEach(input => {
            input.addEventListener('blur', validateForm);
            input.addEventListener('input', validateForm);
        });

        validateForm();

        const previewCard = document.getElementById('previewCard');
        previewCard.style.opacity = '0';
        previewCard.style.transform = 'translateY(20px)';
        setTimeout(() => {
            previewCard.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
            previewCard.style.opacity = '1';
            previewCard.style.transform = 'translateY(0)';
        }, 300);
    });
</script>

<?php require_once 'views/components/footer.php'; ?>