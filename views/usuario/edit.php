<?php require_once 'views/components/header.php'; ?>

<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <a href="/usuario" class="inline-flex items-center text-eps-blue-600 hover:text-eps-blue-700 transition-colors duration-200 mr-4">
                <span class="mr-2">←</span>
                Volver a Usuarios
            </a>
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-2">✏️ Editar Usuario</h2>
        <p class="text-gray-600">Modifica la información del usuario <?= htmlspecialchars($this->d['usuario']['nom_usuario'] . ' ' . $this->d['usuario']['ape_usuario']) ?></p>
    </div>

    <?php if (isset($this->d['errors']) && !empty($this->d['errors'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
            <div class="flex items-start">
                <span class="text-lg mr-2 mt-0.5">⚠️</span>
                <div>
                    <p class="font-medium mb-2">Se encontraron los siguientes errores:</p>
                    <ul class="list-disc list-inside space-y-1">
                        <?php foreach ($this->d['errors'] as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-eps-blue-50 to-eps-blue-100">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-eps-blue-500 rounded-full flex items-center justify-center mr-4">
                        <?php
                        $roleIcons = [
                            'administrador' => '👑',
                            'recepcionista' => '📋',
                            'medico' => '🩺'
                        ];
                        ?>
                        <span class="text-white text-xl"><?= $roleIcons[$this->d['usuario']['rol_usuario']] ?? '👤' ?></span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">
                            <?= htmlspecialchars($this->d['usuario']['nom_usuario'] . ' ' . $this->d['usuario']['ape_usuario']) ?>
                        </h3>
                        <p class="text-sm text-gray-600">
                            ID: <?= $this->d['usuario']['id_usuario'] ?> • 
                            Registrado: <?= date('d/m/Y', strtotime($this->d['usuario']['fecha_creacion'])) ?>
                            <?php if ($this->d['usuario']['ultimo_acceso']): ?>
                                • Último acceso: <?= date('d/m/Y H:i', strtotime($this->d['usuario']['ultimo_acceso'])) ?>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <div class="text-right">
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
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?= $statusClasses[$this->d['usuario']['est_usuario']] ?? 'bg-gray-100 text-gray-800' ?>">
                        <span class="mr-1"><?= $statusIcons[$this->d['usuario']['est_usuario']] ?? '❓' ?></span>
                        <?= ucfirst($this->d['usuario']['est_usuario']) ?>
                    </span>
                </div>
            </div>
        </div>

        <form action="/usuario/update" method="POST" class="p-6">
            <input type="hidden" name="id_usuario" value="<?= $this->d['usuario']['id_usuario'] ?>">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nom_usuario" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">📝</span>
                            Nombres <span class="text-red-500 ml-1">*</span>
                        </span>
                    </label>
                    <input 
                        type="text" 
                        id="nom_usuario" 
                        name="nom_usuario" 
                        required
                        value="<?= htmlspecialchars($this->d['usuario']['nom_usuario']) ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Ej: Juan Carlos"
                    >
                </div>

                <div>
                    <label for="ape_usuario" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">📝</span>
                            Apellidos <span class="text-red-500 ml-1">*</span>
                        </span>
                    </label>
                    <input 
                        type="text" 
                        id="ape_usuario" 
                        name="ape_usuario" 
                        required
                        value="<?= htmlspecialchars($this->d['usuario']['ape_usuario']) ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Ej: García López"
                    >
                </div>

                <div class="md:col-span-2">
                    <label for="email_usuario" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">📧</span>
                            Correo Electrónico <span class="text-red-500 ml-1">*</span>
                        </span>
                    </label>
                    <input 
                        type="email" 
                        id="email_usuario" 
                        name="email_usuario" 
                        required
                        value="<?= htmlspecialchars($this->d['usuario']['email_usuario']) ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Ej: usuario@epsunillanos.com"
                    >
                    <p class="text-sm text-gray-500 mt-1">Este será el nombre de usuario para iniciar sesión</p>
                </div>

                <div class="md:col-span-2">
                    <div class="border border-gray-200 rounded-lg">
                        <button 
                            type="button" 
                            onclick="togglePasswordSection()" 
                            class="w-full px-4 py-3 bg-gray-50 hover:bg-gray-100 rounded-t-lg transition-colors duration-200 flex items-center justify-between"
                        >
                            <span class="flex items-center text-sm font-medium text-gray-700">
                                <span class="mr-2">🔒</span>
                                Cambiar Contraseña
                            </span>
                            <span id="password-toggle-icon" class="text-gray-500">▼</span>
                        </button>
                        
                        <div id="password-section" class="hidden border-t border-gray-200">
                            <div class="p-4 bg-yellow-50">
                                <p class="text-sm text-yellow-800 mb-4 flex items-center">
                                    <span class="mr-2">ℹ️</span>
                                    Deja estos campos vacíos si no deseas cambiar la contraseña
                                </p>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="pass_usuario" class="block text-sm font-medium text-gray-700 mb-2">
                                            <span class="flex items-center">
                                                <span class="mr-2">🔑</span>
                                                Nueva Contraseña
                                            </span>
                                        </label>
                                        <div class="relative">
                                            <input 
                                                type="password" 
                                                id="pass_usuario" 
                                                name="pass_usuario" 
                                                minlength="6"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 pr-12"
                                                placeholder="Mínimo 6 caracteres"
                                            >
                                            <button 
                                                type="button" 
                                                onclick="togglePassword('pass_usuario', 'toggle-icon-1')" 
                                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600"
                                            >
                                                <span id="toggle-icon-1">👁️</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">
                                            <span class="flex items-center">
                                                <span class="mr-2">🔑</span>
                                                Confirmar Nueva Contraseña
                                            </span>
                                        </label>
                                        <div class="relative">
                                            <input 
                                                type="password" 
                                                id="confirm_password" 
                                                name="confirm_password" 
                                                minlength="6"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 pr-12"
                                                placeholder="Repite la nueva contraseña"
                                            >
                                            <button 
                                                type="button" 
                                                onclick="togglePassword('confirm_password', 'toggle-icon-2')" 
                                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600"
                                            >
                                                <span id="toggle-icon-2">👁️</span>
                                            </button>
                                        </div>
                                        <p id="password-match" class="text-sm mt-1 hidden"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="rol_usuario" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">👑</span>
                            Rol del Usuario <span class="text-red-500 ml-1">*</span>
                        </span>
                    </label>
                    <select 
                        id="rol_usuario" 
                        name="rol_usuario" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200"
                        onchange="showRoleDescription()"
                        <?= ($this->d['usuario']['id_usuario'] == $_SESSION['user_id']) ? 'disabled' : '' ?>
                    >
                        <option value="administrador" <?= $this->d['usuario']['rol_usuario'] === 'administrador' ? 'selected' : '' ?>>
                            👑 Administrador
                        </option>
                        <option value="recepcionista" <?= $this->d['usuario']['rol_usuario'] === 'recepcionista' ? 'selected' : '' ?>>
                            📋 Recepcionista
                        </option>
                        <option value="medico" <?= $this->d['usuario']['rol_usuario'] === 'medico' ? 'selected' : '' ?>>
                            🩺 Médico
                        </option>
                    </select>
                    
                    <?php if ($this->d['usuario']['id_usuario'] == $_SESSION['user_id']): ?>
                        <input type="hidden" name="rol_usuario" value="<?= $this->d['usuario']['rol_usuario'] ?>">
                        <p class="text-sm text-orange-600 mt-1 flex items-center">
                            <span class="mr-1">⚠️</span>
                            No puedes cambiar tu propio rol
                        </p>
                    <?php endif; ?>
                    
                    <div id="role-description" class="text-sm text-gray-600 mt-2 p-3 bg-gray-50 rounded-lg hidden">
                    </div>
                </div>

                <div>
                    <label for="est_usuario" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">✅</span>
                            Estado <span class="text-red-500 ml-1">*</span>
                        </span>
                    </label>
                    <select 
                        id="est_usuario" 
                        name="est_usuario" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200"
                        <?= ($this->d['usuario']['id_usuario'] == $_SESSION['user_id']) ? 'disabled' : '' ?>
                    >
                        <option value="activo" <?= $this->d['usuario']['est_usuario'] === 'activo' ? 'selected' : '' ?>>
                            ✅ Activo
                        </option>
                        <option value="inactivo" <?= $this->d['usuario']['est_usuario'] === 'inactivo' ? 'selected' : '' ?>>
                            ❌ Inactivo
                        </option>
                    </select>
                    
                    <?php if ($this->d['usuario']['id_usuario'] == $_SESSION['user_id']): ?>
                        <input type="hidden" name="est_usuario" value="<?= $this->d['usuario']['est_usuario'] ?>">
                        <p class="text-sm text-orange-600 mt-1 flex items-center">
                            <span class="mr-1">⚠️</span>
                            No puedes cambiar tu propio estado
                        </p>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 mt-1">Los usuarios inactivos no pueden iniciar sesión</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                    <span class="mr-2">📊</span>
                    Información del Usuario
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">ID de Usuario:</span>
                        <span class="font-medium text-gray-900 ml-2">#<?= $this->d['usuario']['id_usuario'] ?></span>
                    </div>
                    <div>
                        <span class="text-gray-500">Fecha de Registro:</span>
                        <span class="font-medium text-gray-900 ml-2"><?= date('d/m/Y H:i', strtotime($this->d['usuario']['fecha_creacion'])) ?></span>
                    </div>
                    <div>
                        <span class="text-gray-500">Último Acceso:</span>
                        <span class="font-medium text-gray-900 ml-2">
                            <?php if ($this->d['usuario']['ultimo_acceso']): ?>
                                <?= date('d/m/Y H:i', strtotime($this->d['usuario']['ultimo_acceso'])) ?>
                            <?php else: ?>
                                <span class="text-gray-400">Nunca</span>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                <a href="/usuario" class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-all duration-200">
                    <span class="mr-2">❌</span>
                    Cancelar
                </a>
                <button 
                    type="submit" 
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-eps-blue-500 to-eps-blue-600 text-white font-semibold rounded-lg hover:from-eps-blue-600 hover:to-eps-blue-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl"
                >
                    <span class="mr-2">💾</span>
                    Actualizar Usuario
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.textContent = '🙈';
        } else {
            passwordInput.type = 'password';
            toggleIcon.textContent = '👁️';
        }
    }

    function togglePasswordSection() {
        const passwordSection = document.getElementById('password-section');
        const toggleIcon = document.getElementById('password-toggle-icon');
        
        if (passwordSection.classList.contains('hidden')) {
            passwordSection.classList.remove('hidden');
            toggleIcon.textContent = '▲';
        } else {
            passwordSection.classList.add('hidden');
            toggleIcon.textContent = '▼';
        }
    }

    function showRoleDescription() {
        const roleSelect = document.getElementById('rol_usuario');
        const roleDescription = document.getElementById('role-description');
        const selectedRole = roleSelect.value;

        const descriptions = {
            'administrador': '👑 <strong>Administrador:</strong> Acceso completo al sistema. Puede gestionar usuarios, configuraciones y todos los módulos.',
            'recepcionista': '📋 <strong>Recepcionista:</strong> Gestión de citas, pacientes y consultas. Ideal para personal de recepción.',
            'medico': '🩺 <strong>Médico:</strong> Gestión de horarios y consulta de información médica. Acceso limitado a su área de trabajo.'
        };

        if (selectedRole && descriptions[selectedRole]) {
            roleDescription.innerHTML = descriptions[selectedRole];
            roleDescription.classList.remove('hidden');
        } else {
            roleDescription.classList.add('hidden');
        }
    }

    function validatePasswordMatch() {
        const password = document.getElementById('pass_usuario').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const matchMessage = document.getElementById('password-match');

        if (confirmPassword.length > 0) {
            if (password === confirmPassword) {
                matchMessage.textContent = '✅ Las contraseñas coinciden';
                matchMessage.className = 'text-sm mt-1 text-green-600';
                matchMessage.classList.remove('hidden');
            } else {
                matchMessage.textContent = '❌ Las contraseñas no coinciden';
                matchMessage.className = 'text-sm mt-1 text-red-600';
                matchMessage.classList.remove('hidden');
            }
        } else {
            matchMessage.classList.add('hidden');
        }
    }

    document.getElementById('pass_usuario').addEventListener('input', validatePasswordMatch);
    document.getElementById('confirm_password').addEventListener('input', validatePasswordMatch);
    document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.getElementById('pass_usuario').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        if (password.length > 0 || confirmPassword.length > 0) {
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Las contraseñas no coinciden. Por favor, verifica e intenta nuevamente.');
                return false;
            }

            if (password.length > 0 && password.length < 6) {
                e.preventDefault();
                alert('La contraseña debe tener al menos 6 caracteres.');
                return false;
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        showRoleDescription(); 
        
        const form = document.querySelector('.bg-white');
        form.style.opacity = '0';
        form.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            form.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
            form.style.opacity = '1';
            form.style.transform = 'translateY(0)';
        }, 100);
    });
</script>

<?php require_once 'views/components/footer.php'; ?>