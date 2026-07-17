<?php
// La sesión ya está iniciada en index.php
$usuario = $_SESSION['usuario'] ?? [];
$nombreUsuario = $usuario['cedula'] ?? 'Usuario';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Asignaturas - Sistema</title>
    <link rel="stylesheet" href="/gestion-docentes-web/public/css/style.css">
    <style>
        .filtro-select {
            appearance: none;
            -webkit-appearance: none;
            background-color: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.55rem 2.2rem 0.55rem 0.9rem;
            font-size: 0.9rem;
            color: var(--text-dark, #1e293b);
            font-family: inherit;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.7rem center;
            min-width: 190px;
            transition: border-color 0.2s;
        }
        .filtro-select:focus {
            outline: none;
            border-color: var(--c-primary-main, #3b5bdb);
            box-shadow: 0 0 0 3px rgba(59, 91, 219, 0.12);
        }
        #tablaAsignaturas tr td { padding: 0.85rem 1rem; }
        .badge-facultad {
            display: inline-block;
            padding: 0.25rem 0.7rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            background: #eff6ff;
            color: #2563eb;
        }
        .empty-state { text-align: center; padding: 3rem 1rem; color: #94a3b8; }
        .empty-state svg { margin-bottom: 1rem; opacity: .4; }
        .spinner { display: flex; justify-content: center; padding: 2rem; }
        .spinner::after {
            content: '';
            width: 32px; height: 32px;
            border: 3px solid #e2e8f0;
            border-top-color: var(--c-primary-main, #3b5bdb);
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body class="home-body">

    <nav class="navbar">
        <div class="nav-brand">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
            <span>Sistema de Gestión Docente</span>
        </div>
        <div class="nav-actions">
            <a href="/gestion-docentes-web/actividades-docente?accion=perfil" class="btn-outline">Mi Perfil</a>
            <a href="/gestion-docentes-web/auth?accion=logout" class="btn-white">Cerrar Sesión</a>
        </div>
    </nav>

    <main class="main-container content-align-top">

        <div class="breadcrumb" style="color: var(--text-gray); font-size: 0.85rem; margin-bottom: 1rem;">
            <a href="/gestion-docentes-web/inicio" style="color: var(--text-gray); text-decoration: none;">Inicio</a> / <span style="color: var(--c-primary-main); font-weight: 600;">Asignaturas</span>
        </div>

        <header class="section-header">
            <div>
                <h1 class="page-title">Gestión de Asignaturas</h1>
                <p class="page-subtitle">Directorio de materias y asignaturas registradas en el sistema.</p>
            </div>

            <div style="display: flex; gap: 1rem; align-items: center;">
                <select id="filtrarFacultad" class="filtro-select">
                    <option value="">Todas las facultades</option>
                    <option value="FACCI">Ciencias Informáticas</option>
                    <option value="FACI">Ciencias Industriales</option>
                    <option value="FACE">Ciencias Económicas</option>
                </select>
                <a href="/gestion-docentes-web/asignaturas?accion=crear" class="btn-save" style="text-decoration: none;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.5rem;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Nueva Asignatura
                </a>
            </div>
        </header>

        <div class="modern-card" style="padding: 1.5rem;">
            <div id="spinner" class="spinner"></div>
            <div class="table-container" style="overflow-x: auto; display:none;" id="tableWrapper">
                <table class="data-table" style="width: 100%; min-width: 800px; border-collapse: separate; border-spacing: 0 8px;">
                    <thead>
                        <tr>
                            <th style="padding: 0.8rem 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.8rem; text-align:left;">Código</th>
                            <th style="padding: 0.8rem 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.8rem; text-align:left;">Materia</th>
                            <th style="padding: 0.8rem 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.8rem; text-align:left;">Créditos</th>
                            <th style="padding: 0.8rem 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.8rem; text-align:left;">Semestre</th>
                            <th style="padding: 0.8rem 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.8rem; text-align:left;">Facultad</th>
                            <th style="padding: 0.8rem 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.8rem; text-align:left;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaAsignaturas"></tbody>
                </table>
                <div id="emptyState" class="empty-state" style="display:none;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="2"/></svg>
                    <p style="font-weight: 600; margin-bottom: .3rem;">No hay asignaturas registradas</p>
                    <p style="font-size:.9rem;">Crea una nueva asignatura usando el botón de arriba.</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2026 Sistema de Gestión Docente. Todos los derechos reservados.</p>
    </footer>

    <script src="/gestion-docentes-web/public/js/asignatura/AsignaturaModel.js"></script>
    <script src="/gestion-docentes-web/public/js/asignatura/AsignaturaView.js"></script>
    <script src="/gestion-docentes-web/public/js/asignatura/AsignaturaControlador.js"></script>
</body>
</html>
