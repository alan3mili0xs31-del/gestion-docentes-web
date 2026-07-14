<?php

$menu = [
    "ruta" => "cursos",
    "nombre" => "Mis cursos"
];

require_once __DIR__."/../layout/curso/header.php"

?>

    <div class="dot-pattern top-left"></div>
    <div class="dot-pattern bottom-right"></div>

    <main class="main-container content-align-top">

        <div class="breadcrumb" style="color: var(--text-gray); font-size: 0.85rem; margin-bottom: 1rem;">
            <a href="listado-docentes.html" style="color: var(--text-gray); text-decoration: none;">Cursos</a> / <span style="color: var(--c-primary-main); font-weight: 600;">Nuevo Curso</span>
        </div>

        <header class="section-header">
            <div>
                <h1 class="page-title">Nuevo Curso</h1>
                <p class="page-subtitle">Registra la información de un nuevo curso en el sistema.</p>
            </div>
        </header>

        <div class="details-layout" style="grid-template-columns: 1fr; max-width: 800px; margin: 0 auto; width: 100%;">
            <div class="form-section">
                <div class="section-card">

                    <!-- Formulario de registro de curso  -->
                    <form id="crearCurso_form">
                        <div class="form-group">
                            <label for="cursoNombreInput">Nombre del curso</label>
                            <input type="text" class="form-input" id="cursoNombreInput" placeholder="Curso de programación" required>
                        </div>

                        <div class="grid-2">
                            <div class="form-group">
                                <label for="docenteCursoInput">Docente</label>
                                <select class="form-input" id="docenteCursoInput" required>
                                    <option value="" disabled selected>Seleccione un docente...</option>
                                    <?php foreach ($docentes as $docente): ?>
                                        <option value="<?= $docente['id_docente'] ?>">
                                            <?= htmlspecialchars($docente['primer_nombre'] . ' ' . $docente['primer_apellido']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="asignaturaCursoInput">Asignatura</label>
                                <select class="form-input" id="asignaturaCursoInput" required>
                                    <option value="" disabled selected>Seleccione una asignatura...</option>
                                    <?php foreach ($asignaturas as $asignatura): ?>
                                        <option value="<?= $asignatura['id_asignatura'] ?>">
                                            <?= htmlspecialchars($asignatura['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cursoDescripcionInput">Acerca del curso</label>
                            <textarea class="form-input" id="cursoDescripcionInput" rows="5"
                                placeholder="Describe brevemente de qué tratará el curso"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="cursoParaleloInput">Paralelo</label>
                            <input type="text" class="form-input" id="cursoParaleloInput" placeholder="MAT-110" required>
                        </div>

                        <div class="form-group">
                            <label>Horario del curso</label>
                            <small class="form-text">Seleccione los días de clase.</small>

                            <div class="horario-grid">
                                <label><input type="checkbox" id="lunesCheck" value="lunes"> Lunes</label>
                                <label><input type="checkbox" id="martesCheck" value="martes"> Martes</label>
                                <label><input type="checkbox" id="miercolesCheck" value="miercoles"> Miércoles</label>
                                <label><input type="checkbox" id="juevesCheck" value="jueves"> Jueves</label>
                                <label><input type="checkbox" id="viernesCheck" value="viernes"> Viernes</label>
                                <label><input type="checkbox" id="sabadoCheck" value="sabado"> Sábado</label>
                                <label><input type="checkbox" id="domingoCheck" value="domingo"> Domingo</label>
                            </div>
                        </div>

                        <div class="grid-2">
                            <div class="form-group">
                                <label for="cursoHoraInicioInput">Hora de inicio</label>
                                <input type="time" class="form-input" id="cursoHoraInicioInput" required>
                            </div>

                            <div class="form-group">
                                <label for="cursoHoraFinInput">Hora de fin</label>
                                <input type="time" class="form-input" id="cursoHoraFinInput" required>
                            </div>
                        </div>

                        <div class="form-actions-bar">
                            <a href="/gestion-docentes-web/cursos" class="btn-cancel">Cancelar</a>

                            <button id="crearCursoBtn" type="submit" class="btn-save">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2"
                                    style="margin-right: .5rem;">
                                    <path d="M12 5v14"></path>
                                    <path d="M5 12h14"></path>
                                </svg>
                                Crear curso
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
            <div class="toast-body">
            Curso creado con exito.
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="/gestion-docentes-web/public/js/curso/creacion.js"></script>

<?php require_once __DIR__."/../layout/curso/footer.php" ?>
