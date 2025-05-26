<?php require_once 'views/components/header.php'; ?>

<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Panel de Administración</h2>
        <div class="text-sm text-gray-500">
            Última actualización: <?= date('d/m/Y H:i:s') ?>
        </div>
    </div>

    <!-- Cards de estadísticas principales -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Total Citas -->
        <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <span class="text-white text-xl">📅</span>
                        </div>
                    </div>
                    <div class="ml-4 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Citas</dt>
                            <dd class="text-3xl font-bold text-gray-900"><?= $this->d['total_citas'] ?? 0 ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Citas Pendientes -->
        <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                            <span class="text-white text-xl">⏳</span>
                        </div>
                    </div>
                    <div class="ml-4 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Pendientes</dt>
                            <dd class="text-3xl font-bold text-yellow-600"><?= $this->d['citas_pendientes'] ?? 0 ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Citas Completadas -->
        <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <span class="text-white text-xl">✅</span>
                        </div>
                    </div>
                    <div class="ml-4 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Completadas</dt>
                            <dd class="text-3xl font-bold text-green-600"><?= $this->d['citas_completadas'] ?? 0 ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Citas Canceladas -->
        <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-500 rounded-md flex items-center justify-center">
                            <span class="text-white text-xl">❌</span>
                        </div>
                    </div>
                    <div class="ml-4 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Canceladas</dt>
                            <dd class="text-3xl font-bold text-red-600"><?= $this->d['citas_canceladas'] ?? 0 ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Médicos Activos -->
        <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-indigo-500 rounded-md flex items-center justify-center">
                            <span class="text-white text-xl">🩺</span>
                        </div>
                    </div>
                    <div class="ml-4 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Médicos Activos</dt>
                            <dd class="text-3xl font-bold text-indigo-600"><?= $this->d['total_medicos'] ?? 0 ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pacientes -->
        <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                            <span class="text-white text-xl">👥</span>
                        </div>
                    </div>
                    <div class="ml-4 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Pacientes</dt>
                            <dd class="text-3xl font-bold text-purple-600"><?= $this->d['total_pacientes'] ?? 0 ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de citas por día -->
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-gray-900">Citas por Día (últimos 7 días)</h3>
            <div class="text-sm text-gray-500">
                Total: <?= array_sum(array_column($this->d['citas_por_dia'] ?? [], 'cantidad')) ?> citas
            </div>
        </div>
        
        <?php if (empty($this->d['citas_por_dia'])): ?>
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">📊</div>
                <p class="text-gray-500 text-lg">No hay datos de citas en los últimos 7 días</p>
                <p class="text-gray-400 text-sm mt-2">Los datos aparecerán cuando se registren citas</p>
            </div>
        <?php else: ?>
            <div class="relative" style="height: 400px;">
                <canvas id="citasChart"></canvas>
            </div>
        <?php endif; ?>
    </div>

    <!-- Debug info (remover en producción) -->
    <?php if (isset($_GET['debug'])): ?>
        <div class="mt-8 bg-gray-800 text-white p-4 rounded">
            <h4 class="font-bold mb-2">Debug Info:</h4>
            <pre><?= json_encode($this->d, JSON_PRETTY_PRINT) ?></pre>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
<?php if (!empty($this->d['citas_por_dia'])): ?>
    const citasPorDia = <?= json_encode($this->d['citas_por_dia']) ?>;
    const fechas = citasPorDia.map(item => {
        const fecha = new Date(item.fecha);
        return fecha.toLocaleDateString('es-ES', { 
            weekday: 'short', 
            day: '2-digit', 
            month: '2-digit' 
        });
    });
    const cantidades = citasPorDia.map(item => parseInt(item.cantidad));

    const ctx = document.getElementById('citasChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: fechas,
            datasets: [{
                label: 'Número de Citas',
                data: cantidades,
                borderWidth: 3,
                borderColor: 'rgba(59, 130, 246, 1)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: { 
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
<?php endif; ?>
</script>

<?php require_once 'views/components/footer.php'; ?>