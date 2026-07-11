<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso - Gestión Docente</title>
    <link rel="stylesheet" href="../../../public/css/style.css">
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
                    <h2 class="section-title">InformaciÃ³n General</h2>
                    <form action="#" class="details-form">
                        <div class="form-group">
                            <label>Nombre del Curso</label>
                            <input type="text" value="Curso de POO con JavaScript" class="form-input">
                        </div>

                        <div class="grid-2">
                            <div class="form-group">
                                <label>Docente</label>
                                <select class="form-input">
                                    <option>Prof. Sebastian Acosta</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Estado del Curso</label>
                                <select class="form-input">
                                    <option>Activo</option>
                                    <option>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>DescripciÃ³n</label>
                            <textarea class="form-input" rows="5">En este curso aprenderemos los fundamentos de programaciÃ³n orientada a objetos...</textarea>
                        </div>

                        <div class="form-actions-bar">
                            <a href="curso_listado.php" class="btn-cancel">Cancelar</a>
                            <button type="submit" class="btn-save">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                Guardar Cambios
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
                        <span class="meta-value">12 Mayo, 2026</span>
                    </div>
                    <div class="meta-group">
                        <span class="meta-label">Ãšltima ediciÃ³n:</span>
                        <span class="meta-value">Hace 2 horas</span>
                    </div>
                    <div class="meta-group">
                        <span class="meta-label">Alumnos:</span>
                        <span class="meta-value">35 Estudiantes</span>
                    </div>

                    <div class="status-box active">
                        <span>Estado:</span> <strong>Activo</strong>
                    </div>
                </div>
            </aside>
        </div>
    </main>
</body>
</html>
