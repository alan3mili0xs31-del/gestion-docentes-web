class ActividadControlador {
    constructor(model, view) {
        this.model = model;
        this.view = view;

        const urlParams = new URLSearchParams(window.location.search);
        this.actividadId = urlParams.get('id');

        // Init
        this.init();
    }

    init() {
        // En listado.html
        if (this.view.tablaActividades) {
            this.updateTable();
        }

        // En crear.html
        this.view.bindCrearActividad(this.handleCrearActividad.bind(this));

        // En editar.html
        if (this.view.formEditarActividad && this.actividadId !== null) {
            const actividad = this.model.getById(this.actividadId);
            this.view.bindEditarActividad(actividad, this.handleEditarActividad.bind(this));
        }

        // En detalle.html
        if (this.view.contenedorDetalle && this.actividadId !== null) {
            const actividad = this.model.getById(this.actividadId);
            this.view.renderDetalle(actividad, this.actividadId);
        }
    }

    updateTable() {
        const actividades = this.model.getAll();
        this.view.renderTable(actividades, this.handleEliminarActividad.bind(this));
    }

    handleCrearActividad(data) {
        this.model.add(data);
        window.location.href = 'listado.html';
    }

    handleEditarActividad(data) {
        this.model.update(this.actividadId, data);
        window.location.href = 'listado.html';
    }

    handleEliminarActividad(id) {
        if(confirm("Â¿EstÃ¡s seguro de que deseas eliminar esta actividad acadÃ©mica?")) {
            this.model.delete(id);
            this.updateTable();
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const model = new ActividadModel();
    const view = new ActividadView();
    const Controlador = new ActividadControlador(model, view);
});

