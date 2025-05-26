<?php require_once 'views/components/header.php'; ?>

<div class="max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">🏥 Gestión de Consultorios</h2>
            <p class="text-gray-600">Administra los espacios físicos y su asignación por especialidades</p>
        </div>
        <div class="flex gap-3">
            <a href="/consultorio/create" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                <span class="mr-2 text-lg">➕</span>
                Nuevo Consultorio
            </a>
            <button onclick="refreshTable()" class="inline-flex items-center px-4 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-all duration-200">
                <span class="mr-2">🔄</span>
                Actualizar
            </button>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar consultorio</label>
                <input type="text" id="searchConsultorio" placeholder="Número o ubicación..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
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
            <div class="flex items-end">
                <button onclick="clearFilters()" class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200">
                    Limpiar filtros
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Consultorios</p>
                    <p class="text-2xl font-bold text-gray-900" id="totalConsultorios"><?= count($this->d) ?></p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">🏥</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Especialidades</p>
                    <p class="text-2xl font-bold text-purple-600" id="especialidadesCount">
                        <?= count(array_unique(array_column($this->d, 'nom_esp'))) ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">⚕️</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Pisos Utilizados</p>
                    <p class="text-2xl font-bold text-green-600" id="pisosCount">
                        <?php
                        $pisos = [];
                        foreach ($this->d as $c) {
                            if (preg_match('/piso\s*(\d+)/i', $c['ubicacion'], $matches)) {
                                $pisos[] = $matches[1];
                            }
                        }
                        echo count(array_unique($pisos));
                        ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">🏢</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Promedio por Piso</p>
                    <p class="text-2xl font-bold text-orange-600" id="promedioCount">
                        <?php
                        $totalPisos = count(array_unique($pisos));
                        echo $totalPisos > 0 ? round(count($this->d) / $totalPisos, 1) : 0;
                        ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">📊</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">🗺️ Distribución por Pisos</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="floorPlan">
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Listado de Consultorios</h3>
        </div>
        
        <?php if (empty($this->d)): ?>
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">🏥</div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay consultorios registrados</h3>
                <p class="text-gray-500 mb-6">Comienza agregando el primer consultorio médico</p>
                <a href="/consultorio/create" class="inline-flex items-center px-6 py-3 bg-eps-blue-600 text-white font-semibold rounded-lg hover:bg-eps-blue-700 transition-colors duration-200">
                    <span class="mr-2">➕</span>
                    Crear Primer Consultorio
                </a>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full" id="consultoriosTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Consultorio</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Especialidad</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ubicación</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detalles</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($this->d as $index => $consultorio): ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-200 consultorio-row" 
                                data-numero="<?= htmlspecialchars(strtolower($consultorio['nro_con'])) ?>" 
                                data-especialidad="<?= htmlspecialchars($consultorio['nom_esp']) ?>"
                                data-ubicacion="<?= htmlspecialchars(strtolower($consultorio['ubicacion'])) ?>">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4">
                                            <span class="text-white font-bold text-lg">
                                                <?= htmlspecialchars($consultorio['nro_con']) ?>
                                            </span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                Consultorio <?= htmlspecialchars($consultorio['nro_con']) ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                ID: <?= str_pad($consultorio['id_con'], 3, '0', STR_PAD_LEFT) ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        <span class="mr-1">⚕️</span>
                                        <?= htmlspecialchars($consultorio['nom_esp']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="mr-2 text-gray-400">📍</span>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                <?= htmlspecialchars($consultorio['ubicacion']) ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                <?php
                                                if (preg_match('/piso\s*(\d+)/i', $consultorio['ubicacion'], $matches)) {
                                                    echo "Piso " . $matches[1];
                                                } else {
                                                    echo "Ubicación específica";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <div class="flex items-center mb-1">
                                            <span class="mr-2">🚪</span>
                                            <span>Acceso disponible</span>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="mr-2">🪑</span>
                                            <span class="text-gray-500">Equipado</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="/consultorio/edit/<?= $consultorio['id_con'] ?>" 
                                           class="inline-flex items-center px-3 py-1.5 bg-eps-blue-100 text-eps-blue-700 text-sm font-medium rounded-lg hover:bg-eps-blue-200 transition-colors duration-200"
                                           title="Editar consultorio">
                                            <span class="mr-1">✏️</span>
                                            Editar
                                        </a>
                                        <button onclick="confirmDelete(<?= $consultorio['id_con'] ?>, '<?= htmlspecialchars($consultorio['nro_con']) ?>')" 
                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors duration-200"
                                                title="Eliminar consultorio">
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
                                <div class="bg-indigo-600 h-2 rounded-full" style="width: <?= $percentage ?>%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-900"><?= $count ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h4 class="text-lg font-semibold text-gray-900 mb-4">🏗️ Información de Infraestructura</h4>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Total de consultorios:</span>
                    <span class="text-sm font-semibold text-gray-900"><?= count($this->d) ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Especialidades atendidas:</span>
                    <span class="text-sm font-semibold text-purple-600">
                        <?= count(array_unique(array_column($this->d, 'nom_esp'))) ?>
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Distribución más común:</span>
                    <span class="text-sm font-semibold text-indigo-600">
                        <?php
                        if (!empty($especialidadesCount)) {
                            $maxEsp = array_keys($especialidadesCount, max($especialidadesCount))[0];
                            echo htmlspecialchars($maxEsp);
                        } else {
                            echo 'N/A';
                        }
                        ?>
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Capacidad total estimada:</span>
                    <span class="text-sm font-semibold text-eps-blue-600">
                        <?= count($this->d) * 8 ?> citas/día
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Mostrando <span class="font-medium" id="visibleCount"><?= count($this->d) ?></span> consultorios
        </div>
    </div>
</div>

<script>

const consultoriosData = <?= json_encode($this->d) ?>;

function confirmDelete(consultorioId, consultorioNumber) {
    if (confirm(`¿Estás seguro de que deseas eliminar el Consultorio ${consultorioNumber}? Esta acción no se puede deshacer.`)) {
        window.location.href = '/consultorio/delete/' + consultorioId;
    }
}

function refreshTable() {
    window.location.reload();
}

function clearFilters() {
    document.getElementById('searchConsultorio').value = '';
    document.getElementById('filterSpecialty').value = '';
    filterTable();
}

function filterTable() {
    const searchTerm = document.getElementById('searchConsultorio').value.toLowerCase();
    const specialtyFilter = document.getElementById('filterSpecialty').value;
    
    const rows = document.querySelectorAll('.consultorio-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
        let show = true;
        
        if (searchTerm && !row.dataset.numero.includes(searchTerm) && !row.dataset.ubicacion.includes(searchTerm)) {
            show = false;
        }
        
        if (specialtyFilter && row.dataset.especialidad !== specialtyFilter) {
            show = false;
        }
        
        row.style.display = show ? '' : 'none';
        if (show) visibleCount++;
    });
    
    document.getElementById('visibleCount').textContent = visibleCount;
}

function createFloorPlan() {
    const floorPlan = document.getElementById('floorPlan');
    const floors = {};
    
    consultoriosData.forEach(consultorio => {
        let floor = 'Otros';
        const match = consultorio.ubicacion.match(/piso\s*(\d+)/i);
        if (match) {
            floor = 'Piso ' + match[1];
        }
        
        if (!floors[floor]) {
            floors[floor] = [];
        }
        floors[floor].push(consultorio);
    });
    
    Object.entries(floors).forEach(([floorName, consultorios]) => {
        const floorDiv = document.createElement('div');
        floorDiv.className = 'bg-gray-50 rounded-lg p-4 border hover:shadow-md transition-shadow duration-200';
        
        floorDiv.innerHTML = `
            <h5 class="font-semibold text-gray-900 mb-3">${floorName}</h5>
            <div class="space-y-2">
                ${consultorios.map(c => `
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Consultorio ${c.nro_con}</span>
                        <span class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded">${c.nom_esp}</span>
                    </div>
                `).join('')}
            </div>
            <div class="mt-3 text-xs text-gray-500">
                ${consultorios.length} consultorio${consultorios.length !== 1 ? 's' : ''}
            </div>
        `;
        
        floorPlan.appendChild(floorDiv);
    });
}

document.getElementById('searchConsultorio').addEventListener('input', filterTable);
document.getElementById('filterSpecialty').addEventListener('change', filterTable);

document.addEventListener('DOMContentLoaded', function() {
    createFloorPlan();
    

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