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
    <title>Editar escudería</title>
    <link rel="icon" type="image/svg+xml" href="https://upload.wikimedia.org/wikipedia/commons/3/33/F1.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .f1-header-edit {
            background: linear-gradient(45deg, #ffc107, #d39e00);
            color: black;
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
                <div class="card-header f1-header-edit">
                    <h3 class="mb-0 text-uppercase fw-bold">🔧 Modificar Escudería</h3>
                </div>
                <div class="card-body bg-dark">
                    <form action="index.php?action=edit&id=<?php echo $datosEscuderia->id; ?>" method="POST">
                        
                        <div class="alert alert-dark border-warning d-flex align-items-center" role="alert">
                             ⚠️ Estás editando los datos de: <strong>&nbsp;<?php echo $datosEscuderia->nombre; ?></strong>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label text-light">Nombre Escudería</label>
                                <input type="text" name="nombre" class="form-control bg-black border-secondary text-white" value="<?php echo $datosEscuderia->nombre; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-light">Motorista</label>
                                <input type="text" name="motor" class="form-control bg-black border-secondary text-white" value="<?php echo $datosEscuderia->motor; ?>" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label text-light">Sede Principal</label>
                                <input type="text" name="sede" class="form-control bg-black border-secondary text-white" value="<?php echo $datosEscuderia->sede; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-light">Director de Equipo</label>
                                <input type="text" name="director" class="form-control bg-black border-secondary text-white" value="<?php echo $datosEscuderia->director; ?>" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label text-light">Títulos</label>
                                <input type="number" name="campeonatos" class="form-control bg-black border-secondary text-white" value="<?php echo $datosEscuderia->campeonatos; ?>">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label text-light">Fecha Fundación</label>
                                <input type="date" name="fundacion" class="form-control bg-black border-secondary text-white" value="<?php echo $datosEscuderia->fundacion; ?>" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="index.php" class="btn btn-outline-light me-md-2">Cancelar</a>
                            <input type="submit" value="Actualizar Datos" class="btn btn-warning fw-bold px-5">
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