class ActividadModel {
    constructor() {
        this.storageKey = 'db_actividades';
    }

    getAll() {
        return JSON.parse(localStorage.getItem(this.storageKey)) || [];
    }

    getById(id) {
        const actividades = this.getAll();
        return actividades[id];
    }

    add(actividad) {
        const actividades = this.getAll();
        actividades.push(actividad);
        localStorage.setItem(this.storageKey, JSON.stringify(actividades));
    }

    update(id, actividad) {
        const actividades = this.getAll();
        actividades[id] = actividad;
        localStorage.setItem(this.storageKey, JSON.stringify(actividades));
    }

    delete(id) {
        const actividades = this.getAll();
        actividades.splice(id, 1);
        localStorage.setItem(this.storageKey, JSON.stringify(actividades));
    }
}
