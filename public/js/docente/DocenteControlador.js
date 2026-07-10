class DocenteControlador {
    constructor(model, view) {
        this.model = model;
        this.view = view;

        const urlParams = new URLSearchParams(window.location.search);
        this.docenteId = urlParams.get('id');

        this.init();
    }

    init() {
        if (this.view.tablaDocentes) {
            this.updateTable();
            this.view.bindSearch(this.handleSearch.bind(this));
        }

        if (this.view.formCrear) {
            this.view.bindCrearDocente(this.handleCrearDocente.bind(this));
        }

        if (this.view.formEditar && this.docenteId !== null) {
            const docente = this.model.getById(this.docenteId);
            this.view.bindEditarDocente(docente, this.handleEditarDocente.bind(this));
        }

        if (this.view.contenedorDetalle && this.docenteId !== null) {
            const docente = this.model.getById(this.docenteId);
            this.view.renderDetalle(docente);
        }
    }

    updateTable(data = null) {
        const docentes = data || this.model.getAll();
        this.view.renderTable(docentes, this.handleEliminarDocente.bind(this));
    }

    handleSearch(term) {
        const termLower = term.toLowerCase().trim();
        const todos = this.model.getAll();
        const filtrados = todos.filter(doc => 
            doc.cedula.toLowerCase().includes(termLower) || 
            doc.nombres.toLowerCase().includes(termLower) || 
            doc.apellidos.toLowerCase().includes(termLower)
        );
        this.updateTable(filtrados);
    }

    handleCrearDocente(data) {
        this.model.add(data);
        alert('Docente creado exitosamente');
        window.location.href = 'listado-docentes.html';
    }

    handleEditarDocente(data) {
        this.model.update(this.docenteId, data);
        alert('Docente actualizado correctamente');
        window.location.href = 'listado-docentes.html';
    }

    handleEliminarDocente(id) {
        if (confirm('Â¿EstÃ¡s seguro de eliminar este docente?')) {
            this.model.delete(id);
            this.updateTable();
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const model = new DocenteModel();
    const view = new DocenteView();
    const Controlador = new DocenteControlador(model, view);
});

