<?php require_once 'views/components/header.php'; ?>

<div class="max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">🩺 Gestión de Médicos</h2>
            <p class="text-gray-600">Administra el equipo médico y sus especialidades</p>
        </div>
        <div class="flex gap-3">
            <a href="/medico/create" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                <span class="mr-2 text-lg">➕</span>
                Nuevo Médico
            </a>
            <button onclick="refreshTable()" class="inline-flex items-center px-4 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-all duration-200">
                <span class="mr-2">🔄</span>
                Actualizar
            </button>
        </div>
    </div>

    <!-- Filtros y búsqueda -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar médico</label>
                <input type="text" id="searchDoctor" placeholder="Nombre del médico..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Especialidad</label>
                <select id="filterSpecialty" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="">Todas las especialidades</option>
                    <?php 
                    $especialidades = array_unique(array_column($this->d, 'nom_esp'));
                    foreach ($especialidades as $esp): ?>
                        <option value="<?= htmlspecialchars($esp) ?>"><?= htmlspecialchars($esp) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                <select id="filterStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="">Todos los estados</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
        </div>
        <div class="mt-4 flex justify-end">
            <button onclick="clearFilters()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200">
                Limpiar filtros
            </button>
        </div>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Médicos</p>
                    <p class="text-2xl font-bold text-gray-900" id="totalMedicos"><?= count($this->d) ?></p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">🩺</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Médicos Activos</p>
                    <p class="text-2xl font-bold text-green-600" id="activosMedicos">
                        <?= count(array_filter($this->d, fn($m) => $m['est_med'] === 'activo')) ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">✅</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Especialidades</p>
                    <p class="text-2xl font-bold text-purple-600" id="especialidadesMedicos">
                        <?= count(array_unique(array_column($this->d, 'nom_esp'))) ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">⚕️</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Inactivos</p>
                    <p class="text-2xl font-bold text-orange-600" id="inactivosMedicos">
                        <?= count(array_filter($this->d, fn($m) => $m['est_med'] === 'inactivo')) ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">⏸️</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de médicos -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Equipo Médico</h3>
        </div>
        
        <?php if (empty($this->d)): ?>
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">🩺</div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay médicos registrados</h3>
                <p class="text-gray-500 mb-6">Comienza agregando el primer médico al sistema</p>
                <a href="/medico/create" class="inline-flex items-center px-6 py-3 bg-eps-blue-600 text-white font-semibold rounded-lg hover:bg-eps-blue-700 transition-colors duration-200">
                    <span class="mr-2">➕</span>
                    Registrar Primer Médico
                </a>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full" id="medicosTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Médico</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Especialidad</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contacto</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($this->d as $index => $medico): ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-200 medico-row" 
                                data-nombre="<?= htmlspecialchars(strtolower($medico['nom_med'])) ?>" 
                                data-especialidad="<?= htmlspecialchars($medico['nom_esp']) ?>"
                                data-estado="<?= htmlspecialchars($medico['est_med']) ?>">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-r from-eps-blue-500 to-eps-blue-600 rounded-full flex items-center justify-center mr-4">
                                            <span class="text-white font-bold text-lg">
                                                <?= strtoupper(substr($medico['nom_med'], 0, 2)) ?>
                                            </span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                Dr. <?= htmlspecialchars($medico['nom_med']) ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                ID: <?= str_pad($medico['id_med'], 3, '0', STR_PAD_LEFT) ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            <span class="mr-1">⚕️</span>
                                            <?= htmlspecialchars($medico['nom_esp']) ?>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="mr-2 text-gray-400">📞</span>
                                        <span class="text-sm text-gray-900">
                                            <?= htmlspecialchars($medico['contacto_med'] ?: 'No especificado') ?>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($medico['est_med'] === 'activo'): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <span class="mr-1">✅</span>
                                            Activo
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <span class="mr-1">⏸️</span>
                                            Inactivo
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="/medico/edit/<?= $medico['id_med'] ?>" 
                                           class="inline-flex items-center px-3 py-1.5 bg-eps-blue-100 text-eps-blue-700 text-sm font-medium rounded-lg hover:bg-eps-blue-200 transition-colors duration-200"
                                           title="Editar médico">
                                            <span class="mr-1">✏️</span>
                                            Editar
                                        </a>
                                        <button onclick="confirmDelete(<?= $medico['id_med'] ?>, '<?= htmlspecialchars($medico['nom_med']) ?>')" 
                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors duration-200"
                                                title="Eliminar médico">
                                            <span class="mr-1">🗑️</span>
                                            Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- Información estadística adicional -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h4 class="text-lg font-semibold text-gray-900 mb-4">📊 Distribución por Especialidades</h4>
            <div class="space-y-3">
                <?php 
                $especialidadesCount = array_count_values(array_column($this->d, 'nom_esp'));
                $total = count($this->d);
                foreach ($especialidadesCount as $esp => $count): 
                    $percentage = $total > 0 ? round(($count / $total) * 100, 1) : 0;
                ?>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600"><?= htmlspecialchars($esp) ?></span>
                        <div class="flex items-center">
                            <div class="w-20 bg-gray-200 rounded-full h-2 mr-3">
                                <div class="bg-eps-blue-600 h-2 rounded-full" style="width: <?= $percentage ?>%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-900"><?= $count ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h4 class="text-lg font-semibold text-gray-900 mb-4">📈 Resumen General</h4>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Total de médicos:</span>
                    <span class="text-sm font-semibold text-gray-900"><?= count($this->d) ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Médicos activos:</span>
                    <span class="text-sm font-semibold text-green-600">
                        <?= count(array_filter($this->d, fn($m) => $m['est_med'] === 'activo')) ?>
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Especialidades disponibles:</span>
                    <span class="text-sm font-semibold text-purple-600">
                        <?= count(array_unique(array_column($this->d, 'nom_esp'))) ?>
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Tasa de actividad:</span>
                    <span class="text-sm font-semibold text-eps-blue-600">
                        <?= count($this->d) > 0 ? round((count(array_filter($this->d, fn($m) => $m['est_med'] === 'activo')) / count($this->d)) * 100, 1) : 0 ?>%
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Contador de resultados -->
    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Mostrando <span class="font-medium" id="visibleCount"><?= count($this->d) ?></span> médicos
        </div>
    </div>
