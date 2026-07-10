class DocenteModel {
    constructor() {
        this.storageKey = 'docentes';
        this.initData();
    }

    initData() {
        const guardados = localStorage.getItem(this.storageKey);
        if (!guardados) {
            const iniciales = [
                { id: 1, cedula: "1712345678", nombres: "Juan Carlos", apellidos: "Pérez López" },
                { id: 2, cedula: "1756789012", nombres: "María Elena", apellidos: "González Ruiz" },
                { id: 3, cedula: "1709876543", nombres: "Carlos Andrés", apellidos: "Mendoza Torres" },
            ];
            localStorage.setItem(this.storageKey, JSON.stringify(iniciales));
        }
    }

    getAll() {
        return JSON.parse(localStorage.getItem(this.storageKey)) || [];
    }

    getById(id) {
        return this.getAll().find(d => d.id === parseInt(id));
    }

    add(docente) {
        const docentes = this.getAll();
        const nuevoId = docentes.length > 0 ? Math.max(...docentes.map(d => d.id)) + 1 : 1;
        docente.id = nuevoId;
        docentes.push(docente);
        localStorage.setItem(this.storageKey, JSON.stringify(docentes));
    }

    update(id, updatedDocente) {
        const docentes = this.getAll();
        const index = docentes.findIndex(d => d.id === parseInt(id));
        if (index !== -1) {
            updatedDocente.id = parseInt(id);
            docentes[index] = updatedDocente;
            localStorage.setItem(this.storageKey, JSON.stringify(docentes));
        }
    }

    delete(id) {
        let docentes = this.getAll();
        docentes = docentes.filter(d => d.id !== parseInt(id));
        localStorage.setItem(this.storageKey, JSON.stringify(docentes));
    }
}
