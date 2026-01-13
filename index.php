<?php
// index.php - Punto de entrada principal de mi aplicación

// 1. Cargo las configuraciones esenciales
require_once 'config/establecer-sesion.php'; // Inicio sesión de forma segura
require_once 'config/Database.php';          // Conecto a la BD de F1

// 2. Importo mis modelos y controladores
require_once 'models/User.php';
require_once 'models/Escuderia.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/EscuderiaController.php';

// 3. Inicializo los controladores
$authController = new AuthController();
$escuderiaController = new EscuderiaController();

// 4. Capturo qué acción quiere realizar el usuario
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'index';
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

// --- ZONA PÚBLICA ---
// Si la acción es loguearse, dejo pasar sin comprobar sesión
if ($action === 'login' || $action === 'authenticate') {
    if ($action === 'login') {
        $authController->login();
    } elseif ($action === 'authenticate') {
        $authController->authenticate();
    }
    exit(); // Detengo la ejecución aquí para no cargar nada más
}

// --- ZONA PRIVADA ---
// Compruebo si el usuario ya ha iniciado sesión. Si no, lo mando al login.
if (!isset($_SESSION['usuario_logueado']) || $_SESSION['usuario_logueado'] !== true) {
    header("Location: index.php?action=login");
    exit();
}

// --- RUTAS ---
switch ($action) {
    // Cerrar sesión
    case 'logout':
        $authController->logout();
        break;

    // CRUD de Escuderías
    case 'create':
    case 'crear':
        $escuderiaController->create();
        break;
        
    case 'editar':
    case 'edit':
        $escuderiaController->edit($id);
        break;
        
    case 'eliminar':
    case 'delete':
        $escuderiaController->delete($id);
        break;
        
    // Por defecto, muestro el listado
    case 'index':
    default:
        $escuderiaController->index();
        break;
}
?>