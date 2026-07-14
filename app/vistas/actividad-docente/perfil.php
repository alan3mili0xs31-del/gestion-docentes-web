<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Gestión Docente</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="home-body">

    <nav class="navbar">
        <div class="nav-brand">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
            <span>Sistema de Gestión Docente</span>
        </div>
        <div class="nav-actions">
            <a href="?accion=perfil" class="btn-outline">Mi Perfil</a>
            <a href="/gestion-docentes-web/auth?accion=logout" class="btn-white">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="dot-pattern top-left"></div>
    <div class="dot-pattern bottom-right"></div>

    <main class="main-container content-align-top">

        <header class="section-header">
            <div>
                <h1 class="page-title">Mi Perfil</h1>
                <p class="page-subtitle">Configuración y datos personales.</p>
            </div>
            <div>
                <a href="?accion=listar" class="btn-cancel">Volver a Actividades</a>
            </div>
        </header>

        <div class="details-layout" style="grid-template-columns: 1fr; max-width: 600px; margin: 0 auto; width: 100%;">
            <div class="form-section">
                <div class="section-card">
                    <form id="formEditarPerfil" method="POST" action="">

                        <div class="form-group">
                            <label for="perfilUsuario">Usuario (No editable)</label>
                            <input type="text" class="form-input" id="perfilUsuario" value="<?= htmlspecialchars($_SESSION['usuario']['usuario'] ?? '') ?>" disabled style="background-color: #f3f4f6; color: var(--text-gray);">
                        </div>

                        <div class="form-group">
                            <label for="perfilCorreo">Correo Electrónico</label>
                            <input type="email" class="form-input" id="perfilCorreo" value="<?= htmlspecialchars($_SESSION['usuario']['correo'] ?? '') ?>" disabled style="background-color: #f3f4f6; color: var(--text-gray);">
                        </div>

                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for="perfilRol">Rol</label>
                            <input type="text" class="form-input" id="perfilRol" value="<?= htmlspecialchars($_SESSION['usuario']['rol'] ?? '') ?>" disabled style="background-color: #f3f4f6; color: var(--text-gray);">
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
