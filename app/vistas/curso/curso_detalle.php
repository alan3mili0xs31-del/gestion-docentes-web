<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso - Gestión Docente</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="home-body content-page">

    <nav class="navbar">
        <div class="nav-brand"><span>Gestión Docente</span></div>
        <div class="nav-actions">
            <a href="curso_listado.php" class="btn-outline">Volver a Cursos</a>
        </div>
    </nav>

    <main class="main-container content-align-top">
        <div class="breadcrumb">Cursos / Editar Curso / <span class="active">POO con JavaScript</span></div>

        <header class="section-header">
            <h1 class="page-title">Editar Curso</h1>
        </header>

        <div class="details-layout">

            <div class="form-section">
                <div class="section-card">
                    <h2 class="section-title">Información General</h2>
                    <form action="/gestion-docentes-web/cursos?accion=actualizar" method="POST" class="details-form">
                        <input type="hidden" name="id_curso" id="id_curso" value="<?php echo htmlspecialchars($curso['id_curso']); ?>"></input>
                        <div class="form-group">
                            <label>Nombre del curso</label>
                            <input type="text" value="<?php echo htmlspecialchars($curso['nombre']); ?>" class="form-input" name="nombre" id="nombre">
                        </div>

                        <div class="grid-2">
                            <div class="form-group">
                                <label>Docente</label>
                                <select class="form-input" name="id_docente" id="id_docente">
                                    <option value="<?php echo htmlspecialchars($curso['id_docente']); ?>"><?php echo htmlspecialchars($curso['id_docente']); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Estado del Curso</label>
                                <select class="form-input" name="estado" id="estado">
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Asignatura</label>
                            <select class="form-input" name="id_asignatura" id="id_asignatura">
                                <option value="<?php echo htmlspecialchars($curso['id_asignatura']); ?>"><?php echo htmlspecialchars($curso['id_asignatura']); ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea class="form-input" rows="5" name="descripcion" id="descripcion"><?php echo htmlspecialchars($curso['descripcion']); ?></textarea>
                        </div>

                        <div class="form-actions-bar">
                            <a href="/gestion-docentes-web/cursos" class="btn-cancel">Cancelar</a>

                            <button type="submit" class="btn-save" id="guardar-curso">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                Guardar Cambios
                            </button>

                            <button type="submit" class="btn-save" id="editar-curso">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 20h9"/>
                                    <path d="M16.5 3.5a2.12 2.12 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>
                                </svg>
                                Editar curso
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <aside class="info-sidebar">
                <div class="card-sidebar">
                    <h3 class="sidebar-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>
                        Resumen del Curso
                    </h3>

                    <div class="meta-group">
                        <span class="meta-label">Creado:</span>
                        <span class="meta-value"><?php echo htmlspecialchars($curso['fecha_creacion']); ?></span>
                    </div>
                    <div class="meta-group">
                        <span class="meta-label">Última edición:</span>
                        <span class="meta-value">Hace 2 horas</span>
                    </div>
                    <div class="meta-group">
                        <span class="meta-label">Alumnos:</span>
                        <span class="meta-value"><?php echo htmlspecialchars($curso['cantidad_alumnos']); ?> Estudiantes</span>
                    </div>

                    <div class="status-box active">
                        <span>Estado:</span> <strong><?php echo htmlspecialchars($curso['estado']); ?></strong>
                    </div>
                </div>
            </aside>
        </div>
    </main>
    <script src="public/js/curso/cursos.js"></script>
</body>
</html>
