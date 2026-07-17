<?php

$menu = [
    "ruta" => "inicio",
    "nombre" => "Inicio"
];

require_once __DIR__."/../layout/header.php";

$usuario_rol = $_SESSION["usuario"]["rol"];

?>

    <div class="dot-pattern top-left"></div>
    <div class="dot-pattern bottom-right"></div>

    <main class="main-container content-align-top">

        <div class="breadcrumb" style="color: var(--text-gray); font-size: 0.85rem; margin-bottom: 1rem;">
            Asistencias / <span style="color: var(--c-primary-main); font-weight: 600;">Dashboard</span>
        </div>

        <header class="section-header">
            <div>
                <h1 class="page-title">Asistencias Recientes</h1>
                <p class="page-subtitle">Registros de asistencia de las últimas sesiones.</p>
            </div>

            <div style="display: flex; gap: 1rem; align-items: center;">
                <div class="search-box" <?php if(strcmp($usuario_rol, "administrador") != 0) echo "hidden"; ?>>
                    <input type="text" id="searchInput" placeholder="Buscar por docente, fecha o materia...">
                </div>
                <a href="?accion=crear" class="btn-save" style="text-decoration: none;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.5rem;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Registrar Asistencia
                </a>
            </div>
        </header>

        <div class="modern-card" style="padding: 1.5rem;">
            <div class="table-container" style="overflow-x: auto;">
                <table class="data-table" style="width: 100%; min-width: 950px; border-collapse: separate; border-spacing: 0 10px;">

                    <thead>
                        <tr>
                            <th style="padding:1rem; color:var(--text-gray); font-weight:600; text-transform:uppercase; font-size:.85rem;">
                                ID
                            </th>

                            <th style="padding:1rem; color:var(--text-gray); font-weight:600; text-transform:uppercase; font-size:.85rem;">
                                Docente
                            </th>

                            <th style="padding:1rem; color:var(--text-gray); font-weight:600; text-transform:uppercase; font-size:.85rem;">
                                Curso
                            </th>

                            <th style="padding:1rem; color:var(--text-gray); font-weight:600; text-transform:uppercase; font-size:.85rem;">
                                Paralelo
                            </th>

                            <th style="padding:1rem; color:var(--text-gray); font-weight:600; text-transform:uppercase; font-size:.85rem;">
                                Fecha
                            </th>

                            <th style="padding:1rem; color:var(--text-gray); font-weight:600; text-transform:uppercase; font-size:.85rem;">
                                Estado
                            </th>

                            <th style="padding:1rem; color:var(--text-gray); font-weight:600; text-transform:uppercase; font-size:.85rem;">
                                Acciones
                            </th>
                        </tr>
                    </thead>


                    <tbody id="tablaAsistencias">

                        <?php if (empty($asistencias)): ?>

                            <tr>
                                <td colspan="7" style="text-align:center; padding:2rem; color:var(--text-gray);">
                                    No hay asistencias registradas.
                                </td>
                            </tr>


                        <?php else: ?>


                            <?php foreach ($asistencias as $asistencia): ?>

                                <tr style="background:white; box-shadow:0 2px 8px rgba(0,0,0,.04); transition:transform .2s;">


                                    <td style="padding:1rem; border-radius:8px 0 0 8px;">
                                        <?= htmlspecialchars($asistencia['id_asistencia']) ?>
                                    </td>


                                    <td style="padding:1rem; font-weight:600; color:var(--c-primary-main);">

                                        <?= htmlspecialchars(
                                            $asistencia['primer_nombre'] . ' ' .
                                            $asistencia['primer_apellido']
                                        ) ?>

                                    </td>


                                    <td style="padding:1rem; color:var(--text-dark);">

                                        <?= htmlspecialchars($asistencia['curso']) ?>

                                    </td>


                                    <td style="padding:1rem; color:var(--text-dark);">

                                        <?= htmlspecialchars($asistencia['paralelo']) ?>

                                    </td>


                                    <td style="padding:1rem; color:var(--text-dark);">

                                        <?= htmlspecialchars(
                                            date("d/m/Y", strtotime($asistencia['fecha']))
                                        ) ?>

                                    </td>


                                    <td style="padding:1rem;">

                                        <?php if ($asistencia['estado'] === 'presente'): ?>

                                            <span style="background:#e8f5e9; color:#2e7d32; padding:4px 8px; border-radius:12px; font-size:.75rem; font-weight:600;">
                                                Presente
                                            </span>


                                        <?php elseif ($asistencia['estado'] === 'ausente'): ?>

                                            <span style="background:#ffebee; color:#c62828; padding:4px 8px; border-radius:12px; font-size:.75rem; font-weight:600;">
                                                Ausente
                                            </span>


                                        <?php else: ?>

                                            <span style="background:#fff3e0; color:#e65100; padding:4px 8px; border-radius:12px; font-size:.75rem; font-weight:600;">
                                                Atrasado
                                            </span>

                                        <?php endif; ?>

                                    </td>


                                    <td style="padding:1rem; border-radius:0 8px 8px 0;">

                                        <div style="display:flex; gap:.5rem;">


                                            <a href="?accion=buscar&id_asistencia=<?= $asistencia['id_asistencia'] ?>"
                                                class="btn-outline"
                                                style="padding:.4rem .8rem; font-size:.85rem;">
                                                Detalle
                                            </a>

                                            <a href="?accion=editar&id_asistencia=<?= $asistencia['id_asistencia'] ?>"
                                            class="btn-outline"
                                            style="padding:.4rem .8rem; font-size:.85rem;">
                                                Editar
                                            </a>


                                            <a href="?accion=eliminar&id_asistencia=<?= $asistencia['id_asistencia'] ?>"
                                            class="btn-red"
                                            style="padding:.4rem .8rem; font-size:.85rem;"
                                            onclick="return confirm('¿Está seguro de eliminar este registro?');">
                                                Eliminar
                                            </a>

                                        </div>

                                    </td>


                                </tr>

                            <?php endforeach; ?>


                        <?php endif; ?>

                    </tbody>

                </table>
            </div>
        </div>
    </main>

    <script src="/gestion-docentes-web/public/js/asistencias-docente/AsistenciaControlador.js"></script>

<?php require_once __DIR__."/../layout/footer.php" ?>
