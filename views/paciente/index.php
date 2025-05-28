<?php require_once 'views/components/header.php'; ?>

<div class="max-w-7xl mx-auto">
    <?php if (!empty($_GET['error'])): ?>
        <div class="mb-4 rounded-lg bg-red-100 border border-red-400 text-red-700 px-4 py-3" role="alert">
            <strong class="font-bold">Error:</strong>
            <span class="block sm:inline"><?= htmlspecialchars($_GET['error']) ?></span>
        </div>
    <?php elseif (!empty($_GET['success'])): ?>
        <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3" role="alert">
            <strong class="font-bold">Éxito:</strong>
            <span class="block sm:inline"><?= htmlspecialchars($_GET['success']) ?></span>
        </div>
    <?php endif; ?>
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">👥 Gestión de Pacientes</h2>
            <p class="text-gray-600">Administra el registro de pacientes y su información</p>
        </div>
        <div class="flex gap-3">
            <a href="/paciente/create" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                <span class="mr-2 text-lg">➕</span>
                Nuevo Paciente
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
                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar paciente</label>
                <input type="text" id="searchPatient" placeholder="Nombre o apellido..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">DNI</label>
                <input type="text" id="searchDNI" placeholder="Número de documento..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                <select id="filterStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="">Todos los estados</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Rango de edad</label>
                <select id="filterAge" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="">Todas las edades</option>
                    <option value="0-17">Menores (0-17)</option>
                    <option value="18-35">Jóvenes (18-35)</option>
                    <option value="36-60">Adultos (36-60)</option>
                    <option value="60+">Mayores (60+)</option>
                </select>
            </div>
        </div>
        <div class="mt-4 flex justify-end">
            <button onclick="clearFilters()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200">
                Limpiar filtros
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Pacientes</p>
                    <p class="text-2xl font-bold text-gray-900" id="totalPacientes"><?= count($this->d) ?></p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">👥</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Pacientes Activos</p>
                    <p class="text-2xl font-bold text-green-600" id="activosPacientes">
                        <?= count(array_filter($this->d, fn($p) => $p['est_pac'] === 'activo')) ?>
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
                    <p class="text-sm text-gray-600">Registros Hoy</p>
                    <p class="text-2xl font-bold text-purple-600" id="nuevosHoy">
                        <?php 
                        $hoy = date('Y-m-d');
                        echo count(array_filter($this->d, fn($p) => date('Y-m-d', strtotime($p['fec_pac'])) === $hoy));
                        ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">📅</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Inactivos</p>
                    <p class="text-2xl font-bold text-orange-600" id="inactivosPacientes">
                        <?= count(array_filter($this->d, fn($p) => $p['est_pac'] === 'inactivo')) ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">⏸️</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Registro de Pacientes</h3>
        </div>
        
        <?php if (empty($this->d)): ?>
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">👥</div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay pacientes registrados</h3>
                <p class="text-gray-500 mb-6">Comienza agregando el primer paciente al sistema</p>
                <a href="/paciente/create" class="inline-flex items-center px-6 py-3 bg-eps-blue-600 text-white font-semibold rounded-lg hover:bg-eps-blue-700 transition-colors duration-200">
                    <span class="mr-2">➕</span>
                    Registrar Primer Paciente
                </a>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full" id="pacientesTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paciente</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Documento</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Edad</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Registro</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($this->d as $index => $paciente): ?>
                            <?php 
                            $fechaNac = new DateTime($paciente['fec_pac']);
                            $hoy = new DateTime();
                            $edad = $hoy->diff($fechaNac)->y;
                            $nombreCompleto = $paciente['nom_pac'] . ' ' . $paciente['ape_pac'];
                            ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-200 paciente-row" 
                                data-nombre="<?= htmlspecialchars(strtolower($nombreCompleto)) ?>" 
                                data-dni="<?= htmlspecialchars($paciente['dni_pac']) ?>"
                                data-estado="<?= htmlspecialchars($paciente['est_pac']) ?>"
                                data-edad="<?= $edad ?>">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-r from-eps-blue-500 to-eps-blue-600 rounded-full flex items-center justify-center mr-4">
                                            <span class="text-white font-bold text-lg">
                                                <?= strtoupper(substr($paciente['nom_pac'], 0, 1) . substr($paciente['ape_pac'], 0, 1)) ?>
                                            </span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                <?= htmlspecialchars($nombreCompleto) ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                ID: <?= str_pad($paciente['id_pac'], 3, '0', STR_PAD_LEFT) ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="mr-2 text-gray-400">🆔</span>
                                        <span class="text-sm font-medium text-gray-900">
                                            <?= htmlspecialchars($paciente['dni_pac']) ?>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="mr-2 text-gray-400">🎂</span>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900"><?= $edad ?> años</div>
                                            <div class="text-xs text-gray-500"><?= date('d/m/Y', strtotime($paciente['fec_pac'])) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <?= date('d/m/Y', strtotime($paciente['fec_pac'])) ?>
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        <?php
                                        $diasDesde = (new DateTime())->diff(new DateTime($paciente['fec_pac']))->days;
                                        if ($diasDesde == 0) echo 'Hoy';
                                        elseif ($diasDesde == 1) echo 'Ayer';
                                        else echo "Hace $diasDesde días";
                                        ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($paciente['est_pac'] === 'activo'): ?>
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
                                        <a href="/paciente/edit/<?= $paciente['id_pac'] ?>" 
                                           class="inline-flex items-center px-3 py-1.5 bg-eps-blue-100 text-eps-blue-700 text-sm font-medium rounded-lg hover:bg-eps-blue-200 transition-colors duration-200"
                                           title="Editar paciente">
                                            <span class="mr-1">✏️</span>
                                            Editar
                                        </a>
                                        <button onclick="confirmDelete(<?= $paciente['id_pac'] ?>, '<?= htmlspecialchars($nombreCompleto) ?>')" 
                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors duration-200"
                                                title="Eliminar paciente">
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
            <h4 class="text-lg font-semibold text-gray-900 mb-4">📊 Distribución por Edades</h4>
            <div class="space-y-3">
                <?php 
                $edades = ['0-17' => 0, '18-35' => 0, '36-60' => 0, '60+' => 0];
                $total = count($this->d);
                
                foreach ($this->d as $p) {
                    $fechaNac = new DateTime($p['fec_pac']);
                    $edad = (new DateTime())->diff($fechaNac)->y;
                    
                    if ($edad <= 17) $edades['0-17']++;
                    elseif ($edad <= 35) $edades['18-35']++;
                    elseif ($edad <= 60) $edades['36-60']++;
                    else $edades['60+']++;
                }
                
                $labels = ['0-17' => 'Menores', '18-35' => 'Jóvenes', '36-60' => 'Adultos', '60+' => 'Mayores'];
                
                foreach ($edades as $rango => $count): 
                    $percentage = $total > 0 ? round(($count / $total) * 100, 1) : 0;
                ?>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600"><?= $labels[$rango] ?> (<?= $rango ?>)</span>
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
                    <span class="text-sm text-gray-600">Total de pacientes:</span>
                    <span class="text-sm font-semibold text-gray-900"><?= count($this->d) ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Pacientes activos:</span>
                    <span class="text-sm font-semibold text-green-600">
                        <?= count(array_filter($this->d, fn($p) => $p['est_pac'] === 'activo')) ?>
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Promedio de edad:</span>
                    <span class="text-sm font-semibold text-purple-600">
                        <?php
                        if (count($this->d) > 0) {
                            $sumaEdades = 0;
                            foreach ($this->d as $p) {
                                $fechaNac = new DateTime($p['fec_pac']);
                                $sumaEdades += (new DateTime())->diff($fechaNac)->y;
                            }
                            echo round($sumaEdades / count($this->d), 1) . ' años';
                        } else {
                            echo '0 años';
                        }
                        ?>
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Tasa de actividad:</span>
                    <span class="text-sm font-semibold text-eps-blue-600">
                        <?= count($this->d) > 0 ? round((count(array_filter($this->d, fn($p) => $p['est_pac'] === 'activo')) / count($this->d)) * 100, 1) : 0 ?>%
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Mostrando <span class="font-medium" id="visibleCount"><?= count($this->d) ?></span> pacientes
        </div>
    </div>
