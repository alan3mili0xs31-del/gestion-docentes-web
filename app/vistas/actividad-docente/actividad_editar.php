<?php

$menu = [
    "ruta" => "actividades-docente",
    "nombre" => "Actividades Académicas"
];

require_once __DIR__."/../layout/curso/header.php"

?>

    <div class="dot-pattern top-left"></div>
    <div class="dot-pattern bottom-right"></div>

    <main class="main-container content-align-top">

        <div class="breadcrumb" style="color: var(--text-gray); font-size: 0.85rem; margin-bottom: 1rem;">
            <a href="/gestion-docentes-web/actividades-docente" style="color: var(--text-gray); text-decoration: none;">Actividades</a> / <span style="color: var(--c-primary-main); font-weight: 600;">Editar Actividad</span>
        </div>

        <header class="section-header">
            <div>
                <h1 class="page-title">Editar Actividad</h1>
                <p class="page-subtitle">Modifica la asignación del docente a la asignatura.</p>
            </div>
        </header>

        <div class="details-layout" style="grid-template-columns: 1fr; max-width: 800px; margin: 0 auto; width: 100%;">
            <div class="form-section">
                <div class="section-card">
                    <form id="formEditarActividad">
                        <input type="hidden" id="actividadId" name="id_actividad" value="<?= htmlspecialchars($actividad['id_actividad'] ?? '') ?>">

                        <div class="form-group">
                            <label for="id_docente">Docente</label>
                            <select class="form-input" id="id_docente" name="id_docente" required>
                                <option value="">Seleccione un docente</option>
                                <?php foreach ($docentes as $docente): ?>
                                    <option value="<?= htmlspecialchars($docente['id_docente']) ?>" <?= (isset($actividad['id_docente']) && $actividad['id_docente'] == $docente['id_docente']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($docente['cedula'] . ' - ' . $docente['primer_nombre'] . ' ' . $docente['primer_apellido']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_asignatura">Asignatura</label>
                            <select class="form-input" id="id_asignatura" name="id_asignatura" required>
                                <option value="">Seleccione una asignatura</option>
                                <?php foreach ($asignaturas as $asignatura): ?>
                                    <option value="<?= htmlspecialchars($asignatura['id_asignatura']) ?>" <?= (isset($actividad['id_asignatura']) && $actividad['id_asignatura'] == $asignatura['id_asignatura']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($asignatura['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-actions-bar">
                            <a href="/gestion-docentes-web/actividades-docente" class="btn-cancel">Cancelar</a>
                            <button type="submit" class="btn-save">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.5rem;"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                Actualizar Actividad
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

<?php require_once __DIR__."/../layout/curso/footer.php" ?>
