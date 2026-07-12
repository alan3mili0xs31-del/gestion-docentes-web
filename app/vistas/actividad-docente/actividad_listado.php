<?php

$menu = [
    "ruta" => "inicio",
    "nombre" => "Inicio"
];

require_once __DIR__."/../layout/curso/header.php"

?>

    <div class="dot-pattern top-left"></div>
    <div class="dot-pattern bottom-right"></div>

    <main class="main-container content-align-top">

        <div class="breadcrumb" style="color: var(--text-gray); font-size: 0.85rem; margin-bottom: 1rem;">
            Actividades / <span style="color: var(--c-primary-main); font-weight: 600;">Panel Principal</span>
        </div>

        <header class="section-header">
            <div>
                <h1 class="page-title">Actividades Académicas</h1>
                <p class="page-subtitle">Administra las asignaciones de docentes a las asignaturas.</p>
            </div>

            <div style="display: flex; gap: 1rem; align-items: center;">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Buscar actividad...">
                </div>
                <a href="?accion=crear" class="btn-save" style="text-decoration: none;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.5rem;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Nueva Actividad
                </a>
            </div>
        </header>

        <div class="modern-card" style="padding: 1.5rem;">
            <div class="table-container" style="overflow-x: auto;">
                <table class="data-table" style="width: 100%; min-width: 800px; border-collapse: separate; border-spacing: 0 10px;">
                    <thead>
                        <tr>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">ID</th>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Docente</th>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Asignatura</th>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaActividades">
                        <?php if (empty($actividades)): ?>
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 2rem; color: var(--text-gray);">
                                    No hay actividades registradas.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($actividades as $actividad): ?>
                                <tr style="background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: transform 0.2s;">
                                    <td style="padding: 1rem; border-radius: 8px 0 0 8px;"><?= htmlspecialchars($actividad['id_actividad']) ?></td>
                                    <td style="padding: 1rem; font-weight: 600; color: var(--c-primary-main);">
                                        <?= htmlspecialchars($actividad['primer_nombre'] . ' ' . $actividad['primer_apellido'] . ' (' . $actividad['cedula'] . ')') ?>
                                    </td>
                                    <td style="padding: 1rem; color: var(--text-dark);">
                                        <?= htmlspecialchars($actividad['asignatura_nombre']) ?>
                                    </td>
                                    <td style="padding: 1rem; border-radius: 0 8px 8px 0;">
                                        <div style="display: flex; gap: 0.5rem;">
                                            <a href="?accion=buscar&id_actividad=<?= $actividad['id_actividad'] ?>" class="btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">Detalle</a>
                                            <a href="?accion=editar&id_actividad=<?= $actividad['id_actividad'] ?>" class="btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">Editar</a>
                                            <a href="?accion=eliminar&id_actividad=<?= $actividad['id_actividad'] ?>" class="btn-red" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;" onclick="return confirm('¿Está seguro de eliminar esta actividad?');">Eliminar</a>
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

    <script src="/gestion-docentes-web/public/js/actividad-docente/ActividadControlador.js"></script>

<?php require_once __DIR__."/../layout/curso/footer.php" ?>