</div>

<script>
// Función para confirmar eliminación
function confirmDelete(medicoId, medicoName) {
    if (confirm(`¿Estás seguro de que deseas eliminar al Dr. ${medicoName}? Esta acción no se puede deshacer.`)) {
        window.location.href = '/medico/delete/' + medicoId;
    }
}

// Función para refrescar la tabla
function refreshTable() {
    window.location.reload();
}

// Función para limpiar filtros
function clearFilters() {
    document.getElementById('searchDoctor').value = '';
    document.getElementById('filterSpecialty').value = '';
    document.getElementById('filterStatus').value = '';
    filterTable();
}

// Función para filtrar la tabla
function filterTable() {
    const searchTerm = document.getElementById('searchDoctor').value.toLowerCase();
    const specialtyFilter = document.getElementById('filterSpecialty').value;
    const statusFilter = document.getElementById('filterStatus').value;
    
    const rows = document.querySelectorAll('.medico-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
        let show = true;
        
        // Filtro por nombre
        if (searchTerm && !row.dataset.nombre.includes(searchTerm)) {
            show = false;
        }
        
        // Filtro por especialidad
        if (specialtyFilter && row.dataset.especialidad !== specialtyFilter) {
            show = false;
        }
        
        // Filtro por estado
        if (statusFilter && row.dataset.estado !== statusFilter) {
            show = false;
        }
        
        // Mostrar/ocultar fila
        row.style.display = show ? '' : 'none';
        if (show) visibleCount++;
    });
    
    // Actualizar contador
    document.getElementById('visibleCount').textContent = visibleCount;
}

// Event listeners para filtros
document.getElementById('searchDoctor').addEventListener('input', filterTable);
document.getElementById('filterSpecialty').addEventListener('change', filterTable);
document.getElementById('filterStatus').addEventListener('change', filterTable);

// Animaciones de entrada
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.shadow-lg');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>

<?php require_once 'views/components/footer.php'; ?>