<?php
class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new Usuario();
    }

    // Muestro el formulario de login
    public function login()
    {
        include 'views/login.php';
    }

    // Proceso los datos del formulario
    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // 1. Verifico mi Token CSRF por seguridad
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['error'] = "Error de seguridad (Token inválido).";
                header('Location: index.php?action=login');
                exit();
            }

            // 2. Control de intentos para evitar fuerza bruta
            if (!isset($_SESSION['intentos'])) {
                $_SESSION['intentos'] = 0;
            }

            if ($_SESSION['intentos'] >= 5) {
                $_SESSION['error'] = "Has superado el número máximo de intentos.";
                header('Location: index.php?action=login');
                exit();
            }

            // 3. Recojo y limpio los datos
            $username = isset($_POST['usuario']) ? htmlspecialchars(trim($_POST['usuario'])) : "";
            $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : "";

            // 4. Compruebo si los datos son correctos
            if ($this->userModel->login($username, $password)) {
                
                // Login Exitoso: Reseteo intentos y guardo sesión
                $_SESSION['intentos'] = 0;
                $_SESSION['usuario_logueado'] = true;
                $_SESSION['idusuario'] = $username;
                
                // Redirijo al listado principal de escuderías
                header('Location: index.php');
                exit();

            } else {
                // Login Fallido: Aumento contador
                $_SESSION['intentos']++;
                $restantes = 5 - $_SESSION['intentos'];
                
                $_SESSION['error'] = ($restantes > 0) ? "Datos incorrectos. Quedan $restantes intentos." : "Bloqueado.";
                header('Location: index.php?action=login');
                exit();
            }
        }
    }

    // Cierro la sesión y limpio todo
    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: index.php?action=login');
        exit();
    }
}
?>