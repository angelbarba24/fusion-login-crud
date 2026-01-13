<?php
// Configuración de seguridad para mis cookies de sesión
session_set_cookie_params([
    'lifetime' => 1800, // La sesión dura 30 minutos
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Strict',
]);
session_start();

// Regenero el ID de sesión cada 5 minutos por seguridad
$regenerate_interval = 300; 
if (!isset($_SESSION['last_regeneration'])) {
    $_SESSION['last_regeneration'] = time();
}
if (time() - $_SESSION['last_regeneration'] >= $regenerate_interval) {
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}
?>