</div>

<script>
function confirmDelete(pacienteId, pacienteName) {
    if (confirm(`¿Estás seguro de que deseas eliminar a ${pacienteName}? Esta acción no se puede deshacer.`)) {
        window.location.href = '/paciente/delete/' + pacienteId;
    }
}

function refreshTable() {
    window.location.reload();
}

function clearFilters() {
    document.getElementById('searchPatient').value = '';
    document.getElementById('searchDNI').value = '';
    document.getElementById('filterStatus').value = '';
    document.getElementById('filterAge').value = '';
    filterTable();
}

function calculateAge(birthDate) {
    const today = new Date();
    const birth = new Date(birthDate);
    let age = today.getFullYear() - birth.getFullYear();
    const monthDiff = today.getMonth() - birth.getMonth();
    
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
        age--;
    }
    
    return age;
}

function filterTable() {
    const searchTerm = document.getElementById('searchPatient').value.toLowerCase();
    const searchDNI = document.getElementById('searchDNI').value;
    const statusFilter = document.getElementById('filterStatus').value;
    const ageFilter = document.getElementById('filterAge').value;
    
    const rows = document.querySelectorAll('.paciente-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
        let show = true;
        
        if (searchTerm && !row.dataset.nombre.includes(searchTerm)) {
            show = false;
        }
        
        if (searchDNI && !row.dataset.dni.includes(searchDNI)) {
            show = false;
        }
        
        if (statusFilter && row.dataset.estado !== statusFilter) {
            show = false;
        }
        
        if (ageFilter) {
            const edad = parseInt(row.dataset.edad);
            let ageMatch = false;
            
            switch (ageFilter) {
                case '0-17':
                    ageMatch = edad >= 0 && edad <= 17;
                    break;
                case '18-35':
                    ageMatch = edad >= 18 && edad <= 35;
                    break;
                case '36-60':
                    ageMatch = edad >= 36 && edad <= 60;
                    break;
                case '60+':
                    ageMatch = edad > 60;
                    break;
            }
            
            if (!ageMatch) {
                show = false;
            }
        }
        
        row.style.display = show ? '' : 'none';
        if (show) visibleCount++;
    });
    
    document.getElementById('visibleCount').textContent = visibleCount;
}

document.getElementById('searchPatient').addEventListener('input', filterTable);
document.getElementById('searchDNI').addEventListener('input', filterTable);
document.getElementById('filterStatus').addEventListener('change', filterTable);
document.getElementById('filterAge').addEventListener('change', filterTable);

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