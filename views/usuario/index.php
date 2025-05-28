<?php require_once 'views/components/header.php'; ?>

<div class="max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">👥 Gestión de Usuarios</h2>
            <p class="text-gray-600">Administra usuarios del sistema y sus permisos</p>
        </div>
        <div class="flex gap-3">
            <a href="/usuario/create" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                <span class="mr-2 text-lg">➕</span>
                Nuevo Usuario
            </a>
            <button onclick="refreshTable()" class="inline-flex items-center px-4 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-all duration-200">
                <span class="mr-2">🔄</span>
                Actualizar
            </button>
        </div>
    </div>

    <!-- Mensajes de éxito/error -->
    <?php if (isset($_GET['success'])): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
            <div class="flex items-center">
                <span class="text-lg mr-2">✅</span>
                <span><?= htmlspecialchars($_GET['success']) ?></span>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
            <div class="flex items-center">
                <span class="text-lg mr-2">⚠️</span>
                <span><?= htmlspecialchars($_GET['error']) ?></span>
            </div>
        </div>
    <?php endif; ?>

    <!-- Filtros -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar usuario</label>
                <input type="text" id="searchUser" placeholder="Nombre o email..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Rol</label>
                <select id="filterRole" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="">Todos los roles</option>
                    <option value="administrador">Administrador</option>
                    <option value="recepcionista">Recepcionista</option>
                    <option value="medico">Médico</option>
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
            <div class="flex items-end">
                <button onclick="clearFilters()" class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200">
                    Limpiar filtros
                </button>
            </div>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Usuarios</p>
                    <p class="text-2xl font-bold text-gray-900" id="totalUsuarios"><?= count($this->d) ?></p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">👥</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Activos</p>
                    <p class="text-2xl font-bold text-green-600" id="activosUsuarios">
                        <?= count(array_filter($this->d, fn($u) => $u['est_usuario'] === 'activo')) ?>
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
                    <p class="text-sm text-gray-600">Administradores</p>
                    <p class="text-2xl font-bold text-purple-600" id="adminUsuarios">
                        <?= count(array_filter($this->d, fn($u) => $u['rol_usuario'] === 'administrador')) ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">👑</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Médicos</p>
                    <p class="text-2xl font-bold text-orange-600" id="medicoUsuarios">
                        <?= count(array_filter($this->d, fn($u) => $u['rol_usuario'] === 'medico')) ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <span class="text-xl">🩺</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de usuarios -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Listado de Usuarios</h3>
        </div>

        <?php if (empty($this->d)): ?>
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">👥</div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay usuarios registrados</h3>
                <p class="text-gray-500 mb-6">Comienza agregando el primer usuario</p>
                <a href="/usuario/create" class="inline-flex items-center px-6 py-3 bg-eps-blue-600 text-white font-semibold rounded-lg hover:bg-eps-blue-700 transition-colors duration-200">
                    <span class="mr-2">➕</span>
                    Crear Primer Usuario
                </a>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full" id="usuariosTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Último Acceso</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($this->d as $usuario): ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-200 usuario-row"
                                data-nombre="<?= htmlspecialchars($usuario['nom_usuario'] . ' ' . $usuario['ape_usuario']) ?>"
                                data-email="<?= htmlspecialchars($usuario['email_usuario']) ?>"
                                data-rol="<?= htmlspecialchars($usuario['rol_usuario']) ?>"
                                data-estado="<?= htmlspecialchars($usuario['est_usuario']) ?>">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-eps-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <?php
                                            $roleIcons = [
                                                'administrador' => '👑',
                                                'recepcionista' => '📋',
                                                'medico' => '🩺'
                                            ];
                                            ?>
                                            <span class="text-eps-blue-600"><?= $roleIcons[$usuario['rol_usuario']] ?? '👤' ?></span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                <?= htmlspecialchars($usuario['nom_usuario'] . ' ' . $usuario['ape_usuario']) ?>
                                            </div>
                                            <div class="text-sm text-gray-500">ID: <?= $usuario['id_usuario'] ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"><?= htmlspecialchars($usuario['email_usuario']) ?></div>
                                    <div class="text-sm text-gray-500">
                                        Registrado: <?= date('d/m/Y', strtotime($usuario['fecha_creacion'])) ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                    $roleClasses = [
                                        'administrador' => 'bg-purple-100 text-purple-800',
                                        'recepcionista' => 'bg-blue-100 text-blue-800',
                                        'medico' => 'bg-green-100 text-green-800'
                                    ];
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $roleClasses[$usuario['rol_usuario']] ?? 'bg-gray-100 text-gray-800' ?>">
                                        <span class="mr-1"><?= $roleIcons[$usuario['rol_usuario']] ?? '👤' ?></span>
                                        <?= ucfirst($usuario['rol_usuario']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                    $statusClasses = [
                                        'activo' => 'bg-green-100 text-green-800',
                                        'inactivo' => 'bg-red-100 text-red-800'
                                    ];
                                    $statusIcons = [
                                        'activo' => '✅',
                                        'inactivo' => '❌'
                                    ];
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusClasses[$usuario['est_usuario']] ?? 'bg-gray-100 text-gray-800' ?>">
                                        <span class="mr-1"><?= $statusIcons[$usuario['est_usuario']] ?? '❓' ?></span>
                                        <?= ucfirst($usuario['est_usuario']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php if ($usuario['ultimo_acceso']): ?>
                                        <div class="text-sm text-gray-900">
                                            <?= date('d/m/Y', strtotime($usuario['ultimo_acceso'])) ?>
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            <?= date('H:i', strtotime($usuario['ultimo_acceso'])) ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-gray-400">Nunca</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="/usuario/edit/<?= $usuario['id_usuario'] ?>"
                                            class="inline-flex items-center px-3 py-1.5 bg-eps-blue-100 text-eps-blue-700 text-sm font-medium rounded-lg hover:bg-eps-blue-200 transition-colors duration-200"
                                            title="Editar usuario">
                                            <span class="mr-1">✏️</span>
                                            Editar
                                        </a>
                                        <?php if ($usuario['id_usuario'] != $_SESSION['user_id']): ?>
                                            <button onclick="confirmDelete(<?= $usuario['id_usuario'] ?>, '<?= htmlspecialchars($usuario['nom_usuario'] . ' ' . $usuario['ape_usuario']) ?>')"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors duration-200"
                                                title="Eliminar usuario">
                                                <span class="mr-1">🗑️</span>
                                                Eliminar
                                            </button>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-400 text-sm font-medium rounded-lg cursor-not-allowed" title="No puedes eliminar tu propio usuario">
                                                <span class="mr-1">🔒</span>
                                                Tu cuenta
                                            </span>
                                        <?php endif; ?>
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
            Mostrando <span class="font-medium" id="countVisible"><?= count($this->d) ?></span> usuarios
        </div>
        <div class="text-sm text-gray-500">
            Total: <?= count($this->d) ?> usuarios registrados
        </div>
    </div>
</div>

<script>
    function confirmDelete(userId, userName) {
        if (confirm(`¿Estás seguro de que deseas eliminar al usuario "${userName}"? Esta acción no se puede deshacer y también eliminará todas sus sesiones activas.`)) {
            window.location.href = '/usuario/delete/' + userId;
        }
    }

    function refreshTable() {
        window.location.reload();
    }

    function clearFilters() {
        document.getElementById('searchUser').value = '';
        document.getElementById('filterRole').value = '';
        document.getElementById('filterStatus').value = '';
        filterTable();
    }

    function filterTable() {
        const searchTerm = document.getElementById('searchUser').value.toLowerCase();
        const roleFilter = document.getElementById('filterRole').value;
        const statusFilter = document.getElementById('filterStatus').value;

        const rows = document.querySelectorAll('.usuario-row');
        let visibleCount = 0;

        rows.forEach(row => {
            let show = true;
            
            // Filtro de búsqueda (nombre o email)
            if (searchTerm) {
                const nombre = row.dataset.nombre.toLowerCase();
                const email = row.dataset.email.toLowerCase();
                if (!nombre.includes(searchTerm) && !email.includes(searchTerm)) {
                    show = false;
                }
            }

            // Filtro de rol
            if (roleFilter && row.dataset.rol !== roleFilter) {
                show = false;
            }

            // Filtro de estado
            if (statusFilter && row.dataset.estado !== statusFilter) {
                show = false;
            }

            row.style.display = show ? '' : 'none';
            if (show) visibleCount++;
        });

        // Actualizar contador
        document.getElementById('countVisible').textContent = visibleCount;
    }

    // Event listeners para filtros
    document.getElementById('searchUser').addEventListener('input', filterTable);
    document.getElementById('filterRole').addEventListener('change', filterTable);
    document.getElementById('filterStatus').addEventListener('change', filterTable);

    // Animación de entrada
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