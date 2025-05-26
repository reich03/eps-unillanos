<?php require_once 'views/components/header.php'; ?>

<div class="max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">🕒 Gestión de Horarios</h2>
            <p class="text-gray-600">Administra los horarios de atención médica disponibles</p>
        </div>
        <div class="flex gap-3">
            <a href="/horario/create" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                <span class="mr-2 text-lg">➕</span>
                Nuevo Horario
            </a>
            <button onclick="refreshTable()" class="inline-flex items-center px-4 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-all duration-200">
                <span class="mr-2">🔄</span>
                Actualizar
            </button>
        </div>
    </div>

    <!-- Filtros y búsqueda -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar médico</label>
                <input type="text" id="searchDoctor" placeholder="Nombre del médico..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Fecha</label>
                <input type="date" id="filterDate" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                <select id="filterStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="">Todos los estados</option>
                    <option value="disponible">Disponible</option>
                    <option value="ocupado">Ocupado</option>
                </select>
            </div>
            <div class="flex items-end">
                <button onclick="clearFilters()" class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200">
                    Limpiar filtros
                </button>
            </div>
        </div>
        
        <!-- Filtros rápidos por tiempo -->
        <div class="mt-4 flex flex-wrap gap-2">
            <button onclick="filterByTime('today')" class="px-3 py-1 bg-eps-blue-100 text-eps-blue-700 rounded-full text-sm hover:bg-eps-blue-200 transition-colors duration-200">
                Hoy
            </button>
            <button onclick="filterByTime('tomorrow')" class="px-3 py-1 bg-eps-blue-100 text-eps-blue-700 rounded-full text-sm hover:bg-eps-blue-200 transition-colors duration-200">
                Mañana
            </button>
            <button onclick="filterByTime('week')" class="px-3 py-1 bg-eps-blue-100 text-eps-blue-700 rounded-full text-sm hover:bg-eps-blue-200 transition-colors duration-200">
                Esta semana
            </button>
            <button onclick="filterByTime('available')" class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm hover:bg-green-200 transition-colors duration-200">
                Solo disponibles
            </button>
        </div>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Horarios</p>
                    <p class="text-2xl font-bold text-gray-900" id="totalHorarios"><?= count($this->d) ?></p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">🕒</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Disponibles</p>
                    <p class="text-2xl font-bold text-green-600" id="disponiblesHorarios">
                        <?= count(array_filter($this->d, fn($h) => $h['est_horario'] === 'disponible')) ?>
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
                    <p class="text-sm text-gray-600">Ocupados</p>
                    <p class="text-2xl font-bold text-red-600" id="ocupadosHorarios">
                        <?= count(array_filter($this->d, fn($h) => $h['est_horario'] === 'ocupado')) ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">🔒</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Para Hoy</p>
                    <p class="text-2xl font-bold text-purple-600" id="hoyHorarios">
                        <?php
                        $today = date('Y-m-d');
                        echo count(array_filter($this->d, fn($h) => $h['fecha'] === $today));
                        ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">📅</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Vista de calendario semanal -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">📅 Vista Semanal</h3>
        <div class="grid grid-cols-7 gap-2" id="weeklyView">
            <!-- Se llenará con JavaScript -->
        </div>
    </div>

    <!-- Tabla de horarios -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Listado de Horarios</h3>
        </div>
        
        <?php if (empty($this->d)): ?>
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">🕒</div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay horarios registrados</h3>
                <p class="text-gray-500 mb-6">Comienza agregando el primer horario disponible</p>
                <a href="/horario/create" class="inline-flex items-center px-6 py-3 bg-eps-blue-600 text-white font-semibold rounded-lg hover:bg-eps-blue-700 transition-colors duration-200">
                    <span class="mr-2">➕</span>
                    Crear Primer Horario
                </a>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full" id="horariosTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Médico</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha y Hora</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Especialidad</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($this->d as $index => $horario): ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-200 horario-row" 
                                data-medico="<?= htmlspecialchars(strtolower($horario['nom_med'])) ?>" 
                                data-fecha="<?= htmlspecialchars($horario['fecha']) ?>"
                                data-estado="<?= htmlspecialchars($horario['est_horario']) ?>">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-r from-eps-blue-500 to-eps-blue-600 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-white font-bold text-sm">
                                                <?= strtoupper(substr($horario['nom_med'], 0, 2)) ?>
                                            </span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                Dr. <?= htmlspecialchars($horario['nom_med']) ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                ID: <?= str_pad($horario['id_horario'], 3, '0', STR_PAD_LEFT) ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                <?php
                                                $fecha = new DateTime($horario['fecha']);
                                                echo $fecha->format('d/m/Y');
                                                ?>
                                            </div>
                                            <div class="text-sm text-gray-500 flex items-center">
                                                <span class="mr-1">🕐</span>
                                                <?php
                                                $hora = new DateTime($horario['hora']);
                                                echo $hora->format('H:i');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <?php
                                            $fechaHoy = new DateTime();
                                            $fechaHorario = new DateTime($horario['fecha']);
                                            $diff = $fechaHoy->diff($fechaHorario);
                                            
                                            if ($fechaHorario < $fechaHoy) {
                                                echo '<span class="px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded-full">Pasado</span>';
                                            } elseif ($fechaHorario->format('Y-m-d') === $fechaHoy->format('Y-m-d')) {
                                                echo '<span class="px-2 py-1 text-xs bg-blue-100 text-blue-600 rounded-full">Hoy</span>';
                                            } elseif ($diff->days <= 7) {
                                                echo '<span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded-full">Esta semana</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        <span class="mr-1">⚕️</span>
                                        Especialidad
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($horario['est_horario'] === 'disponible'): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <span class="mr-1">✅</span>
                                            Disponible
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <span class="mr-1">🔒</span>
                                            Ocupado
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="/horario/edit/<?= $horario['id_horario'] ?>" 
                                           class="inline-flex items-center px-3 py-1.5 bg-eps-blue-100 text-eps-blue-700 text-sm font-medium rounded-lg hover:bg-eps-blue-200 transition-colors duration-200"
                                           title="Editar horario">
                                            <span class="mr-1">✏️</span>
                                            Editar
                                        </a>
                                        <button onclick="confirmDelete(<?= $horario['id_horario'] ?>, '<?= htmlspecialchars($horario['nom_med']) ?>', '<?= $horario['fecha'] ?>', '<?= $horario['hora'] ?>')" 
                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors duration-200"
                                                title="Eliminar horario">
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

    <!-- Contador de resultados -->
    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Mostrando <span class="font-medium" id="visibleCount"><?= count($this->d) ?></span> horarios
        </div>
    </div>
</div>

<script>
// Datos de horarios para JavaScript
const horariosData = <?= json_encode($this->d) ?>;

// Función para confirmar eliminación
function confirmDelete(horarioId, medicoName, fecha, hora) {
    if (confirm(`¿Estás seguro de que deseas eliminar el horario del Dr. ${medicoName} para el ${fecha} a las ${hora}? Esta acción no se puede deshacer.`)) {
        window.location.href = '/horario/delete/' + horarioId;
    }
}

// Función para refrescar la tabla
function refreshTable() {
    window.location.reload();
}

// Función para limpiar filtros
function clearFilters() {
    document.getElementById('searchDoctor').value = '';
    document.getElementById('filterDate').value = '';
    document.getElementById('filterStatus').value = '';
    filterTable();
}

// Función para filtrar por tiempo
function filterByTime(period) {
    const today = new Date();
    const filterDate = document.getElementById('filterDate');
    
    switch (period) {
        case 'today':
            filterDate.value = today.toISOString().split('T')[0];
            break;
        case 'tomorrow':
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            filterDate.value = tomorrow.toISOString().split('T')[0];
            break;
        case 'week':
            // Limpiar fecha para mostrar toda la semana
            filterDate.value = '';
            break;
        case 'available':
            document.getElementById('filterStatus').value = 'disponible';
            break;
    }
    
    filterTable();
}

// Función para filtrar la tabla
function filterTable() {
    const searchTerm = document.getElementById('searchDoctor').value.toLowerCase();
    const dateFilter = document.getElementById('filterDate').value;
    const statusFilter = document.getElementById('filterStatus').value;
    
    const rows = document.querySelectorAll('.horario-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
        let show = true;
        
        // Filtro por médico
        if (searchTerm && !row.dataset.medico.includes(searchTerm)) {
            show = false;
        }
        
        // Filtro por fecha
        if (dateFilter && row.dataset.fecha !== dateFilter) {
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

// Crear vista semanal
function createWeeklyView() {
    const weeklyView = document.getElementById('weeklyView');
    const today = new Date();
    const startOfWeek = new Date(today);
    startOfWeek.setDate(today.getDate() - today.getDay());
    
    const days = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
    
    for (let i = 0; i < 7; i++) {
        const date = new Date(startOfWeek);
        date.setDate(startOfWeek.getDate() + i);
        const dateStr = date.toISOString().split('T')[0];
        
        const dayHorarios = horariosData.filter(h => h.fecha === dateStr);
        const disponibles = dayHorarios.filter(h => h.est_horario === 'disponible').length;
        
        const dayDiv = document.createElement('div');
        dayDiv.className = 'text-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer transition-colors duration-200';
        dayDiv.onclick = () => {
            document.getElementById('filterDate').value = dateStr;
            filterTable();
        };
        
        dayDiv.innerHTML = `
            <div class="text-sm font-medium text-gray-600">${days[i]}</div>
            <div class="text-lg font-bold text-gray-900">${date.getDate()}</div>
            <div class="text-xs text-gray-500">${dayHorarios.length} horarios</div>
            <div class="text-xs text-green-600">${disponibles} disponibles</div>
        `;
        
        if (date.toDateString() === today.toDateString()) {
            dayDiv.classList.add('bg-eps-blue-50', 'border-eps-blue-300');
        }
        
        weeklyView.appendChild(dayDiv);
    }
}

// Event listeners para filtros
document.getElementById('searchDoctor').addEventListener('input', filterTable);
document.getElementById('filterDate').addEventListener('change', filterTable);
document.getElementById('filterStatus').addEventListener('change', filterTable);

// Inicializar vista semanal
document.addEventListener('DOMContentLoaded', function() {
    createWeeklyView();
    
    // Animaciones de entrada
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