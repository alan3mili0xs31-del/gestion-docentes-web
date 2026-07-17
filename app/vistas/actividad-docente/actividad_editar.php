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

                        <input type="hidden"
                            id="actividadId"
                            name="id_actividad"
                            value="<?= htmlspecialchars($actividad['id_actividad'] ?? '') ?>">

                        <div class="form-group">
                            <label for="id_curso">Curso</label>
                            <select class="form-input" id="id_curso" name="id_curso" required>

                                <option value="">Seleccione un curso</option>

                                <?php foreach ($cursos as $curso): ?>
                                    <option value="<?= htmlspecialchars($curso['id_curso']) ?>"
                                        <?= (($actividad['id_curso'] ?? '') == $curso['id_curso']) ? 'selected' : '' ?>>

                                        <?= htmlspecialchars($curso['nombre'] . ' - ' . $curso['asignatura'] . ' (' . $curso['paralelo'] . ')') ?>

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
                                required
                                placeholder="Ej: Proyecto Final"
                                value="<?= htmlspecialchars($actividad['titulo'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea
                                class="form-input"
                                id="descripcion"
                                name="descripcion"
                                rows="5"
                                placeholder="Describa la actividad..."><?= htmlspecialchars($actividad['descripcion'] ?? '') ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="categoria">Categoría</label>

                            <select class="form-input" id="categoria" name="categoria" required>

                                <?php
                                $categorias = [
                                    "Tarea",
                                    "Proyecto",
                                    "Examen",
                                    "Quiz",
                                    "Foro",
                                    "Laboratorio",
                                    "Investigacion",
                                    "Presentacion"
                                ];

                                foreach ($categorias as $categoria):
                                ?>
                                    <option
                                        value="<?= $categoria ?>"
                                        <?= (($actividad['categoria'] ?? '') === $categoria) ? 'selected' : '' ?>>
                                        <?= $categoria ?>
                                    </option>
                                <?php endforeach; ?>

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
                                    required
                                    value="<?= isset($actividad['fecha_apertura']) ? date('Y-m-d\TH:i', strtotime($actividad['fecha_apertura'])) : '' ?>">
                            </div>

                            <div class="form-group">
                                <label for="fecha_cierre">Fecha de cierre</label>
                                <input
                                    type="datetime-local"
                                    class="form-input"
                                    id="fecha_cierre"
                                    name="fecha_cierre"
                                    required
                                    value="<?= isset($actividad['fecha_cierre']) ? date('Y-m-d\TH:i', strtotime($actividad['fecha_cierre'])) : '' ?>">
                            </div>

                        </div>

                        <div class="form-actions-bar">
                            <a href="/gestion-docentes-web/actividades-docente" class="btn-cancel">
                                Cancelar
                            </a>

                            <button type="submit" class="btn-save">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2"
                                    style="margin-right:.5rem;">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                    <polyline points="7 3 7 8 15 8"></polyline>
                                </svg>

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

<?php require_once __DIR__."/../layout/footer.php" ?>
