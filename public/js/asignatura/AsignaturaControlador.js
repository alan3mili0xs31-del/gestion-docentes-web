class AsignaturaControlador {
    constructor(model, view) {
        this.model = model;
        this.view = view;

        const urlParams = new URLSearchParams(window.location.search);
        this.asignaturaId = urlParams.get('id');

        this.init();
    }

    init() {
        if (this.view.tablaAsignaturas) {
            this.updateTable();
            this.view.bindFilter(this.handleFilter.bind(this));
        }

        if (this.view.formNueva) {
            this.view.bindCrearAsignatura(this.handleCrearAsignatura.bind(this));
        }

        if (this.view.formEditar && this.asignaturaId !== null) {
            const asignatura = this.model.getById(this.asignaturaId);
            this.view.bindEditarAsignatura(asignatura, this.handleEditarAsignatura.bind(this));
        }

        if (this.view.contenedorDetalle && this.asignaturaId !== null) {
            const asignatura = this.model.getById(this.asignaturaId);
            this.view.renderDetalle(asignatura);
        }
    }

    updateTable(data = null) {
        const asignaturas = data || this.model.getAll();
        this.view.renderTable(asignaturas, this.handleEliminarAsignatura.bind(this));
    }

    handleFilter(facultad) {
        if (!facultad) {
            this.updateTable();
            return;
        }
        const todas = this.model.getAll();
        const filtradas = todas.filter(asig => asig.facultad === facultad);
        this.updateTable(filtradas);
    }

    handleCrearAsignatura(data) {
        this.model.add(data);
        alert('Asignatura creada exitosamente');
        window.location.href = 'listado-asignaturas.html';
    }

    handleEditarAsignatura(data) {
        this.model.update(this.asignaturaId, data);
        alert('Asignatura actualizada correctamente');
        window.location.href = 'listado-asignaturas.html';
    }

    handleEliminarAsignatura(id) {
        if (confirm('Â¿EstÃ¡s seguro de eliminar esta asignatura?')) {
            this.model.delete(id);
            this.updateTable();
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const model = new AsignaturaModel();
    const view = new AsignaturaView();
    const Controlador = new AsignaturaControlador(model, view);
});

