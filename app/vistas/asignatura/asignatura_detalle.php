<?php

$menu = [
    "ruta" => "asignaturas",
    "nombre" => "Asignaturas"
];

require_once __DIR__."/../layout/header.php"

?>

    <div class="dot-pattern top-left"></div>
    <div class="dot-pattern bottom-right"></div>

    <main class="main-container content-align-top">

        <div class="breadcrumb" style="color: var(--text-gray); font-size: 0.85rem; margin-bottom: 1rem;">
            <a href="/gestion-docentes-web/asignaturas" style="color: var(--text-gray); text-decoration: none;">Asignaturas</a> / <span style="color: var(--c-primary-main); font-weight: 600;">Detalles</span>
        </div>

        <header class="section-header">
            <div>
                <h1 class="page-title">Detalles de la Asignatura</h1>
                <p class="page-subtitle">Información completa de la asignatura seleccionada.</p>
            </div>
            <div>
                <a href="/gestion-docentes-web/asignaturas" class="btn-cancel">Volver al listado</a>
            </div>
        </header>

        <div class="details-layout" style="grid-template-columns: 1fr; max-width: 800px; margin: 0 auto; width: 100%;">
            <div class="form-section">
                <div class="section-card">
                    <div id="contenedorDetalle" style="color: var(--text-dark); padding: 1rem 0;">

                        <div style="margin-bottom: 1.5rem; border-bottom: 1px solid #eee; padding-bottom: 1rem;">
                            <h3 style="margin-bottom: 0.5rem; color: var(--c-primary-main);">Información General</h3>
                            <div class="grid-2" style="margin-top: 1rem;">
                                <div>
                                    <strong style="color: var(--text-gray); display: block; font-size: 0.85rem; text-transform: uppercase;">ID Asignatura</strong>
                                    <p style="font-size: 1.1rem; font-weight: 500; margin-top: 0.2rem;"><?= htmlspecialchars($asignatura['id_asignatura'] ?? 'N/A') ?></p>
                                </div>
                                <div>
                                    <strong style="color: var(--text-gray); display: block; font-size: 0.85rem; text-transform: uppercase;">Estado</strong>
                                    <p style="margin-top: 0.2rem;">
                                        <?php if (($asignatura['estado'] ?? '') === 'activo'): ?>
                                            <span style="background: #e8f5e9; color: #2e7d32; padding: 4px 8px; border-radius: 12px; font-size: 0.85rem; font-weight: 600;">Activo</span>
                                        <?php else: ?>
                                            <span style="background: #ffebee; color: #c62828; padding: 4px 8px; border-radius: 12px; font-size: 0.85rem; font-weight: 600;">Inactivo</span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>


                        <div style="margin-bottom: 1.5rem;">
                            <div class="grid-2">
                                <div>
                                    <strong style="color: var(--text-gray); display: block; font-size: 0.85rem; text-transform: uppercase;">Nombre</strong>
                                    <p style="font-size: 1.1rem; margin-top: 0.2rem;"><?= htmlspecialchars($asignatura['nombre'] ?? '') ?></p>
                                </div>
                                <div>
                                    <strong style="color: var(--text-gray); display: block; font-size: 0.85rem; text-transform: uppercase;">Codigo</strong>
                                    <p style="font-size: 1.1rem; margin-top: 0.2rem;"><?= htmlspecialchars($asignatura['codigo'] ?? '') ?></p>
                                </div>
                            </div>
                        </div>

                        <div style="margin-bottom: 1.5rem;">
                            <div class="grid-2">
                                <div>
                                    <strong style="color: var(--text-gray); display: block; font-size: 0.85rem; text-transform: uppercase;">Semestre</strong>
                                    <p style="font-size: 1.1rem; margin-top: 0.2rem;"><?= htmlspecialchars($asignatura['semestre'] ?? '') ?></p>
                                </div>
                                <div>
                                    <strong style="color: var(--text-gray); display: block; font-size: 0.85rem; text-transform: uppercase;">Creditos</strong>
                                    <p style="font-size: 1.1rem; margin-top: 0.2rem;"><?= htmlspecialchars($asignatura['creditos'] ?? '') ?></p>
                                </div>
                            </div>
                        </div>



                        <div style="margin-top: 2rem; display: flex; gap: 1rem; border-top: 1px solid #eee; padding-top: 1.5rem;">
                            <a href="?accion=editar&id_asignatura=<?= htmlspecialchars($asignatura['id_asignatura'] ?? '') ?>" class="btn-save" style="text-decoration: none;">Editar Información</a>
                            <a href="?accion=eliminar&id_asignatura=<?= htmlspecialchars($asignatura['id_asignatura'] ?? '') ?>" class="btn-red" style="text-decoration: none;" onclick="return confirm('¿Está seguro de eliminar esta asignatura?');">Eliminar Asignatura</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </main>

<?php require_once __DIR__."/../layout/footer.php" ?>
