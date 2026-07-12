<?php

$menu = [
    "ruta" => "cursos",
    "nombre" => "Mis cursos"
];

require_once __DIR__."/../layout/curso/header.php"

?>

    <main class="main-container content-align-top">
        <div class="breadcrumb">Cursos / Ver detalles / <span class="active"><?php echo htmlspecialchars($curso['nombre']); ?></span></div>

        <header class="section-header">
            <h1 class="page-title">Detalles del curso</h1>
        </header>

        <div class="details-layout">

            <div class="form-section">
                <div class="section-card">
                    <h2 class="section-title">Información General</h2>
                    <form action="/gestion-docentes-web/cursos?accion=actualizar" method="POST" class="details-form">
                        <input type="hidden" name="id_curso" id="id_curso" value="<?php echo htmlspecialchars($curso['id_curso']); ?>"></input>
                        <div class="form-group">
                            <label>Nombre del curso</label>
                            <input readonly type="text" value="<?php echo htmlspecialchars($curso['nombre']); ?>" class="form-input" name="nombre" id="nombre">
                        </div>

                        <div class="grid-2">
                            <div class="form-group">
                                <label>Docente</label>
                                <select disabled class="form-input" name="id_docente" id="id_docente">
                                    <option value="<?php echo htmlspecialchars($curso['id_docente']); ?>"><?php echo htmlspecialchars($curso['id_docente']); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Estado del Curso</label>
                                <select disabled class="form-input" name="estado" id="estado">
                                    <?php
                                        $estado = $curso['estado'];
                                    ?>
                                    <option <?php if(strcmp($estado, "activo") == 0) echo "selected"; ?> value="activo">Activo</option>
                                    <option <?php if(strcmp($estado, "inactivo") == 0) echo "selected"; ?> value="inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Asignatura</label>
                            <select disabled class="form-input" name="id_asignatura" id="id_asignatura">
                                <option value="<?php echo htmlspecialchars($curso['id_asignatura']); ?>"><?php echo htmlspecialchars($curso['id_asignatura']); ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea readonly class="form-input" rows="5" name="descripcion" id="descripcion"><?php echo htmlspecialchars($curso['descripcion']); ?></textarea>
                        </div>

                        <div class="form-actions-bar">
                            <a href="/gestion-docentes-web/cursos" class="btn-cancel">Cancelar</a>
                            <?php
                                if(strcmp($_SESSION["usuario"]["rol"], "administrador") == 0):
                                    echo '<button type="submit" id="guardar-curso" hidden>
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                        Guardar Cambios
                                    </button>';

                                    echo '<button type="submit" class="btn-save" id="editar-curso" >
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 20h9"/>
                                            <path d="M16.5 3.5a2.12 2.12 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>
                                        </svg>
                                        Editar curso
                                    </button>';
                                endif;
                            ?>

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
                    <!-- <div class="meta-group">
                        <span class="meta-label">Última edición:</span>
                        <span class="meta-value">Hace 2 horas</span>
                    </div> -->
                    <div class="meta-group">
                        <span class="meta-label">Alumnos:</span>
                        <span class="meta-value"><?php echo htmlspecialchars($curso['cantidad_alumnos']); ?> Estudiantes</span>
                    </div>

                    <div class="meta-group">
                        <span class="meta-label">Estado:</span>
                        <strong class="text-<?php if (strcmp($estado, "activo") == 0) {
                            echo "success";
                        }
                        else {
                            echo "danger";
                        }
                        ?>"><?php echo htmlspecialchars($curso['estado']); ?></strong>
                    </div>
                </div>
            </aside>
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
        Curso actualizado con exito.
        </div>
    </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="public/js/curso/cursos.js"></script>

<?php require_once __DIR__."/../layout/curso/footer.php" ?>


