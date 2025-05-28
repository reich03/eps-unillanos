<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - EPS Unillanos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'eps-blue': {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-eps-blue-50 via-white to-eps-blue-100 min-h-screen flex items-center justify-center p-4">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-eps-blue-200 opacity-20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-eps-blue-300 opacity-15 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-2xl p-8 backdrop-blur-sm border border-white/20">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-eps-blue-500 to-eps-blue-600 rounded-2xl shadow-lg mb-4">
                    <span class="text-4xl text-white">🏥</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">EPS Unillanos</h1>
                <p class="text-gray-600">Sistema de Gestión Médica</p>
            </div>

            <form action="/auth/login" method="POST" class="space-y-6">
                <?php if (isset($this->d['error'])): ?>
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        <div class="flex items-center">
                            <span class="text-lg mr-2">⚠️</span>
                            <span><?= htmlspecialchars($this->d['error']) ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            Correo Electrónico
                        </span>
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white"
                        placeholder="tu@email.com"
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center">
                            Contraseña
                        </span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-eps-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white pr-12"
                            placeholder="••••••••"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword()" 
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600"
                        >
                            <span id="toggle-icon">👁️</span>
                        </button>
                    </div>
                </div>
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-eps-blue-600 to-eps-blue-700 text-white font-semibold py-3 px-4 rounded-xl hover:from-eps-blue-700 hover:to-eps-blue-800 transform hover:scale-[1.02] transition-all duration-200 shadow-lg hover:shadow-xl"
                >
                    <span class="flex items-center justify-center">
                        <span class="mr-2">🚀</span>
                        Iniciar Sesión
                    </span>
                </button>
            </form>

            <div class="mt-8 text-center">
                <div class="bg-eps-blue-50 rounded-lg p-4">
                    <p class="text-sm text-eps-blue-700 font-medium mb-2">
                        <span class="mr-2">ℹ️</span>
                        Credenciales por defecto
                    </p>
                    <div class="text-xs text-eps-blue-600 space-y-1">
                        <p><strong>Email:</strong> admin@epsunillanos.com</p>
                        <p><strong>Contraseña:</strong> password123</p>
                    </div>
                </div>
            </div>
            <div class="mt-6 text-center text-sm text-gray-500">
                <p>&copy; 2025 EPS Unillanos. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '👁️';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
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
</body>
</html>