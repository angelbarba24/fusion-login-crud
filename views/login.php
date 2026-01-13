<?php
    // Si ya estoy dentro, no necesito ver el login
    if (isset($_SESSION['usuario_logueado'])) {
        header("Location: index.php"); 
        exit();
    }

    // Genero mi token de seguridad CSRF
    if (empty($_SESSION['csrf_token'])) {
        try {
            $csrf_token = bin2hex(random_bytes(64));
        } catch (Exception $e) {
            $csrf_token = bin2hex(openssl_random_pseudo_bytes(64));
        }
        $_SESSION['csrf_token'] = $csrf_token;
    } else {
        $csrf_token = $_SESSION['csrf_token'];
    }
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Acceso F1 Management</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/svg+xml" href="https://upload.wikimedia.org/wikipedia/commons/3/33/F1.svg">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        
        <style>
            /* Mis estilos personalizados para el tema F1 */
            body {
                background-image: radial-gradient(circle at 50% 50%, #300c0c 0%, #0f0f0f 100%);
                height: 100vh;
            }
            .card {
                background-color: #1a1a1a; 
                border: 1px solid #333;
                box-shadow: 0 0 20px rgba(225, 6, 0, 0.2);
            }
            .btn-f1 {
                background-color: #e10600;
                color: white;
                font-weight: bold;
                border: none;
                text-transform: uppercase;
            }
            .btn-f1:hover {
                background-color: #b30500;
                color: white;
            }
            .form-control:focus {
                border-color: #e10600;
                box-shadow: 0 0 0 0.25rem rgba(225, 6, 0, 0.25);
            }
        </style>
    </head>
    <body class="bg-body-tertiary">
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="card p-4 rounded-3" style="max-width: 400px; width: 100%;">
                
                <div class="text-center mb-4 text-danger">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/33/F1.svg" alt="">
                    <h3 class="fw-bold fst-italic text-white mt-2">F1 MANAGEMENT</h3>
                </div>

                <?php
                    // Muestro errores de sesión si los hay
                    if (isset($_SESSION['error'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show small" role="alert">';
                        echo '<i class="bi bi-exclamation-triangle-fill me-2"></i>' . $_SESSION['error'];
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        echo '</div>';
                        unset ($_SESSION['error']);
                    }
                ?>

                <form action="index.php?action=authenticate" method="post" id="formulario">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

                    <div class="mb-3">
                        <label for="usuario" class="form-label text-secondary small fw-bold">USUARIO</label>
                        <div class="input-group">
                            <span class="input-group-text text-secondary bg-dark border-secondary"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control bg-dark text-light border-secondary" id="usuario" name="usuario" placeholder="Tu usuario">
                        </div>
                        <div id="usuarioHelp" class="form-text text-danger" hidden>El usuario es obligatorio.</div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label text-secondary small fw-bold">CONTRASEÑA</label>
                        <div class="input-group">
                            <span class="input-group-text text-secondary bg-dark border-secondary"><i class="bi bi-key-fill"></i></span>
                            <input type="password" class="form-control bg-dark text-light border-secondary" id="password" name="password" placeholder="••••••••">
                            <button class="btn btn-outline-secondary border-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div id="passwordHelp" class="form-text text-danger" hidden>La contraseña es obligatoria.</div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-f1 btn-lg">ENTRAR AL PADDOCK</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script src="./views/js/validaciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            if (passwordInput.getAttribute('type') === 'password') {
                passwordInput.setAttribute('type', 'text');
                icon.classList.remove('bi-eye'); icon.classList.add('bi-eye-slash');
            } else {
                passwordInput.setAttribute('type', 'password');
                icon.classList.remove('bi-eye-slash'); icon.classList.add('bi-eye');
            }
        });
    </script>
</html>