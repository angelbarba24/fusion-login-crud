<?php
// Si alguien intenta abrir este archivo directamente sin pasar por el index,
// es posible que la sesión no esté iniciada o validada.

// 1. Si no hay sesión activa, la arranco para poder comprobar
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Compruebo si el usuario está logueado
if (!isset($_SESSION['usuario_logueado']) || $_SESSION['usuario_logueado'] !== true) {
    // Si no está logueado, lo mando al login
    header("Location: ../index.php?action=login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Nueva escudería</title>
    <link rel="icon" type="image/svg+xml" href="https://upload.wikimedia.org/wikipedia/commons/3/33/F1.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .f1-header {
            background: linear-gradient(45deg, #e10600, #960400);
            color: white;
            font-style: italic;
        }
        .container {
            margin-top: 8%;
        }
    </style>
</head>
<body class="bg-body-tertiary d-flex flex-column min-vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow-lg border-secondary">
                <div class="card-header f1-header">
                    <h3 class="mb-0 text-uppercase fw-bold">🏁 Alta de Equipo</h3>
                </div>
                <div class="card-body bg-dark">
                    <form action="index.php?action=create" method="POST">
                        <h5 class="text-secondary mb-3 border-bottom border-secondary pb-2">Datos Técnicos</h5>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label text-light">Nombre Escudería</label>
                                <input type="text" name="nombre" class="form-control bg-black border-secondary text-white" required placeholder="Ej: Ferrari">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-light">Motorista</label>
                                <input type="text" name="motor" class="form-control bg-black border-secondary text-white" required placeholder="Ej: Ferrari">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label text-light">Sede Principal</label>
                                <input type="text" name="sede" class="form-control bg-black border-secondary text-white" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-light">Team Principal (Director)</label>
                                <input type="text" name="director" class="form-control bg-black border-secondary text-white" required>
                            </div>
                        </div>

                        <h5 class="text-secondary mb-3 border-bottom border-secondary pb-2">Historial</h5>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label text-light">Títulos Mundiales</label>
                                <input type="number" name="campeonatos" class="form-control bg-black border-secondary text-white" value="0">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label text-light">Fecha Fundación</label>
                                <input type="date" name="fundacion" class="form-control bg-black border-secondary text-white" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="index.php" class="btn btn-outline-light me-md-2">Cancelar</a>
                            <input type="submit" value="Crear" class="btn btn-danger px-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="text-center py-4 text-secondary border-top border-secondary border-opacity-25 mt-auto">
    <small>Ángel Barba Fernández - 2º DAW</small>
</footer>
</body>
</html>