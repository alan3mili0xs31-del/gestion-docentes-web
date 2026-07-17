<?php

$menu = [
    "ruta" => "asistencias-docente",
    "nombre" => "Asistencias de Docente"
];

require_once __DIR__."/../layout/header.php"

?>

    <div class="dot-pattern top-left"></div>
    <div class="dot-pattern bottom-right"></div>

    <main class="main-container content-align-top">

        <div class="breadcrumb" style="color: var(--text-gray); font-size: 0.85rem; margin-bottom: 1rem;">
            <a href="/gestion-docentes-web/asistencias-docente" style="color: var(--text-gray); text-decoration: none;">Asistencias</a> / <span style="color: var(--c-primary-main); font-weight: 600;">Detalles</span>
        </div>

        <header class="section-header">
            <div>
                <h1 class="page-title">Detalles de la Asistencia</h1>
                <p class="page-subtitle">Información completa de la asistencia seleccionada.</p>
            </div>
            <div>
                <a href="/gestion-docentes-web/asistencias-docente" class="btn-cancel">Volver al listado</a>
            </div>
        </header>

        <div class="details-layout" style="grid-template-columns: 1fr; max-width: 800px; margin: 0 auto; width: 100%;">
            <div class="form-section">
                <div class="section-card">

                    <div id="contenedorDetalle" style="color: var(--text-dark); padding: 1rem 0;">


                        <div style="margin-bottom:1.5rem; border-bottom:1px solid #eee; padding-bottom:1rem;">

                            <h3 style="margin-bottom:.5rem; color:var(--c-primary-main);">
                                Información General
                            </h3>


                            <div class="grid-2" style="margin-top:1rem;">


                                <div>
                                    <strong style="color:var(--text-gray); display:block; font-size:.85rem; text-transform:uppercase;">
                                        ID Asistencia
                                    </strong>

                                    <p style="font-size:1.1rem; font-weight:500; margin-top:.2rem;">
                                        <?= htmlspecialchars($asistencia['id_asistencia']) ?>
                                    </p>
                                </div>


                                <div>
                                    <strong style="color:var(--text-gray); display:block; font-size:.85rem; text-transform:uppercase;">
                                        Estado
                                    </strong>

                                    <p style="font-size:1.1rem; margin-top:.2rem;">
                                        <?= htmlspecialchars(ucfirst($asistencia['estado'])) ?>
                                    </p>
                                </div>


                                <div>
                                    <strong style="color:var(--text-gray); display:block; font-size:.85rem; text-transform:uppercase;">
                                        Fecha
                                    </strong>

                                    <p style="font-size:1.1rem; margin-top:.2rem;">
                                        <?= htmlspecialchars(date("d/m/Y", strtotime($asistencia['fecha']))) ?>
                                    </p>
                                </div>


                            </div>

                        </div>



                        <div style="margin-bottom:1.5rem; border-bottom:1px solid #eee; padding-bottom:1rem;">

                            <h3 style="margin-bottom:.5rem; color:var(--c-primary-main);">
                                Curso
                            </h3>


                            <div class="grid-2">


                                <div>
                                    <strong style="color:var(--text-gray); display:block; font-size:.85rem; text-transform:uppercase;">
                                        Curso
                                    </strong>

                                    <p style="margin-top:.2rem;">
                                        <?= htmlspecialchars($asistencia['curso']) ?>
                                    </p>
                                </div>


                                <div>
                                    <strong style="color:var(--text-gray); display:block; font-size:.85rem; text-transform:uppercase;">
                                        Paralelo
                                    </strong>

                                    <p style="margin-top:.2rem;">
                                        <?= htmlspecialchars($asistencia['paralelo']) ?>
                                    </p>
                                </div>


                                <div>
                                    <strong style="color:var(--text-gray); display:block; font-size:.85rem; text-transform:uppercase;">
                                        Asignatura
                                    </strong>

                                    <p style="margin-top:.2rem;">
                                        <?= htmlspecialchars($asistencia['asignatura_nombre']) ?>
                                    </p>
                                </div>


                            </div>

                        </div>




                        <div style="margin-bottom:1.5rem;">

                            <h3 style="margin-bottom:.5rem; color:var(--c-primary-main);">
                                Docente Responsable
                            </h3>


                            <div class="grid-2">


                                <div>
                                    <strong style="color:var(--text-gray); display:block; font-size:.85rem; text-transform:uppercase;">
                                        Docente
                                    </strong>

                                    <p style="margin-top:.2rem;">
                                        <?= htmlspecialchars(
                                            $asistencia['primer_nombre'] . ' ' . $asistencia['primer_apellido']
                                        ) ?>
                                    </p>
                                </div>


                            </div>

                        </div>



                        <div style="margin-top:2rem; display:flex; gap:1rem; border-top:1px solid #eee; padding-top:1.5rem;">


                            <a href="?accion=editar&id_asistencia=<?= htmlspecialchars($asistencia['id_asistencia']) ?>"
                            class="btn-save"
                            style="text-decoration:none;">
                                Editar Registro
                            </a>


                            <a href="?accion=eliminar&id_asistencia=<?= htmlspecialchars($asistencia['id_asistencia']) ?>"
                            class="btn-red"
                            style="text-decoration:none;"
                            onclick="return confirm('¿Está seguro de eliminar esta asistencia?');">
                                Eliminar Registro
                            </a>


                        </div>


                    </div>

                </div>
            </div>
        </div>

    </main>

<?php require_once __DIR__."/../layout/footer.php" ?>
