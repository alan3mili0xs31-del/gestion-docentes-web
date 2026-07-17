<?php

$menu = [
    "ruta" => "perfil",
    "nombre" => "Mi Perfil"
];

require_once __DIR__."/layout/header.php"

?>

    <div class="dot-pattern top-left"></div>
    <div class="dot-pattern bottom-right"></div>

    <main class="main-container">
        <header class="main-header" style="margin: 12px 0;">
            <div class="header-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
            </div>
            <h1>Mis Modulos</h1>
            <div class="divider"></div>
            <p>Seleccione un Modulo para gestionar su actividad académica.</p>
        </header>

        <div class="cards-grid">
            <a href="<?= BASE_URL ?>/cursos" class="modern-card card-blue">
                <div class="card-icon-wrapper">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                </div>
                <h2>Cursos</h2>
                <p>Gestione los cursos asignados</p>
                <div class="card-waves"></div>
            </a>

            <?php

                if(strcmp($_SESSION["usuario"]["rol"], "administrador") == 0) {
                    echo '<a href="' . BASE_URL . '/docentes" class="modern-card card-orange">
                        <div class="card-icon-wrapper">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>
                        <h2>Docentes</h2>
                        <p>Gestione los docentes del sistema</p>
                        <div class="card-waves"></div>
                    </a>';

                    echo '<a href="' . BASE_URL . '/asignaturas" class="modern-card card-primary">
                        <div class="card-icon-wrapper solid">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"/><rect x="9" y="9" width="6" height="6"/></svg>
                        </div>
                        <h2>Asignaturas</h2>
                        <p>Revise el contenido y materias</p>
                        <div class="card-waves"></div>
                    </a>';

                }
            ?>
            <a href="<?= BASE_URL ?>/actividades-docente" class="modern-card card-teal">
                <div class="card-icon-wrapper">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>
                </div>
                <h2>Actividades Docente</h2>
                <p>Administre tareas y evaluaciones</p>
                <div class="card-waves"></div>
            </a>

            <a href="<?= BASE_URL ?>/asistencias-docente" class="modern-card card-purple">
                <div class="card-icon-wrapper">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><rect x="8" y="14" width="8" height="4" rx="1"/></svg>
                </div>
                <h2>Asistencias Docente</h2>
                <p>Control de asistencia diaria</p>
                <div class="card-waves"></div>
            </a>
        </div>
    </main>

<?php require_once __DIR__."/layout/footer.php" ?>
