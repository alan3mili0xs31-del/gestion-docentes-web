<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Docente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/gestion-docentes-web/public/css/style.css?v=1">
</head>
<body class="home-body content-page">

    <nav class="navbar">
        <div class="nav-brand">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
            <span>Sistema de Gestión Docente</span>
        </div>
        <div class="nav-actions">
            <a href="/gestion-docentes-web/<?= $menu["ruta"] ?>" class="btn-outline">Ir a <?= $menu["nombre"] ?></a>
            <a href="/gestion-docentes-web/auth?accion=logout" class="btn-white">Cerrar Sesión</a>
        </div>
    </nav>


