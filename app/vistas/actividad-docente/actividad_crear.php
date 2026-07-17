<?php

$menu = [
    "ruta" => "actividades-docente",
    "nombre" => "Actividades Académicas"
];

require_once __DIR__."/../layout/header.php";

$usuario_rol = $_SESSION["usuario"]["rol"];

?>

    <div class="dot-pattern top-left"></div>
    <div class="dot-pattern bottom-right"></div>

    <main class="main-container content-align-top">

        <div class="breadcrumb" style="color: var(--text-gray); font-size: 0.85rem; margin-bottom: 1rem;">
            <a href="/gestion-docentes-web/actividades-docente" style="color: var(--text-gray); text-decoration: none;">Actividades</a> / <span style="color: var(--c-primary-main); font-weight: 600;">Nueva Actividad</span>
        </div>

        <header class="section-header">
            <div>
                <h1 class="page-title">Nueva Actividad</h1>
                <p class="page-subtitle">Asigna un docente a una asignatura.</p>
            </div>
        </header>

        <div class="details-layout" style="grid-template-columns: 1fr; max-width: 800px; margin: 0 auto; width: 100%;">
            <div class="form-section">
                <div class="section-card">
                    <form id="formCrearActividad">

                        <div class="form-group">
                            <label for="id_curso">Curso</label>
                            <select class="form-input" id="id_curso" name="id_curso" required>
                                <option value="">Seleccione un curso</option>

                                <?php foreach ($cursos as $curso): ?>
                                    <option value="<?= htmlspecialchars($curso['id_curso']) ?>">
                                        <?= htmlspecialchars($curso['nombre'] . ' - ' . ' (' . $curso['paralelo'] . ')') ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input
                                type="text"
                                class="form-input"
                                id="titulo"
                                name="titulo"
                                maxlength="150"
                                placeholder="Ej: Proyecto Final"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea
                                class="form-input"
                                id="descripcion"
                                name="descripcion"
                                rows="5"
                                placeholder="Describa la actividad..."></textarea>
                        </div>

                        <div class="form-group">
                            <label for="categoria">Categoría</label>
                            <select class="form-input" id="categoria" name="categoria" required>
                                <option value="">Seleccione una categoría</option>
                                <option value="Tarea">Tarea</option>
                                <option value="Proyecto">Proyecto</option>
                                <option value="Examen">Examen</option>
                                <option value="Quiz">Quiz</option>
                                <option value="Foro">Foro</option>
                                <option value="Laboratorio">Laboratorio</option>
                                <option value="Investigacion">Investigación</option>
                                <option value="Presentacion">Presentación</option>
                            </select>
                        </div>

                        <div class="grid-2">

                            <div class="form-group">
                                <label for="fecha_apertura">Fecha de apertura</label>
                                <input
                                    type="datetime-local"
                                    class="form-input"
                                    id="fecha_apertura"
                                    name="fecha_apertura"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="fecha_cierre">Fecha de cierre</label>
                                <input
                                    type="datetime-local"
                                    class="form-input"
                                    id="fecha_cierre"
                                    name="fecha_cierre"
                                    required>
                            </div>

                        </div>

                        <div class="form-actions-bar">
                            <a href="/gestion-docentes-web/actividades-docente" class="btn-cancel">
                                Cancelar
                            </a>

                            <button type="submit" class="btn-save">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2"
                                    style="margin-right: .5rem;">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                    <polyline points="7 3 7 8 15 8"></polyline>
                                </svg>

                                Guardar Actividad
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </main>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <div id="icono_respuesta"></div>
                <strong class="me-auto"> Respuesta del servidor</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastMessage">
            Actividad procesada.
            </div>
        </div>
    </div>

    <script src="/gestion-docentes-web/public/js/actividad-docente/ActividadControlador.js"></script>

<?php require_once __DIR__."/../layout/footer.php" ?>
