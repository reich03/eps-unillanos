<?php require_once 'views/components/header.php'; ?>

<div class="max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">🏥 Gestión de Servicios Médicos</h2>
            <p class="text-gray-600">Administra los servicios disponibles y sus tarifas</p>
        </div>
        <div class="flex gap-3">
            <a href="/servicio/create" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                <span class="mr-2 text-lg">➕</span>
                Nuevo Servicio
            </a>
            <button onclick="refreshTable()" class="inline-flex items-center px-4 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-all duration-200">
                <span class="mr-2">🔄</span>
                Actualizar
            </button>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar servicio</label>
                <input type="text" id="searchServicio" placeholder="Descripción del servicio..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                <select id="filterEstado" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="">Todos los estados</option>
                    <option value="activo">Activos</option>
                    <option value="inactivo">Inactivos</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Rango de precio</label>
                <select id="filterPrecio" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="">Todos los precios</option>
                    <option value="0-50">$0 - $50</option>
                    <option value="51-100">$51 - $100</option>
                    <option value="101-200">$101 - $200</option>
                    <option value="201-999999">Más de $200</option>
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
                    <p class="text-sm text-gray-600">Total Servicios</p>
                    <p class="text-2xl font-bold text-gray-900" id="totalServicios"><?= count($this->d) ?></p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">⚕️</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Servicios Activos</p>
                    <p class="text-2xl font-bold text-green-600" id="serviciosActivos">
                        <?= count(array_filter($this->d, function($s) { return $s['est_serv'] == 'activo'; })) ?>
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
                    <p class="text-sm text-gray-600">Precio Promedio</p>
                    <p class="text-2xl font-bold text-purple-600" id="precioPromedio">
                        <?php
                        $precios = array_column($this->d, 'costo_serv');
                        $promedio = count($precios) > 0 ? array_sum($precios) / count($precios) : 0;
                        echo '$' . number_format($promedio, 2);
                        ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">💰</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Servicio Más Caro</p>
                    <p class="text-2xl font-bold text-orange-600" id="servicioMasCaro">
                        <?php
                        $maxPrecio = count($this->d) > 0 ? max(array_column($this->d, 'costo_serv')) : 0;
                        echo '$' . number_format($maxPrecio, 2);
                        ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">🏆</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Catálogo de Servicios</h3>
        </div>
        
        <?php if (empty($this->d)): ?>
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">⚕️</div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay servicios registrados</h3>
                <p class="text-gray-500 mb-6">Comienza agregando el primer servicio médico</p>
                <a href="/servicio/create" class="inline-flex items-center px-6 py-3 bg-eps-blue-600 text-white font-semibold rounded-lg hover:bg-eps-blue-700 transition-colors duration-200">
                    <span class="mr-2">➕</span>
                    Crear Primer Servicio
                </a>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full" id="serviciosTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Servicio</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($this->d as $index => $servicio): ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-200 servicio-row" 
                                data-descripcion="<?= htmlspecialchars(strtolower($servicio['desc_serv'])) ?>" 
                                data-estado="<?= htmlspecialchars($servicio['est_serv']) ?>"
                                data-precio="<?= $servicio['costo_serv'] ?>">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                                            <span class="text-white font-bold text-lg">
                                                <?= strtoupper(substr($servicio['desc_serv'], 0, 2)) ?>
                                            </span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                <?= htmlspecialchars($servicio['desc_serv']) ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                ID: <?= str_pad($servicio['id_serv'], 3, '0', STR_PAD_LEFT) ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="text-2xl font-bold text-green-600">
                                            $<?= number_format($servicio['costo_serv'], 2) ?>
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <?php
                                        $precio = $servicio['costo_serv'];
                                        if ($precio <= 50) echo "Económico";
                                        elseif ($precio <= 100) echo "Moderado";
                                        elseif ($precio <= 200) echo "Premium";
                                        else echo "Especializado";
                                        ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                        <?= $servicio['est_serv'] == 'activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                        <span class="mr-1">
                                            <?= $servicio['est_serv'] == 'activo' ? '✅' : '❌' ?>
                                        </span>
                                        <?= ucfirst($servicio['est_serv']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="mr-2">🏥</span>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                <?php
                                                $desc = strtolower($servicio['desc_serv']);
                                                if (strpos($desc, 'consulta') !== false || strpos($desc, 'cita') !== false) {
                                                    echo "Consulta Médica";
                                                } elseif (strpos($desc, 'laboratorio') !== false || strpos($desc, 'análisis') !== false || strpos($desc, 'examen') !== false) {
                                                    echo "Laboratorio";
                                                } elseif (strpos($desc, 'cirugía') !== false || strpos($desc, 'operación') !== false) {
                                                    echo "Cirugía";
                                                } elseif (strpos($desc, 'emergencia') !== false || strpos($desc, 'urgencia') !== false) {
                                                    echo "Emergencia";
                                                } else {
                                                    echo "Servicio General";
                                                }
                                                ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                Servicio clínico
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="/servicio/edit/<?= $servicio['id_serv'] ?>" 
                                           class="inline-flex items-center px-3 py-1.5 bg-eps-blue-100 text-eps-blue-700 text-sm font-medium rounded-lg hover:bg-eps-blue-200 transition-colors duration-200"
                                           title="Editar servicio">
                                            <span class="mr-1">✏️</span>
                                            Editar
                                        </a>
                                        <button onclick="confirmDelete(<?= $servicio['id_serv'] ?>, '<?= htmlspecialchars($servicio['desc_serv']) ?>')" 
                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors duration-200"
                                                title="Eliminar servicio">
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
            <h4 class="text-lg font-semibold text-gray-900 mb-4">📊 Distribución por Precio</h4>
            <div class="space-y-3">
                <?php 
                $rangos = [
                    '$0 - $50' => ['min' => 0, 'max' => 50, 'count' => 0],
                    '$51 - $100' => ['min' => 51, 'max' => 100, 'count' => 0],
                    '$101 - $200' => ['min' => 101, 'max' => 200, 'count' => 0],
                    'Más de $200' => ['min' => 201, 'max' => 999999, 'count' => 0]
                ];
                
                foreach ($this->d as $servicio) {
                    $precio = $servicio['costo_serv'];
                    foreach ($rangos as &$rango) {
                        if ($precio >= $rango['min'] && $precio <= $rango['max']) {
                            $rango['count']++;
                            break;
                        }
                    }
                }
                
                $total = count($this->d);
                foreach ($rangos as $nombre => $rango): 
                    $percentage = $total > 0 ? round(($rango['count'] / $total) * 100, 1) : 0;
                ?>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600"><?= $nombre ?></span>
                        <div class="flex items-center">
                            <div class="w-20 bg-gray-200 rounded-full h-2 mr-3">
                                <div class="bg-green-600 h-2 rounded-full" style="width: <?= $percentage ?>%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-900"><?= $rango['count'] ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h4 class="text-lg font-semibold text-gray-900 mb-4">💼 Estadísticas de Servicios</h4>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Total de servicios:</span>
                    <span class="text-sm font-semibold text-gray-900"><?= count($this->d) ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Servicios activos:</span>
                    <span class="text-sm font-semibold text-green-600">
                        <?= count(array_filter($this->d, function($s) { return $s['est_serv'] == 'activo'; })) ?>
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Precio más bajo:</span>
                    <span class="text-sm font-semibold text-blue-600">
                        <?php
                        $minPrecio = count($this->d) > 0 ? min(array_column($this->d, 'costo_serv')) : 0;
                        echo '$' . number_format($minPrecio, 2);
                        ?>
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Ingresos potenciales:</span>
                    <span class="text-sm font-semibold text-eps-blue-600">
                        <?php
                        $totalIngresos = array_sum(array_column($this->d, 'costo_serv'));
                        echo '$' . number_format($totalIngresos, 2);
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Mostrando <span class="font-medium" id="visibleCount"><?= count($this->d) ?></span> servicios
        </div>
    </div>
</div>

<script>
const serviciosData = <?= json_encode($this->d) ?>;

function confirmDelete(servicioId, servicioDesc) {
    if (confirm(`¿Estás seguro de que deseas eliminar el servicio "${servicioDesc}"? Esta acción no se puede deshacer.`)) {
        window.location.href = '/servicio/delete/' + servicioId;
    }
}

function refreshTable() {
    window.location.reload();
}

function clearFilters() {
    document.getElementById('searchServicio').value = '';
    document.getElementById('filterEstado').value = '';
    document.getElementById('filterPrecio').value = '';
    filterTable();
}

function filterTable() {
    const searchTerm = document.getElementById('searchServicio').value.toLowerCase();
    const estadoFilter = document.getElementById('filterEstado').value;
    const precioFilter = document.getElementById('filterPrecio').value;
    
    const rows = document.querySelectorAll('.servicio-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
        let show = true;
        
        if (searchTerm && !row.dataset.descripcion.includes(searchTerm)) {
            show = false;
        }
        
        if (estadoFilter && row.dataset.estado !== estadoFilter) {
            show = false;
        }
        
        if (precioFilter) {
            const precio = parseFloat(row.dataset.precio);
            const [min, max] = precioFilter.split('-').map(Number);
            if (precio < min || precio > max) {
                show = false;
            }
        }
        
        row.style.display = show ? '' : 'none';
        if (show) visibleCount++;
    });
    
    document.getElementById('visibleCount').textContent = visibleCount;
}

document.getElementById('searchServicio').addEventListener('input', filterTable);
document.getElementById('filterEstado').addEventListener('change', filterTable);
document.getElementById('filterPrecio').addEventListener('change', filterTable);

document.addEventListener('DOMContentLoaded', function() {
    // Animación de entrada para las tarjetas
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