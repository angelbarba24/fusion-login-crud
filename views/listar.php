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
<html lang="es" data-bs-theme="dark"> <head>
    <meta charset="UTF-8">
    <title>Listar escuderías</title>
    <link rel="icon" type="image/svg+xml" href="https://upload.wikimedia.org/wikipedia/commons/3/33/F1.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #121212; }
        .f1-title {
            color: #e10600;
            font-family: "Arial Black", sans-serif;
            text-transform: uppercase;
            font-style: italic;
            letter-spacing: -1px;
        }
        .btn-f1 {
            background-color: #f10800;
            color: white;
            font-weight: bold;
            border: none;
            text-transform: uppercase;
        }
        .btn-f1:hover { background-color: #b30500; color: white; }
        .table-custom { border-color: #333; }
        .table-custom thead { border-bottom: 2px solid #e10600; }
    </style>
</head>
<body class="bg-body-tertiary">

<div class="container mt-5">
    
    <div class="d-flex justify-content-between align-items-end mb-4 border-bottom border-secondary pb-3">
        <div>
            <div class="text-secondary small mb-1">
                <i class="bi bi-person-circle text-white"></i> Conectado como: 
                <span class="text-white fw-bold"><?php echo htmlspecialchars($_SESSION['idusuario'] ?? 'Invitado'); ?></span>
            </div>
            <h1 class="f1-title mb-0">🏎️ PARRILLA DE F1 2026</h1>
        </div>
        
        <div class="d-flex gap-2">
            <a href="index.php?action=create" class="btn btn-f1 shadow">
                + Nueva Escudería
            </a>
            <a href="index.php?action=logout" class="btn btn-outline-secondary shadow" title="Cerrar Sesión">
                <i class="bi bi-box-arrow-right"></i> Salir
            </a>
        </div>
    </div>

    <?php if(isset($_GET['mensaje'])): ?>
        <?php 
            // Control de alertas
            $clase_alerta = 'alert-info';
            $texto_alerta = '';
            $nombre_accion = isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : 'la escudería';

            switch($_GET['mensaje']) {
                case 'creado': $clase_alerta = 'alert-success'; $texto_alerta = "✅ Escudería '<strong>$nombre_accion</strong>' guardada."; break;
                case 'modificado': $clase_alerta = 'alert-warning'; $texto_alerta = "🔧 Escudería '<strong>$nombre_accion</strong>' actualizada."; break;
                case 'eliminado': $clase_alerta = 'alert-danger'; $texto_alerta = "🗑️ Escudería '<strong>$nombre_accion</strong>' eliminada."; break;
            }
        ?>
        <div class="alert <?php echo $clase_alerta; ?> alert-dismissible fade show" role="alert">
            <?php echo $texto_alerta; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-lg border-0 bg-dark">
        <div class="card-body p-0">
            <table class="table table-dark table-hover table-custom mb-0 text-center align-middle">
                <thead class="text-secondary text-uppercase small">
                    <tr>
                        <th>ID</th>
                        <th class="text-start">Escudería</th>
                        <th>Sede</th>
                        <th>Director</th>
                        <th>Motor</th>
                        <th>Títulos</th>
                        <th>Fundación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($escuderias)): ?>
                        <?php foreach ($escuderias as $fila): ?>
                        <tr>
                            <td class="text-secondary"><?php echo $fila['id']; ?></td>
                            <td class="text-start fw-bold text-white"><?php echo $fila['nombre']; ?></td>
                            <td class="small text-secondary"><?php echo $fila['sede']; ?></td>
                            <td><?php echo $fila['director']; ?></td>
                            <td><span class="badge rounded-pill border border-secondary text-secondary"><?php echo $fila['motor']; ?></span></td>
                            <td class="fw-bold text-warning"><?php echo $fila['campeonatos']; ?> 🏆</td>
                            <td class="small"><?php echo date('d/m/Y', strtotime($fila['fundacion'])); ?></td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="index.php?action=edit&id=<?php echo $fila['id']; ?>" class="btn btn-outline-info btn-sm">Editar</a>
                                    <a href="index.php?action=delete&id=<?php echo $fila['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Seguro que quieres borrar la escudería <?php echo $fila['nombre']; ?>?');">Borrar</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8" class="text-center py-4 text-secondary">No hay datos todavía.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>