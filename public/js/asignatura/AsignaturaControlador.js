/**
 * AsignaturaControlador.js
 * Orquesta Model y View usando async/await para llamadas al API.
 */
class AsignaturaControlador {
    constructor(model, view) {
        this.model = model;
        this.view = view;

        const urlParams = new URLSearchParams(window.location.search);
        this.asignaturaId = urlParams.get('id');

        this.init();
    }

    async init() {
        // Listado
        if (this.view.tablaAsignaturas) {
            await this.updateTable();
            this.view.bindFilter(this.handleFilter.bind(this));
        }

        // Crear
        if (this.view.formNueva) {
            this.view.bindCrearAsignatura(this.handleCrearAsignatura.bind(this));
        }

        // Editar: cargar datos existentes
        if (this.view.formEditar && this.asignaturaId) {
            const asignatura = await this.model.getById(this.asignaturaId);
            this.view.bindEditarAsignatura(asignatura, this.handleEditarAsignatura.bind(this));
        }
    }

    async updateTable(facultad = '') {
        const asignaturas = await this.model.getAll(facultad);
        this.view.renderTable(asignaturas, this.handleEliminarAsignatura.bind(this));
    }

    async handleFilter(facultad) {
        await this.updateTable(facultad);
    }

    async handleCrearAsignatura(data) {
        this.view.setLoading(true, 'btnGuardar');
        const res = await this.model.add(data);
        this.view.setLoading(false, 'btnGuardar');

        if (res.ok) {
            this.view.showAlert('✅ ' + res.mensaje, 'success');
            setTimeout(() => {
                window.location.href = '/gestion-docentes-web/asignaturas';
            }, 1000);
        } else {
            this.view.showAlert('❌ ' + (res.mensaje || 'Error al guardar'), 'error');
        }
    }

    async handleEditarAsignatura(data) {
        this.view.setLoading(true, 'btnActualizar');
        const res = await this.model.update(this.asignaturaId, data);
        this.view.setLoading(false, 'btnActualizar');

        if (res.ok) {
            this.view.showAlert('✅ ' + res.mensaje, 'success');
            setTimeout(() => {
                window.location.href = '/gestion-docentes-web/asignaturas';
            }, 1000);
        } else {
            this.view.showAlert('❌ ' + (res.mensaje || 'Error al actualizar'), 'error');
        }
    }

    async handleEliminarAsignatura(id) {
        if (!confirm('¿Estás seguro de eliminar esta asignatura?')) return;
        const res = await this.model.delete(id);
        if (res.ok) {
            await this.updateTable();
        } else {
            alert('❌ ' + (res.mensaje || 'Error al eliminar'));
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const model = new AsignaturaModel();
    const view  = new AsignaturaView();
    new AsignaturaControlador(model, view);
});
