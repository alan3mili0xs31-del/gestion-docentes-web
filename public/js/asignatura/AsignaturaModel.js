/**
 * AsignaturaModel.js
 * Capa de datos: realiza peticiones al API PHP.
 * Base: /gestion-docentes-web/asignaturas
 */
class AsignaturaModel {
    constructor() {
        this.baseUrl = '/gestion-docentes-web/asignaturas';
    }

    async getAll(facultad = '') {
        const url = facultad
            ? `${this.baseUrl}?accion=api_listar&facultad=${encodeURIComponent(facultad)}`
            : `${this.baseUrl}?accion=api_listar`;
        const res = await fetch(url);
        const json = await res.json();
        return json.data || [];
    }

    async getById(id) {
        const res = await fetch(`${this.baseUrl}?accion=api_buscar&id=${id}`);
        if (!res.ok) return null;
        const json = await res.json();
        return json.data || null;
    }

    async add(asignatura) {
        const res = await fetch(`${this.baseUrl}?accion=guardar`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(asignatura)
        });
        return await res.json();
    }

    async update(id, asignatura) {
        const res = await fetch(`${this.baseUrl}?accion=actualizar&id=${id}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(asignatura)
        });
        return await res.json();
    }

    async delete(id) {
        const res = await fetch(`${this.baseUrl}?accion=eliminar&id=${id}`, {
            method: 'DELETE'
        });
        return await res.json();
    }
}
