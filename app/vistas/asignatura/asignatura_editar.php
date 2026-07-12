<?php

$menu = [
    "ruta" => "asignaturas",
    "nombre" => "Asignaturas"
];

require_once __DIR__."/../layout/curso/header.php"

?>

    <div class="dot-pattern top-left"></div>
    <div class="dot-pattern bottom-right"></div>

    <main class="main-container content-align-top">

        <div class="breadcrumb" style="color: var(--text-gray); font-size: 0.85rem; margin-bottom: 1rem;">
            <a href="/gestion-docentes-web/asignaturas" style="color: var(--text-gray); text-decoration: none;">Asignaturas</a> / <span style="color: var(--c-primary-main); font-weight: 600;">Editar Asignatura</span>
        </div>

        <header class="section-header">
            <div>
                <h1 class="page-title">Editar Asignatura</h1>
                <p class="page-subtitle">Modifica la información de la asignatura seleccionada.</p>
            </div>
        </header>

        <div class="details-layout" style="grid-template-columns: 1fr; max-width: 800px; margin: 0 auto; width: 100%;">
            <div class="form-section">
                <div class="section-card">
                    <form id="formEditarAsignatura">
                        <input type="hidden" id="asignaturaId" name="id_asignatura" value="<?= htmlspecialchars($asignatura['id_asignatura'] ?? '') ?>">

                        <div class="form-group">
                            <label for="nombre">Nombre de la Asignatura</label>
                            <input type="text" class="form-input" id="nombre" name="nombre" value="<?= htmlspecialchars($asignatura['nombre'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-input" id="estado" name="estado" required>
                                <option value="activo" <?= (isset($asignatura['estado']) && $asignatura['estado'] === 'activo') ? 'selected' : '' ?>>Activo</option>
                                <option value="inactivo" <?= (isset($asignatura['estado']) && $asignatura['estado'] === 'inactivo') ? 'selected' : '' ?>>Inactivo</option>
                            </select>
                        </div>

                        <div class="form-actions-bar">
                            <a href="/gestion-docentes-web/asignaturas" class="btn-cancel">Cancelar</a>
                            <button type="submit" class="btn-save">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.5rem;"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                Actualizar Asignatura
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
            Asignatura procesada.
            </div>
        </div>
    </div>

    <script src="/gestion-docentes-web/public/js/asignatura/AsignaturaControlador.js"></script>

<?php require_once __DIR__."/../layout/curso/footer.php" ?>
