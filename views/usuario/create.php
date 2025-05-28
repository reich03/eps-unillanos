<?php require_once 'views/components/header.php'; ?>

<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <a href="/usuario" class="inline-flex items-center text-eps-blue-600 hover:text-eps-blue-700 transition-colors duration-200 mr-4">
                <span class="mr-2">←</span>
                Volver a Usuarios
            </a>
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-2">➕ Crear Nuevo Usuario</h2>
        <p class="text-gray-600">Completa la información para crear un nuevo usuario del sistema</p>
    </div>

    <!-- Mostrar errores -->
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
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <span class="mr-2">👤</span>
                Información del Usuario
            </h3>
        </div>

        <form action="/usuario/store" method="POST" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombres -->
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
                        value="<?= htmlspecialchars($this->d['data']['nom_usuario'] ?? '') ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Ej: Juan Carlos"
                    >
                </div>

                <!-- Apellidos -->
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
                        value="<?= htmlspecialchars($this->d['data']['ape_usuario'] ?? '') ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Ej: García López"
                    >
                </div>

                <!-- Email -->
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
                        value="<?= htmlspecialchars($this->d['data']['email_usuario'] ?? '') ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Ej: usuario@epsunillanos.com"
                    >
                    <p class="text-sm text-gray-500 mt-1">Este será el nombre de usuario para iniciar sesión</p>
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="pass_usuario" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">🔒</span>
                            Contraseña <span class="text-red-500 ml-1">*</span>
                        </span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="pass_usuario" 
                            name="pass_usuario" 
                            required
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
                    <p class="text-sm text-gray-500 mt-1">Debe tener al menos 6 caracteres</p>
                </div>

                <!-- Confirmar Contraseña -->
                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            <span class="mr-2">🔒</span>
                            Confirmar Contraseña <span class="text-red-500 ml-1">*</span>
                        </span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="confirm_password" 
                            name="confirm_password" 
                            required
                            minlength="6"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 pr-12"
                            placeholder="Repite la contraseña"
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

                <!-- Rol -->
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
                    >
                        <option value="">Seleccionar rol...</option>
                        <option value="administrador" <?= ($this->d['data']['rol_usuario'] ?? '') === 'administrador' ? 'selected' : '' ?>>
                            👑 Administrador
                        </option>
                        <option value="recepcionista" <?= ($this->d['data']['rol_usuario'] ?? '') === 'recepcionista' ? 'selected' : '' ?>>
                            📋 Recepcionista
                        </option>
                        <option value="medico" <?= ($this->d['data']['rol_usuario'] ?? '') === 'medico' ? 'selected' : '' ?>>
                            🩺 Médico
                        </option>
                    </select>
                    <div id="role-description" class="text-sm text-gray-600 mt-2 p-3 bg-gray-50 rounded-lg hidden">
                        <!-- Descripción del rol se mostrará aquí -->
                    </div>
                </div>

                <!-- Estado -->
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
                    >
                        <option value="activo" <?= ($this->d['data']['est_usuario'] ?? 'activo') === 'activo' ? 'selected' : '' ?>>
                            ✅ Activo
                        </option>
                        <option value="inactivo" <?= ($this->d['data']['est_usuario'] ?? '') === 'inactivo' ? 'selected' : '' ?>>
                            ❌ Inactivo
                        </option>
                    </select>
                    <p class="text-sm text-gray-500 mt-1">Los usuarios inactivos no pueden iniciar sesión</p>
                </div>
            </div>

            <!-- Botones -->
            <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                <a href="/usuario" class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-all duration-200">
                    <span class="mr-2">❌</span>
                    Cancelar
                </a>
                <button 
                    type="submit" 
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-lg hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl"
                >
                    <span class="mr-2">💾</span>
                    Crear Usuario
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

    // Validar coincidencia de contraseñas
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

    // Event listeners
    document.getElementById('pass_usuario').addEventListener('input', validatePasswordMatch);
    document.getElementById('confirm_password').addEventListener('input', validatePasswordMatch);

    // Validación de formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.getElementById('pass_usuario').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Las contraseñas no coinciden. Por favor, verifica e intenta nuevamente.');
            return false;
        }

        if (password.length < 6) {
            e.preventDefault();
            alert('La contraseña debe tener al menos 6 caracteres.');
            return false;
        }
    });

    // Animación de entrada
    document.addEventListener('DOMContentLoaded', function() {
        showRoleDescription(); // Mostrar descripción si hay rol preseleccionado
        
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