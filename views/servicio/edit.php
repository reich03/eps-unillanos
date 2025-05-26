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
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl mb-4">
                <span class="text-2xl text-white">✏️</span>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Editar Servicio Médico</h2>
            <p class="text-gray-600">Modifica la información del servicio seleccionado</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-8">
        <form action="/servicio/update" method="POST" class="space-y-6" id="servicioEditForm">
            <input type="hidden" name="id_serv" value="<?= $this->d['servicio']['id_serv'] ?>">
            
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-r from-gray-500 to-gray-600 rounded-xl flex items-center justify-center mr-4">
                        <span class="text-white font-bold text-sm">ID</span>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-900">
                            Servicio ID: <?= str_pad($this->d['servicio']['id_serv'], 3, '0', STR_PAD_LEFT) ?>
                        </div>
                        <div class="text-sm text-gray-500">
                            Identificador único del servicio
                        </div>
                    </div>
                </div>
            </div>

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
                            value="<?= htmlspecialchars($this->d['servicio']['desc_serv']) ?>"
                            placeholder="Descripción del servicio..." 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 pl-12" 
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
                            value="<?= $this->d['servicio']['costo_serv'] ?>"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 pl-12" 
                            required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 text-sm">$</span>
                        </div>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Precio actual: $<?= number_format($this->d['servicio']['costo_serv'], 2) ?></p>
                </div>

                <div>
                    <label for="est_serv" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">🔄</span>
                            Estado del Servicio
                        </span>
                    </label>
                    <select 
                        id="est_serv"
                        name="est_serv" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <option value="activo" <?= $this->d['servicio']['est_serv'] == 'activo' ? 'selected' : '' ?>>
                            ✅ Activo
                        </option>
                        <option value="inactivo" <?= $this->d['servicio']['est_serv'] == 'inactivo' ? 'selected' : '' ?>>
                            ❌ Inactivo
                        </option>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">
                        Estado actual: 
                        <span class="font-medium <?= $this->d['servicio']['est_serv'] == 'activo' ? 'text-green-600' : 'text-red-600' ?>">
                            <?= ucfirst($this->d['servicio']['est_serv']) ?>
                        </span>
                    </p>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-3 flex items-center">
                    <span class="mr-2">💡</span>
                    Vista previa de los cambios
                </h4>
                <div class="bg-white rounded-lg border p-4">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                            <span class="text-white font-bold text-lg" id="previewIcon">
                                <?= strtoupper(substr($this->d['servicio']['desc_serv'], 0, 2)) ?>
                            </span>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm font-medium text-gray-900" id="previewDesc">
                                <?= htmlspecialchars($this->d['servicio']['desc_serv']) ?>
                            </div>
                            <div class="text-sm text-gray-500" id="previewEstado">
                                Estado: <?= ucfirst($this->d['servicio']['est_serv']) ?>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-green-600" id="previewPrecio">
                                $<?= number_format($this->d['servicio']['costo_serv'], 2) ?>
                            </div>
                            <div class="text-sm" id="previewEstadoBadge">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                    <?= $this->d['servicio']['est_serv'] == 'activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                    <?= $this->d['servicio']['est_serv'] == 'activo' ? '✅' : '❌' ?>
                                    <?= ucfirst($this->d['servicio']['est_serv']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="text-blue-400 text-xl">ℹ️</span>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-blue-800">Información</h4>
                            <div class="mt-2 text-sm text-blue-700">
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Los cambios se aplicarán inmediatamente</li>
                                    <li>El historial de cambios se mantiene</li>
                                    <li>Servicios inactivos no aparecen en búsquedas</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="text-yellow-400 text-xl">⚠️</span>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-yellow-800">Advertencia</h4>
                            <div class="mt-2 text-sm text-yellow-700">
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Cambios de precio afectan nuevas citas</li>
                                    <li>Verifica la información antes de guardar</li>
                                    <li>Consulta con administración para cambios mayores</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <div class="flex items-center text-sm text-gray-500">
                    <span class="mr-2">⏰</span>
                    Última modificación: 
                    <span class="font-medium ml-1">Hoy</span>
                </div>
                <div class="flex gap-3">
                    <a href="/servicio" class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-all duration-200">
                        Cancelar
                    </a>
                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-lg hover:from-blue-600 hover:to-blue-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <span class="mr-2">💾</span>
                        Actualizar Servicio
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-6 bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <span class="mr-2">📊</span>
            Información del Servicio
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <div class="text-2xl mb-2">🆔</div>
                <div class="text-sm font-medium text-gray-900">ID del Servicio</div>
                <div class="text-xs text-gray-500"><?= str_pad($this->d['servicio']['id_serv'], 3, '0', STR_PAD_LEFT) ?></div>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <div class="text-2xl mb-2">
                    <?= $this->d['servicio']['est_serv'] == 'activo' ? '✅' : '❌' ?>
                </div>
                <div class="text-sm font-medium text-gray-900">Estado</div>
                <div class="text-xs text-gray-500 capitalize"><?= $this->d['servicio']['est_serv'] ?></div>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <div class="text-2xl mb-2">💰</div>
                <div class="text-sm font-medium text-gray-900">Precio Actual</div>
                <div class="text-xs text-gray-500">$<?= number_format($this->d['servicio']['costo_serv'], 2) ?></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const descInput = document.getElementById('desc_serv');
    const costoInput = document.getElementById('costo_serv');
    const estadoSelect = document.getElementById('est_serv');
    
    const previewIcon = document.getElementById('previewIcon');
    const previewDesc = document.getElementById('previewDesc');
    const previewEstado = document.getElementById('previewEstado');
    const previewPrecio = document.getElementById('previewPrecio');
    const previewEstadoBadge = document.getElementById('previewEstadoBadge');

    function updatePreview() {
        // Actualizar descripción
        const desc = descInput.value || 'Descripción del servicio';
        previewDesc.textContent = desc;
        
        // Actualizar icono basado en las primeras dos letras
        if (descInput.value.length >= 2) {
            previewIcon.textContent = descInput.value.substring(0, 2).toUpperCase();
        }
        
        // Actualizar precio
        const precio = costoInput.value || '0.00';
        previewPrecio.textContent = '$' + parseFloat(precio).toFixed(2);
        
        // Actualizar estado
        const estado = estadoSelect.value;
        previewEstado.textContent = 'Estado: ' + estado.charAt(0).toUpperCase() + estado.slice(1);
        
        // Actualizar badge de estado
        const isActive = estado === 'activo';
        previewEstadoBadge.innerHTML = `
            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                ${isActive ? '✅' : '❌'}
                ${estado.charAt(0).toUpperCase() + estado.slice(1)}
            </span>
        `;
    }

    // Event listeners para actualizar la vista previa
    descInput.addEventListener('input', updatePreview);
    costoInput.addEventListener('input', updatePreview);
    estadoSelect.addEventListener('change', updatePreview);

    // Validación del formulario
    const form = document.getElementById('servicioEditForm');
    form.addEventListener('submit', function(e) {
        const desc = descInput.value.trim();
        const costo = parseFloat(costoInput.value);

        if (desc.length < 3) {
            e.preventDefault();
            alert('La descripción debe tener al menos 3 caracteres');
            descInput.focus();
            return;
        }

        if (costo <= 0) {
            e.preventDefault();
            alert('El costo debe ser mayor a 0');
            costoInput.focus();
            return;
        }

        // Confirmar cambios significativos de precio
        const precioOriginal = <?= $this->d['servicio']['costo_serv'] ?>;
        const diferencia = Math.abs(costo - precioOriginal);
        const porcentajeCambio = (diferencia / precioOriginal) * 100;

        if (porcentajeCambio > 20) {
            const mensaje = `El precio ha cambiado significativamente (${porcentajeCambio.toFixed(1)}%).\n` +
                          `Precio original: $${precioOriginal.toFixed(2)}\n` +
                          `Nuevo precio: $${costo.toFixed(2)}\n` +
                          `¿Estás seguro de que deseas continuar?`;
            
            if (!confirm(mensaje)) {
                e.preventDefault();
                costoInput.focus();
                return;
            }
        }
    });

    // Animación de entrada
    const form_container = document.querySelector('.bg-white.rounded-xl');
    form_container.style.opacity = '0';
    form_container.style.transform = 'translateY(20px)';
    setTimeout(() => {
        form_container.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
        form_container.style.opacity = '1';
        form_container.style.transform = 'translateY(0)';
    }, 100);
});
</script>

<?php require_once 'views/components/footer.php'; ?>