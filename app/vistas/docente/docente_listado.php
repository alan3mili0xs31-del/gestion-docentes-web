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
            Docentes / <span style="color: var(--c-primary-main); font-weight: 600;">Listado</span>
        </div>

        <header class="section-header">
            <div>
                <h1 class="page-title">Gestión de Docentes</h1>
                <p class="page-subtitle">Directorio de docentes registrados en el sistema.</p>
            </div>

            <div style="display: flex; gap: 1rem; align-items: center;">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Buscar por cédula o nombre...">
                </div>
                <a href="?accion=crear" class="btn-save" style="text-decoration: none;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.5rem;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Nuevo Docente
                </a>
            </div>
        </header>

        <div class="modern-card" style="padding: 1.5rem;">
            <div class="table-container" style="overflow-x: auto;">
                <table class="data-table" style="width: 100%; min-width: 800px; border-collapse: separate; border-spacing: 0 10px;">
                    <thead>
                        <tr>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">ID</th>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Cédula</th>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Nombres</th>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Apellidos</th>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Estado</th>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaDocentes">
                        <?php if (empty($docentes)): ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-gray);">
                                    No hay docentes registrados.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($docentes as $docente): ?>
                                <tr style="background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: transform 0.2s;">
                                    <td style="padding: 1rem; border-radius: 8px 0 0 8px;"><?= htmlspecialchars($docente['id_docente']) ?></td>
                                    <td style="padding: 1rem; font-weight: 600; color: var(--c-primary-main);"><?= htmlspecialchars($docente['cedula']) ?></td>
                                    <td style="padding: 1rem;"><?= htmlspecialchars(trim($docente['primer_nombre'] . ' ' . $docente['segundo_nombre'])) ?></td>
                                    <td style="padding: 1rem;"><?= htmlspecialchars(trim($docente['primer_apellido'] . ' ' . $docente['segundo_apellido'])) ?></td>
                                    <td style="padding: 1rem;">
                                        <?php if ($docente['estado'] === 'activo'): ?>
                                            <span style="background: #e8f5e9; color: #2e7d32; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: 600;">Activo</span>
                                        <?php else: ?>
                                            <span style="background: #ffebee; color: #c62828; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: 600;">Inactivo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="padding: 1rem; border-radius: 0 8px 8px 0;">
                                        <div style="display: flex; gap: 0.5rem;">
                                            <a href="?accion=buscar&id_docente=<?= $docente['id_docente'] ?>" class="btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">Detalle</a>
                                            <a href="?accion=editar&id_docente=<?= $docente['id_docente'] ?>" class="btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">Editar</a>
                                            <a href="?accion=eliminar&id_docente=<?= $docente['id_docente'] ?>" class="btn-red" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;" onclick="return confirm('¿Está seguro de eliminar este docente?');">Eliminar</a>
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

<?php require_once __DIR__."/../layout/curso/footer.php" ?>
