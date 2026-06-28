class AsistenciaModel {
    constructor() {
        this.storageKey = 'asistencias';
    }

    getAll() {
        return JSON.parse(localStorage.getItem(this.storageKey)) || [];
    }

    getById(id) {
        return this.getAll().find(a => a.id === parseInt(id));
    }

    getMine(docenteId) {
        return this.getAll()
            .filter(a => a.id_docente === parseInt(docenteId))
            .sort((a, b) => new Date(b.fecha_asistencia) - new Date(a.fecha_asistencia));
    }

    add(asistencia) {
        const asistencias = this.getAll();
        const nuevoId = asistencias.length > 0 ? Math.max(...asistencias.map(a => a.id)) + 1 : 1;
        asistencia.id = nuevoId;
        asistencias.push(asistencia);
        localStorage.setItem(this.storageKey, JSON.stringify(asistencias));
    }

    update(id, updatedData) {
        const asistencias = this.getAll();
        const index = asistencias.findIndex(a => a.id === parseInt(id));
        if (index !== -1) {
            updatedData.id = parseInt(id);
            asistencias[index] = updatedData;
            localStorage.setItem(this.storageKey, JSON.stringify(asistencias));
        }
    }

    delete(id) {
        let asistencias = this.getAll().filter(a => a.id !== parseInt(id));
        localStorage.setItem(this.storageKey, JSON.stringify(asistencias));
    }

    getDocentes() {
        return JSON.parse(localStorage.getItem('docentes')) || [];
    }

    getCursos() {
        return JSON.parse(localStorage.getItem('cursos')) || [];
    }
}
