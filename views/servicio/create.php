<?php require_once 'views/components/header.php'; ?>

<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-4">
            <a href="/servicio" class="inline-flex items-center px-4 py-2 text-sm text-gray-600 hover:text-gray-900 transition-colors duration-200">
                <span class="mr-2">←</span>
                Volver a Servicios
            </a>
        </div>
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-xl mb-4">
                <span class="text-2xl text-white">⚕️</span>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Registrar Nuevo Servicio</h2>
            <p class="text-gray-600">Agrega un nuevo servicio médico al catálogo</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-8">
        <form action="/servicio/store" method="POST" class="space-y-6" id="servicioForm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="desc_serv" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">📋</span>
                            Descripción del Servicio
                        </span>
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            id="desc_serv"
                            name="desc_serv"
                            placeholder="Ej: Consulta General, Examen de Laboratorio, Cirugía Menor..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 pl-12"
                            required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400">🏥</span>
                        </div>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Proporciona una descripción clara y específica del servicio</p>
                </div>

                <div>
                    <label for="costo_serv" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">💰</span>
                            Costo del Servicio
                        </span>
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            id="costo_serv"
                            name="costo_serv"
                            step="0.01"
                            min="0"
                            placeholder="0.00"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 pl-12"
                            required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 text-sm">$</span>
                        </div>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Ingresa el precio en dólares americanos</p>
                </div>

                <div>
                    <label for="categoria" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">🏷️</span>
                            Categoría del Servicio
                        </span>
                    </label>
                    <select id="categoria" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200">
                        <option value="">Seleccionar categoría</option>
                        <option value="consulta">Consulta Médica</option>
                        <option value="laboratorio">Laboratorio</option>
                        <option value="cirugia">Cirugía</option>
                        <option value="emergencia">Emergencia</option>
                        <option value="general">Servicio General</option>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">Ayuda a clasificar el tipo de servicio</p>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-3 flex items-center">
                    <span class="mr-2">💡</span>
                    Vista previa del servicio
                </h4>
                <div class="bg-white rounded-lg border p-4">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                            <span class="text-white font-bold text-lg" id="previewIcon">SE</span>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm font-medium text-gray-900" id="previewDesc">
                                Descripción del servicio aparecerá aquí
                            </div>
                            <div class="text-sm text-gray-500" id="previewCategoria">
                                Categoría del servicio
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-green-600" id="previewPrecio">
                                $0.00
                            </div>
                            <div class="text-sm text-gray-500">
                                Precio del servicio
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <span class="text-blue-400 text-xl">ℹ️</span>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-blue-800">Información importante</h4>
                        <div class="mt-2 text-sm text-blue-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li>El servicio se creará con estado "activo" por defecto</li>
                                <li>Asegúrate de que el precio sea correcto antes de guardar</li>
                                <li>La descripción debe ser clara para facilitar la búsqueda</li>
                                <li>Puedes editar esta información posteriormente si es necesario</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <div class="flex items-center text-sm text-gray-500">
                    <span class="mr-2">🔒</span>
                    Todos los campos son obligatorios
                </div>
                <div class="flex gap-3">
                    <a href="/servicio" class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-all duration-200">
                        Cancelar
                    </a>
                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-lg hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <span class="mr-2">💾</span>
                        Guardar Servicio
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <div class="text-2xl mb-2">🩺</div>
            <div class="text-sm font-medium text-gray-900">Consultas</div>
            <div class="text-xs text-gray-500">Servicios de consulta médica general y especializada</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <div class="text-2xl mb-2">🧪</div>
            <div class="text-sm font-medium text-gray-900">Laboratorio</div>
            <div class="text-xs text-gray-500">Análisis clínicos y exámenes de laboratorio</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <div class="text-2xl mb-2">🏥</div>
            <div class="text-sm font-medium text-gray-900">Procedimientos</div>
            <div class="text-xs text-gray-500">Cirugías menores y procedimientos médicos</div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const descInput = document.getElementById('desc_serv');
        const costoInput = document.getElementById('costo_serv');
        const categoriaSelect = document.getElementById('categoria');

        const previewIcon = document.getElementById('previewIcon');
        const previewDesc = document.getElementById('previewDesc');
        const previewCategoria = document.getElementById('previewCategoria');
        const previewPrecio = document.getElementById('previewPrecio');

        function updatePreview() {
            // Actualizar descripción
            const desc = descInput.value || 'Descripción del servicio aparecerá aquí';
            previewDesc.textContent = desc;

            // Actualizar icono basado en las primeras dos letras
            if (descInput.value.length >= 2) {
                previewIcon.textContent = descInput.value.substring(0, 2).toUpperCase();
            } else {
                previewIcon.textContent = 'SE';
            }

            // Actualizar precio
            const precio = costoInput.value || '0.00';
            previewPrecio.textContent = '+ ' + parseFloat(precio).toFixed(2);

            // Actualizar categoría
            const categoria = categoriaSelect.value;
            const categoriaTexts = {
                'consulta': 'Consulta Médica',
                'laboratorio': 'Laboratorio',
                'cirugia': 'Cirugía',
                'emergencia': 'Emergencia',
                'general': 'Servicio General'
            };
            previewCategoria.textContent = categoriaTexts[categoria] || 'Categoría del servicio';
        }

        // Event listeners para actualizar la vista previa
        descInput.addEventListener('input', updatePreview);
        costoInput.addEventListener('input', updatePreview);
        categoriaSelect.addEventListener('change', updatePreview);

        // Validación del formulario
        const form = document.getElementById('servicioForm');
        form.addEventListener('submit', function(e) {
            const desc = descInput.value.trim();
            const costo = parseFloat(costoInput.value);

            if (desc.length < 3) {
                e.preventDefault();
                alert('La descripción debe tener al menos 3 caracteres');
                descInput.focus();
                return;
            }

            if (isNaN(costo) || costo <= 0) {
                e.preventDefault();
                alert('El costo debe ser mayor a 0');
                costoInput.focus();
                return;
            }

            if (costo > 10000) {
                if (!confirm('El costo es muy alto (' + costo.toFixed(2) + '). ¿Estás seguro de que es correcto?')) {
                    e.preventDefault();
                    costoInput.focus();
                    return;
                }
            }
        });

        // Sugerencias automáticas basadas en la categoría
        categoriaSelect.addEventListener('change', function() {
            const categoria = this.value;
            const sugerencias = {
                'consulta': ['Consulta General', 'Consulta Especializada', 'Control Médico', 'Revisión Médica'],
                'laboratorio': ['Análisis de Sangre', 'Examen de Orina', 'Perfil Lipídico', 'Hemograma Completo'],
                'cirugia': ['Cirugía Menor', 'Sutura', 'Extracción', 'Procedimiento Quirúrgico'],
                'emergencia': ['Atención de Emergencia', 'Consulta Urgente', 'Atención Inmediata'],
                'general': ['Servicio Médico', 'Atención Médica', 'Procedimiento Clínico']
            };

            if (sugerencias[categoria] && !descInput.value) {
                // No autocompletar, solo mostrar placeholder sugerido
                descInput.placeholder = sugerencias[categoria][0] + '...';
            }
        });

        // Animación de entrada
        const form_container = document.querySelector('.bg-white.rounded-xl');
        if (form_container) {
            form_container.style.opacity = '0';
            form_container.style.transform = 'translateY(20px)';
            setTimeout(() => {
                form_container.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
                form_container.style.opacity = '1';
                form_container.style.transform = 'translateY(0)';
            }, 100);
        }

        // Inicializar vista previa
        updatePreview();
    });
</script>


<?php require_once 'views/components/footer.php'; ?>