<?php require_once 'views/components/header.php'; ?>

<div class="max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">📅 Gestión de Citas</h2>
            <p class="text-gray-600">Administra y supervisa todas las citas médicas programadas</p>
        </div>
        <div class="flex gap-3">
            <a href="/cita/create" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                <span class="mr-2 text-lg">➕</span>
                Nueva Cita
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
                <input type="text" id="searchPatient" placeholder="Nombre del paciente..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                <select id="filterStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="">Todos los estados</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="completada">Completada</option>
                    <option value="cancelada">Cancelada</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Fecha</label>
                <input type="date" id="filterDate" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
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
                    <p class="text-sm text-gray-600">Total Citas</p>
                    <p class="text-2xl font-bold text-gray-900" id="totalCitas"><?= count($this->d) ?></p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">📅</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Pendientes</p>
                    <p class="text-2xl font-bold text-yellow-600" id="pendientesCitas">
                        <?= count(array_filter($this->d, fn($c) => $c['est_cita'] === 'pendiente')) ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">⏳</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Completadas</p>
                    <p class="text-2xl font-bold text-green-600" id="completadasCitas">
                        <?= count(array_filter($this->d, fn($c) => $c['est_cita'] === 'completada')) ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">✅</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Canceladas</p>
                    <p class="text-2xl font-bold text-red-600" id="canceladasCitas">
                        <?= count(array_filter($this->d, fn($c) => $c['est_cita'] === 'cancelada')) ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">❌</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Listado de Citas</h3>
        </div>

        <?php if (empty($this->d)): ?>
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">📅</div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay citas registradas</h3>
                <p class="text-gray-500 mb-6">Comienza agregando la primera cita médica</p>
                <a href="/cita/create" class="inline-flex items-center px-6 py-3 bg-eps-blue-600 text-white font-semibold rounded-lg hover:bg-eps-blue-700 transition-colors duration-200">
                    <span class="mr-2">➕</span>
                    Crear Primera Cita
                </a>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full" id="citasTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paciente</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha y Hora</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Médico</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Consultorio</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Servicio</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($this->d as $index => $cita): ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-200 cita-row"
                                data-paciente="<?= htmlspecialchars($cita['id_pac']) ?>"
                                data-estado="<?= htmlspecialchars($cita['est_cita']) ?>">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        #<?= str_pad($cita['id_cita'], 4, '0', STR_PAD_LEFT) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-eps-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-eps-blue-600 font-medium">👤</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Paciente ID: <?= $cita['id_pac'] ?></div>
                                            <div class="text-sm font-medium text-gray-900">Nombre: <?= $cita['nombre_paciente'] ?></div>
                                            <div class="text-sm text-gray-500">Información del paciente</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Horario ID: <?= $cita['id_horario'] ?></div>
                                    <div class="text-sm text-gray-900">Horario y doctor: <?= $cita['detalle_horario'] ?></div>
                                    <div class="text-sm text-gray-500">Ver detalles de horario</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="mr-2">🩺</span>
                                        <span class="text-sm text-gray-900">Ver médico asignado</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="mr-2">🏥</span>
                                        <span class="text-sm text-gray-900">Consultorio <?= $cita['id_con'] ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="mr-2">🧾</span>
                                        <span class="text-sm text-gray-900">Servicio <?= $cita['id_serv'] ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                    $statusClasses = [
                                        'pendiente' => 'bg-yellow-100 text-yellow-800',
                                        'completada' => 'bg-green-100 text-green-800',
                                        'cancelada' => 'bg-red-100 text-red-800'
                                    ];
                                    $statusIcons = [
                                        'pendiente' => '⏳',
                                        'completada' => '✅',
                                        'cancelada' => '❌'
                                    ];
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusClasses[$cita['est_cita']] ?? 'bg-gray-100 text-gray-800' ?>">
                                        <span class="mr-1"><?= $statusIcons[$cita['est_cita']] ?? '❓' ?></span>
                                        <?= ucfirst($cita['est_cita']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="/cita/edit/<?= $cita['id_cita'] ?>"
                                            class="inline-flex items-center px-3 py-1.5 bg-eps-blue-100 text-eps-blue-700 text-sm font-medium rounded-lg hover:bg-eps-blue-200 transition-colors duration-200"
                                            title="Editar cita">
                                            <span class="mr-1">✏️</span>
                                            Editar
                                        </a>
                                        <button onclick="confirmDelete(<?= $cita['id_cita'] ?>)"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors duration-200"
                                            title="Eliminar cita">
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

    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Mostrando <span class="font-medium"><?= count($this->d) ?></span> citas
        </div>
        <div class="text-sm text-gray-500">
        </div>
    </div>
</div>

<script>
    function confirmDelete(citaId) {
        if (confirm('¿Estás seguro de que deseas eliminar esta cita? Esta acción no se puede deshacer.')) {
            window.location.href = '/cita/delete/' + citaId;
        }
    }

    function refreshTable() {
        window.location.reload();
    }

    function clearFilters() {
        document.getElementById('searchPatient').value = '';
        document.getElementById('filterStatus').value = '';
        document.getElementById('filterDate').value = '';
        filterTable();
    }

    function filterTable() {
        const searchTerm = document.getElementById('searchPatient').value.toLowerCase();
        const statusFilter = document.getElementById('filterStatus').value;
        const dateFilter = document.getElementById('filterDate').value;

        const rows = document.querySelectorAll('.cita-row');
        let visibleCount = 0;

        rows.forEach(row => {
            let show = true;
            if (searchTerm && !row.dataset.paciente.toLowerCase().includes(searchTerm)) {
                show = false;
            }

            if (statusFilter && row.dataset.estado !== statusFilter) {
                show = false;
            }

            row.style.display = show ? '' : 'none';
            if (show) visibleCount++;
        });

        const counter = document.querySelector('.text-sm.text-gray-700 span');
        if (counter) {
            counter.textContent = visibleCount;
        }
    }

    document.getElementById('searchPatient').addEventListener('input', filterTable);
    document.getElementById('filterStatus').addEventListener('change', filterTable);
    document.getElementById('filterDate').addEventListener('change', filterTable);

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