class AsignaturaModel {
    constructor() {
        this.storageKey = 'asignaturas';
        this.initData();
    }

    initData() {
        const guardadas = localStorage.getItem(this.storageKey);
        if (!guardadas) {
            const iniciales = [
                { id: 1, codigo: "INF-601", nombre: "Ingeniería de Software II", creditos: 4, semestre: "6", facultad: "FACCI" },
                { id: 2, codigo: "INF-602", nombre: "Base de Datos Avanzada", creditos: 3, semestre: "6", facultad: "FACCI" },
                { id: 3, codigo: "INF-603", nombre: "Arquitectura de Sistemas", creditos: 4, semestre: "6", facultad: "FACCI" },
            ];
            localStorage.setItem(this.storageKey, JSON.stringify(iniciales));
        }
    }

    getAll() {
        return JSON.parse(localStorage.getItem(this.storageKey)) || [];
    }

    getById(id) {
        return this.getAll().find(a => a.id === parseInt(id));
    }

    add(asignatura) {
        const asignaturas = this.getAll();
        const nuevoId = asignaturas.length > 0 ? Math.max(...asignaturas.map(a => a.id)) + 1 : 1;
        asignatura.id = nuevoId;
        asignaturas.push(asignatura);
        localStorage.setItem(this.storageKey, JSON.stringify(asignaturas));
    }

    update(id, updatedAsignatura) {
        const asignaturas = this.getAll();
        const index = asignaturas.findIndex(a => a.id === parseInt(id));
        if (index !== -1) {
            updatedAsignatura.id = parseInt(id);
            asignaturas[index] = updatedAsignatura;
            localStorage.setItem(this.storageKey, JSON.stringify(asignaturas));
        }
    }

    delete(id) {
        let asignaturas = this.getAll();
        asignaturas = asignaturas.filter(a => a.id !== parseInt(id));
        localStorage.setItem(this.storageKey, JSON.stringify(asignaturas));
    }
}
