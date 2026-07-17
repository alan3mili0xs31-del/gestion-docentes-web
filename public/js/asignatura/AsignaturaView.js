/**
 * AsignaturaView.js
 * Renderiza la tabla, formularios y maneja la UI.
 */
class AsignaturaView {
    constructor() {
        this.tablaAsignaturas = document.getElementById('tablaAsignaturas');
        this.filtrarFacultad  = document.getElementById('filtrarFacultad');
        this.formNueva        = document.getElementById('formNueva');
        this.formEditar       = document.getElementById('formEditar');
        this.tableWrapper     = document.getElementById('tableWrapper');
        this.spinner          = document.getElementById('spinner');
        this.emptyState       = document.getElementById('emptyState');
    }

    /* ── Mapas de texto ── */
    semestresMap = {
        "1": "1° Semestre", "2": "2° Semestre", "3": "3° Semestre",
        "4": "4° Semestre", "5": "5° Semestre", "6": "6° Semestre"
    };
    facultadesMap = {
        "FACCI": "Cs. Informáticas",
        "FACI":  "Cs. Industriales",
        "FACE":  "Cs. Económicas"
    };

    /* ── Tabla ── */
    renderTable(asignaturas, onEliminarClick) {
        if (!this.tablaAsignaturas) return;

        // Ocultar spinner y mostrar tabla
        if (this.spinner)     this.spinner.style.display = 'none';
        if (this.tableWrapper) this.tableWrapper.style.display = 'block';

        this.tablaAsignaturas.innerHTML = '';

        if (!asignaturas.length) {
            if (this.emptyState) this.emptyState.style.display = 'block';
            return;
        }
        if (this.emptyState) this.emptyState.style.display = 'none';

        asignaturas.forEach(asig => {
            const tr = document.createElement('tr');
            const nombreFacultad = this.facultadesMap[asig.facultad] || asig.facultad;

            tr.innerHTML = `
                <td style="font-weight: 700; color: var(--c-primary-main, #3b5bdb);">${asig.codigo}</td>
                <td style="font-weight: 500;">${asig.nombre}</td>
                <td>${asig.creditos}</td>
                <td>${this.semestresMap[asig.semestre] || asig.semestre}</td>
                <td><span class="badge-facultad">${nombreFacultad}</span></td>
                <td style="white-space: nowrap;">
                    <a href="/gestion-docentes-web/asignaturas?accion=editar&id=${asig.id_asignatura}"
                       style="color: var(--text-gray); text-decoration: none; font-size: 0.85rem; font-weight: 500; margin-right: 0.8rem;">
                       Editar
                    </a>
                    <button type="button" class="btn-eliminar"
                            data-id="${asig.id_asignatura}"
                            style="background:transparent; border:none; color:#DC2626; cursor:pointer; font-size:0.85rem; font-weight:500;">
                        Eliminar
                    </button>
                </td>
            `;
            this.tablaAsignaturas.appendChild(tr);
        });

        this.tablaAsignaturas.querySelectorAll('.btn-eliminar').forEach(btn => {
            btn.addEventListener('click', e => {
                const id = e.target.getAttribute('data-id');
                onEliminarClick(id);
            });
        });
    }

    /* ── Filtro ── */
    bindFilter(handler) {
        if (this.filtrarFacultad) {
            this.filtrarFacultad.addEventListener('change', e => handler(e.target.value));
        }
    }

    /* ── Formulario Nueva ── */
    bindCrearAsignatura(handler) {
        if (!this.formNueva) return;
        this.formNueva.addEventListener('submit', e => {
            e.preventDefault();
            const data = this._recogerDatos();
            if (!data) return;
            handler(data);
        });
    }

    /* ── Formulario Editar: pre-carga datos ── */
    bindEditarAsignatura(asignatura, handler) {
        if (!this.formEditar || !asignatura) {
            if (this.formEditar && !asignatura) {
                this.showAlert('❌ No se encontró la asignatura', 'error');
            }
            return;
        }

        document.getElementById('asignaturaId').value = asignatura.id_asignatura;
        document.getElementById('codigo').value        = asignatura.codigo;
        document.getElementById('nombre').value        = asignatura.nombre;
        document.getElementById('creditos').value      = asignatura.creditos;
        document.getElementById('semestre').value      = asignatura.semestre;
        document.getElementById('facultad').value      = asignatura.facultad;

        this.formEditar.addEventListener('submit', e => {
            e.preventDefault();
            const data = this._recogerDatos();
            if (!data) return;
            handler(data);
        });
    }

    /* ── Helpers ── */
    _recogerDatos() {
        const codigo   = document.getElementById('codigo')?.value.trim();
        const nombre   = document.getElementById('nombre')?.value.trim();
        const creditos = parseInt(document.getElementById('creditos')?.value);
        const semestre = document.getElementById('semestre')?.value;
        const facultad = document.getElementById('facultad')?.value;

        if (!codigo || !nombre || !creditos || !semestre || !facultad) {
            this.showAlert('❌ Por favor completa todos los campos', 'error');
            return null;
        }
        return { codigo, nombre, creditos, semestre, facultad };
    }

    showAlert(mensaje, tipo) {
        const el = document.getElementById('alertMsg');
        if (!el) return;
        el.textContent = mensaje;
        el.style.display = 'block';
        el.style.background = tipo === 'success' ? '#d1fae5' : '#fee2e2';
        el.style.color      = tipo === 'success' ? '#065f46' : '#991b1b';
        el.style.border     = `1px solid ${tipo === 'success' ? '#6ee7b7' : '#fca5a5'}`;
    }

    setLoading(loading, btnId) {
        const btn = document.getElementById(btnId);
        if (!btn) return;
        btn.disabled = loading;
        btn.style.opacity = loading ? '0.6' : '1';
    }
}
