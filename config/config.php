<?php

// define('URL', 'http://localhost:8082/');
define('URL', 'http://192.168.10.46:8082/');
define('HOST', 'localhost');
define('DB', 'eps_unillanos');
define('USER', 'develop');
define('PASSWORD', 'reich0319');
define('CHARSET', 'utf8mb4');
// Configuración de sesiones
define('SESSION_TIMEOUT', 3600); // 1 hora en segundos

// Configuración de archivos
define('UPLOAD_PATH', 'uploads/');
define('MAX_FILE_SIZE', 5242880); // 5MB en bytes

// Configuración de paginación
define('ITEMS_PER_PAGE', 10);

// Configuración de logs
define('LOG_PATH', '/var/www/eps-unillanos/logs/');
define('LOG_LEVEL', 'INFO'); // DEBUG, INFO, WARNING, ERROR

// Configuración de email (opcional)
define('SMTP_HOST', 'smtp.unillanos.edu.co');
define('SMTP_PORT', 587);
define('SMTP_USER', 'biblioteca@unillanos.edu.co');
define('SMTP_PASS', '');

// Configuración de zona horaria
date_default_timezone_set('America/Bogota');