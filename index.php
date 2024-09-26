<?php
// require 'backend/conexion/conexion.php';
include 'backend/conexion/conexion.php';
$OS = new OutSourcing();

// Incluir configuración global
// require 'settings.php';

// Determinar la página solicitada
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Páginas que NO extienden el layout
// $noLayoutPages = ['login'];
$noLayoutPages = ['login', 'registro','email-verification','password-reset-2','password-reset','static-non-auth'];

// Si la página solicitada está en $noLayoutPages, carga solo el contenido sin layout
if (in_array($page, $noLayoutPages)) {
    switch ($page) {
      // -------------------------------------
    //inicio autentificacion
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

        case 'static-non-auth':
            require 'usuario/static-non-auth.php';
            break;
        // Agrega más páginas que no extiendan el layout si es necesario
        default:
            require 'no-found.php'; // Página no encontrada
            break;
    }
} else {
    // Capturar el contenido de la página en un buffer si utiliza layout
    ob_start(); 
    switch ($page) {
        // case 'inicio':
        //     require 'layout.php';
        //     break;
        case 'home':
            require 'inicio/home.php';
            break;
// -------------------------------------
    // inicio usuario
        case 'settings':
            require 'usuario/settings.php';
            break;
     
   
        case 'agregar_empleados':
            require 'usuario/agregarempleados.php';
            break;
        case 'empleados':
            require 'usuario/empleados.php';
            break;
// -------------------------------------

    //equipos
   case 'ver_equipos':
            require 'equipos/verequipos.php';
            break;
   case 'agregar_equipos':
            require 'equipos/agregarequipos.php';
            break;
   case 'ver_asignacion':
            require 'equipos/verasignacion.php';
            break;
   case 'agregarasignacion':
            require 'equipos/agregarasignacion.php';
            break;
// -------------------------------------
        default:
            require 'inicio/no-found.php'; // Página no encontrada
            break;
    }
    $content = ob_get_clean();

    // Incluir el archivo de layout si no está en las páginas excluidas
    require 'inicio/layout.php';
}
?>
