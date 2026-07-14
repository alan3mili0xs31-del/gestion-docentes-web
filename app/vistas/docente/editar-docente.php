<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Docente - Sistema</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="home-body">

    <nav class="navbar">
        <div class="nav-brand">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
            <span>Sistema de Gestión Docente</span>
        </div>
        <div class="nav-actions">
            <a href="/gestion-docentes-web/docentes?accion=perfil" class="btn-outline">Mi Perfil</a>
            <a href="/gestion-docentes-web/auth?accion=logout" class="btn-white">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="dot-pattern top-left"></div>
    <div class="dot-pattern bottom-right"></div>

    <main class="main-container content-align-top">

        <div class="breadcrumb" style="color: var(--text-gray); font-size: 0.85rem; margin-bottom: 1rem;">
            <a href="/gestion-docentes-web/docentes?accion=listar" style="color: var(--text-gray); text-decoration: none;">Docentes</a> / <span style="color: var(--c-primary-main); font-weight: 600;">Editar Docente</span>
        </div>

        <header class="section-header">
            <div>
                <h1 class="page-title">Editar Docente</h1>
                <p class="page-subtitle">Modifica la información del docente seleccionado.</p>
            </div>
        </header>

        <div class="details-layout" style="grid-template-columns: 1fr; max-width: 800px; margin: 0 auto; width: 100%;">
            <div class="form-section">
                <div class="section-card">
                    <form method="POST" action="/gestion-docentes-web/docentes?accion=actualizar&id=<?= $docente['id_docente'] ?>">

                        <div class="form-group">
                            <label for="cedula">Cédula</label>
                            <input type="text" class="form-input" id="cedula" name="cedula" value="<?= htmlspecialchars($docente['cedula']) ?>" maxlength="10" required>
                        </div>

                        <div class="grid-2">
                            <div class="form-group">
                                <label for="primer_nombre">Primer Nombre</label>
                                <input type="text" class="form-input" id="primer_nombre" name="primer_nombre" value="<?= htmlspecialchars($docente['primer_nombre']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="segundo_nombre">Segundo Nombre</label>
                                <input type="text" class="form-input" id="segundo_nombre" name="segundo_nombre" value="<?= htmlspecialchars($docente['segundo_nombre'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="grid-2">
                            <div class="form-group">
                                <label for="primer_apellido">Primer Apellido</label>
                                <input type="text" class="form-input" id="primer_apellido" name="primer_apellido" value="<?= htmlspecialchars($docente['primer_apellido']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="segundo_apellido">Segundo Apellido</label>
                                <input type="text" class="form-input" id="segundo_apellido" name="segundo_apellido" value="<?= htmlspecialchars($docente['segundo_apellido'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="form-actions-bar">
                            <a href="/gestion-docentes-web/docentes?accion=listar" class="btn-cancel">Cancelar</a>
                            <button type="submit" class="btn-save">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.5rem;"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                Actualizar Docente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <footer class="footer">
        <p>&copy; 2026 Sistema de Gestión Docente. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
