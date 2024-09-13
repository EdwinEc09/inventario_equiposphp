<?php
// Incluir configuración global
// require 'settings.php';

// Determinar la página solicitada
$page = isset($_GET['page']) ? $_GET['page'] : 'login';

// Incluir el archivo de layout
// require 'layout.php';

// Incluir el contenido específico basado en la página solicitada
switch ($page) {
    case 'home':
        require 'home.php';
        break;
    case 'login':
        require 'autentificacion/login.php';
        break;
    case 'registro':
        require 'autentificacion/register.php';
        break;
    case 'email-verification':
        require 'autentificacion/email-verification.php';
        break;
    case 'password-reset-2':
        require 'autentificacion/password-reset-2.php';
        break;
    case 'password-reset':
        require 'autentificacion/password-reset.php';
        break;
// -------------------------------------
    // inicio usuario
    case 'settings':
        require 'usuario/settings.php';
        break;
    case 'static-non-auth':
        require 'usuario/static-non-auth.php';
        break;
    case 'user-edit':
        require 'usuario/user-edit.php';
        break;
    case 'users':
        require 'usuario/users.php';
        break;
// -------------------------------------
    // Añadir más casos según sea necesario
    default:
        require 'no-found.php'; // Página no encontrada
        break;
}
?>



