class AsistenciaControlador {
    constructor(model, view) {
        this.model = model;
        this.view = view;

        const params = new URLSearchParams(window.location.search);
        this.asistenciaId = params.get('id');
        this.docenteLogueadoId = sessionStorage.getItem('docenteLogueadoId');

        this.init();
    }

    init() {
        // Auth guard: skip on login page
        const path = window.location.pathname;
        if (!path.endsWith('login.php') && !this.docenteLogueadoId) {
            window.location.href = '../login.php';
            return;
        }

        // Set name in navbar
        if (this.docenteLogueadoId) {
            const docentes = this.model.getDocentes();
            const docente = docentes.find(d => d.id === parseInt(this.docenteLogueadoId));
            if (docente) this.view.setUserName(docente.nombres || docente.nombre || '');
        }

        this.view.bindLogout(this.handleLogout.bind(this));

        const docentes = this.model.getDocentes();
        const cursos = this.model.getCursos();

        // Dashboard view
        if (this.view.tablaDashboard) {
            const mias = this.model.getMine(this.docenteLogueadoId);
            this.view.renderTabla(this.view.tablaDashboard, mias, docentes, cursos, true);
        }

        // Historial view
        if (this.view.tablaHistorial) {
            const mias = this.model.getMine(this.docenteLogueadoId);
            this.view.renderTabla(this.view.tablaHistorial, mias, docentes, cursos, false);
        }

        // Registrar view
        if (this.view.formRegistrar) {
            this.view.populateSelects('docente', 'curso', docentes, cursos, this.docenteLogueadoId);
            this.view.bindRegistrar(this.handleRegistrar.bind(this));
        }

        // Editar view
        if (this.view.formEditar && this.asistenciaId) {
            const asistencia = this.model.getById(this.asistenciaId);
            if (!asistencia) { alert('Asistencia no encontrada.'); window.location.href = 'dashboard.html'; return; }
            if (asistencia.id_docente !== parseInt(this.docenteLogueadoId)) { alert('No tienes permiso.'); window.location.href = 'dashboard.html'; return; }

            this.view.populateSelects('docente', 'curso', docentes, cursos, this.docenteLogueadoId);
            this.view.fillEditForm(asistencia);
            this.view.bindEditar(this.handleEditar.bind(this));
        }
    }

    handleLogout() {
        sessionStorage.removeItem('docenteLogueadoId');
        window.location.href = '../login.php';
    }

    handleRegistrar(data) {
        this.model.add(data);
        window.location.href = 'dashboard.html';
    }

    handleEditar(data) {
        this.model.update(data.id, data);
        window.location.href = 'dashboard.html';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const model = new AsistenciaModel();
    const view = new AsistenciaView();
    const Controlador = new AsistenciaControlador(model, view);
});

