<?php

$menu = [
    "ruta" => "docentes",
    "nombre" => "Docentes"
];

require_once __DIR__."/../layout/header.php"

?>

    <div class="dot-pattern top-left"></div>
    <div class="dot-pattern bottom-right"></div>

    <main class="main-container content-align-top">

        <div class="breadcrumb" style="color: var(--text-gray); font-size: 0.85rem; margin-bottom: 1rem;">
            <a href="/gestion-docentes-web/docentes" style="color: var(--text-gray); text-decoration: none;">Docentes</a> / <span style="color: var(--c-primary-main); font-weight: 600;">Editar Docente</span>
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
                    <form id="formEditar">
                        <input type="hidden" id="docenteId" name="id_docente" value="<?= htmlspecialchars($docente['id_docente'] ?? '') ?>">

                        <div class="form-group">
                            <label for="cedula">Cédula</label>
                            <input type="text" class="form-input" id="cedula" name="cedula" value="<?= htmlspecialchars($docente['cedula'] ?? '') ?>" required>
                        </div>


                        <div class="grid-2">
                            <div class="form-group">
                                <label for="primer_nombre">Primer nombre</label>
                                <input type="text" class="form-input" id="primer_nombre" name="primer_nombre" required placeholder="Ingresa el primer nombre" value="<?= htmlspecialchars(trim(($docente['primer_nombre'] ?? ''))) ?>">
                            </div>
                            <div class="form-group">
                                <label for="segundo_nombre">Segundo nombre <span style="color: #9CA3AF; font-weight: 400;">(Opcional)</span></label>
                                <input type="text" class="form-input" id="segundo_nombre" name="segundo_nombre" placeholder="Ingresa el segundo nombre" value="<?= htmlspecialchars(trim(($docente['segundo_nombre'] ?? ''))) ?>">
                            </div>
                        </div>

                        <div class="grid-2">
                            <div class="form-group">
                                <label for="primer_apellido">Primer apellido</label>
                                <input type="text" class="form-input" id="primer_apellido" name="primer_apellido" required placeholder="Ingresa el primer apellido" value="<?= htmlspecialchars(trim(($docente['primer_apellido'] ?? ''))) ?>">
                            </div>
                            <div class="form-group">
                                <label for="segundo_apellido">Segundo apellido <span style="color: #9CA3AF; font-weight: 400;">(Opcional)</span></label>
                                <input type="text" class="form-input" id="segundo_apellido" name="segundo_apellido" placeholder="Ingresa el segundo apellido" value="<?= htmlspecialchars(trim(($docente['segundo_apellido'] ?? ''))) ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="especialidad">Especialidad</label>
                            <input type="text" class="form-input" id="especialidad" name="especialidad" placeholder="Ingresa la especialidad" required value="<?= htmlspecialchars(trim(($docente['especialidad'] ?? ''))) ?>">
                        </div>

                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-input" id="estado" name="estado" required>
                                <option value="activo" <?= (isset($docente['estado']) && $docente['estado'] === 'activo') ? 'selected' : '' ?>>Activo</option>
                                <option value="inactivo" <?= (isset($docente['estado']) && $docente['estado'] === 'inactivo') ? 'selected' : '' ?>>Inactivo</option>
                            </select>
                        </div>

                        <div class="form-actions-bar">
                            <a href="/gestion-docentes-web/docentes" class="btn-cancel">Cancelar</a>
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

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <div id="icono_respuesta"></div>
                <strong class="me-auto"> Respuesta del servidor</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastMessage">
            Docente procesado.
            </div>
        </div>
    </div>

    <!-- Mantenemos la funcionalidad JS original o la adaptamos, asÃ­ que incluimos los scripts que se usaban -->
    <script src="/gestion-docentes-web/public/js/docente/DocenteModel.js"></script>
    <script src="/gestion-docentes-web/public/js/docente/DocenteView.js"></script>
    <script src="/gestion-docentes-web/public/js/docente/DocenteControlador.js"></script>

<?php require_once __DIR__."/../layout/footer.php" ?>
