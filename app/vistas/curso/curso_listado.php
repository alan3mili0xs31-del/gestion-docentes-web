<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Cursos - Gestión Docente</title>
    <!-- Ruta al archivo CSS unificado -->
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="home-body content-page">

    <!-- Barra de NavegaciÃ³n Superior -->
    <nav class="navbar">
        <div class="nav-brand">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
            <span>Sistema de Gestión Docente</span>
        </div>
        <div class="nav-actions">
            <a href="../home.php" class="btn-outline">Volver al Inicio</a>
            <a href="../login.php" class="btn-white">Cerrar SesiÃ³n</a>
        </div>
    </nav>

    <!-- Patrones decorativos -->
    <div class="dot-pattern top-left"></div>
    <div class="dot-pattern bottom-right"></div>

    <!-- Contenedor Principal -->
    <main class="main-container content-align-top">

        <!-- Cabecera de la secciÃ³n -->
        <header class="section-header">
            <div>
                <h1 class="page-title">Mis Cursos Asignados</h1>
                <p class="page-subtitle">Semestre AcadÃ©mico 2026-I</p>
            </div>
            <!-- Buscador para filtrar cursos -->
            <div class="search-box">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" placeholder="Buscar curso...">
            </div>
        </header>

        <!-- Cuadri­cula de Cursos -->
        <div class="course-list-grid">

            <?php foreach ($cursos as $curso):

              $colores = ["purple", "teal", "blue"];
              $colorId = random_int(0, count($colores) - 1);
              $colorSeleccionado = $colores[$colorId];

            ?>

            <div class="course-card">
                <div class="course-header bg-<?= $colorSeleccionado ?>">
                    <span class="course-code"><?php echo htmlspecialchars($curso['paralelo']); ?></span>
                    <h3><?php echo htmlspecialchars($curso['nombre']); ?></h3>
                </div>
                <div class="course-body">
                    <div class="course-info">
                        <div class="info-item">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            <span><?php echo htmlspecialchars($curso['cantidad_alumnos']); ?> Alumnos</span>
                        </div>
                        <div class="info-item">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            <span><?php echo htmlspecialchars($curso['horario']); ?></span>
                        </div>
                    </div>
                </div>
                <div class="course-footer">
                    <a href="/gestion-docentes-web/cursos?accion=buscar&id_curso=<?= htmlspecialchars($curso['id_curso']) ?>" class="btn-full btn-<?= $colorSeleccionado ?>">Ver Detalles del Curso</a>
                </div>
            </div>

        <?php endforeach; ?>


        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto">
        <p>&copy; 2026 Sistema de Gestión Docente. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
