<?php

$menu = [
    "ruta" => "inicio",
    "nombre" => "Inicio"
];

require_once __DIR__."/../layout/header.php";

$usuario_rol = $_SESSION["usuario"]["rol"];

?>

    <!-- Patrones decorativos -->
    <div class="dot-pattern top-left"></div>
    <div class="dot-pattern bottom-right"></div>

    <!-- Contenedor Principal -->
    <main class="main-container content-align-top">

        <!-- Cabecera de la secciÃ³n -->
        <header class="section-header">
            <div>
                <h1 class="page-title">Cursos registrados</h1>
                <p class="page-subtitle">Semestre Académico 2026-I</p>
            </div>

            <!-- Buscador para filtrar cursos -->
            <div class="search-box" <?php if(strcmp($usuario_rol, "administrador") != 0) echo "hidden"; ?>>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" placeholder="Buscar curso por nombre..." id="cursoBuscador">
            </div>

            <a href="/gestion-docentes-web/cursos?accion=crear" class="btn-save" style="text-decoration: none;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 0.5rem;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Nuevo Curso
            </a>
        </header>


        <div class="modern-card" style="padding: 1.5rem;">
            <div class="table-container" style="overflow-x: auto;">

                <table class="data-table" style="width: 100%; min-width: 800px; border-collapse: separate; border-spacing: 0 10px;">
                    <thead>
                        <tr>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">ID</th>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Nombre</th>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Paralelo</th>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Docente</th>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Asignatura</th>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Estado</th>
                            <th style="padding: 1rem; color: var(--text-gray); font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody id="tablaCursos">
                        <?php if (empty($cursos)): ?>
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 2rem; color: var(--text-gray);">
                                    No hay cursos registrados.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($cursos as $curso): ?>
                                <tr style="background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: transform 0.2s;">

                                    <td style="padding: 1rem; border-radius: 8px 0 0 8px;">
                                        <?= htmlspecialchars($curso['id_curso']) ?>
                                    </td>

                                    <td style="padding: 1rem; font-weight: 600; color: var(--c-primary-main);">
                                        <?= htmlspecialchars($curso['nombre']) ?>
                                    </td>

                                    <td style="padding: 1rem;">
                                        <?= htmlspecialchars($curso['paralelo']) ?>
                                    </td>

                                    <td style="padding: 1rem;">
                                        <?= htmlspecialchars($curso['docente']) ?>
                                    </td>

                                    <td style="padding: 1rem;">
                                        <?= htmlspecialchars($curso['asignatura']) ?>
                                    </td>

                                    <td style="padding: 1rem;">
                                        <?php if ($curso['estado'] === 'activo'): ?>
                                            <span style="background: #e8f5e9; color: #2e7d32; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: 600;">
                                                Activo
                                            </span>
                                        <?php else: ?>
                                            <span style="background: #ffebee; color: #c62828; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: 600;">
                                                Inactivo
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <td style="padding: 1rem; border-radius: 0 8px 8px 0;">
                                        <div style="display: flex; gap: 0.5rem;">
                                            <a href="?accion=buscar&id_curso=<?= $curso['id_curso'] ?>" class="btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">Detalle</a>

                                            <a href="?accion=eliminar&id_curso=<?= $curso['id_curso'] ?>" class="btn-red" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;" onclick="return confirm('¿Está seguro de eliminar este curso?');">
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

    <script src="/gestion-docentes-web/public/js/curso/busqueda.js"></script>

<?php require_once __DIR__."/../layout/footer.php" ?>
