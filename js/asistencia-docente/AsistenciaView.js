class AsistenciaView {
    constructor() {
        this.tablaDashboard = document.getElementById('tablaDashboard');
        this.tablaHistorial = document.getElementById('tablaHistorial');
        this.formRegistrar = document.getElementById('formRegistrar');
        this.formEditar = document.getElementById('formEditar');
        this.navbarUserName = document.getElementById('navbarUserName');
    }

    setUserName(nombre) {
        if (this.navbarUserName) this.navbarUserName.textContent = nombre;
    }

    _estadoBadge(estado) {
        const colores = { 'Presente': '#10B981', 'Ausente': '#DC2626', 'Atraso': '#F59E0B' };
        return `<span style="color: ${colores[estado] || '#6B7280'}; font-weight: 600;">${estado}</span>`;
    }

    renderTabla(tbodyEl, asistencias, docentes, cursos, modoEditar = false) {
        if (!tbodyEl) return;
        tbodyEl.innerHTML = '';

        if (asistencias.length === 0) {
            tbodyEl.innerHTML = `<tr><td colspan="5" style="text-align:center; color: var(--text-gray); padding: 2rem;">No hay registros de asistencia.</td></tr>`;
            return;
        }

        asistencias.forEach(asistencia => {
            const docente = docentes.find(d => d.id === asistencia.id_docente);
            const curso = cursos.find(c => c.id === asistencia.id_curso);
            const accionesHtml = modoEditar
                ? `<a href="editar.html?id=${asistencia.id}" style="color: var(--text-gray); text-decoration: none; font-size: 0.85rem; font-weight: 500;">Editar</a>`
                : `<span style="color: var(--text-gray); font-size: 0.85rem;">Solo lectura</span>`;

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td style="font-weight: 600; color: var(--text-dark);">${docente ? (docente.nombres || docente.nombre || docente.cedula) : 'Desconocido'}</td>
                <td>${asistencia.fecha_asistencia}</td>
                <td>${curso ? (curso.nombre_materia || curso.nombre) : 'Desconocido'}</td>
                <td>${this._estadoBadge(asistencia.estado)}</td>
                <td>${accionesHtml}</td>
            `;
            tbodyEl.appendChild(tr);
        });
    }

    populateSelects(docenteSelectId, cursoSelectId, docentes, cursos, docenteLogueadoId = null) {
        const docenteSelect = document.getElementById(docenteSelectId);
        const cursoSelect = document.getElementById(cursoSelectId);

        if (docenteSelect) {
            docentes.forEach(d => {
                const opt = document.createElement('option');
                opt.value = d.id;
                opt.textContent = d.nombres || d.nombre || d.cedula;
                docenteSelect.appendChild(opt);
            });
            if (docenteLogueadoId) {
                docenteSelect.value = docenteLogueadoId;
                docenteSelect.disabled = true;
            }
        }

        if (cursoSelect) {
            cursos.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c.id;
                opt.textContent = c.nombre_materia || c.nombre;
                cursoSelect.appendChild(opt);
            });
        }
    }

    fillEditForm(asistencia) {
        if (!this.formEditar || !asistencia) return;
        document.getElementById('asistenciaId').value = asistencia.id;
        document.getElementById('docente').value = asistencia.id_docente;
        document.getElementById('curso').value = asistencia.id_curso;
        document.getElementById('fecha').value = asistencia.fecha_asistencia;
        document.getElementById('estado').value = asistencia.estado;
    }

    bindRegistrar(handler) {
        if (!this.formRegistrar) return;
        this.formRegistrar.addEventListener('submit', e => {
            e.preventDefault();
            handler({
                id_docente: parseInt(document.getElementById('docente').value),
                id_curso: parseInt(document.getElementById('curso').value),
                fecha_asistencia: document.getElementById('fecha').value,
                estado: document.getElementById('estado').value
            });
        });
    }

    bindEditar(handler) {
        if (!this.formEditar) return;
        this.formEditar.addEventListener('submit', e => {
            e.preventDefault();
            handler({
                id: parseInt(document.getElementById('asistenciaId').value),
                id_docente: parseInt(document.getElementById('docente').value),
                id_curso: parseInt(document.getElementById('curso').value),
                fecha_asistencia: document.getElementById('fecha').value,
                estado: document.getElementById('estado').value
            });
        });
    }

    bindLogout(handler) {
        const btn = document.getElementById('btnLogout');
        if (btn) btn.addEventListener('click', e => { e.preventDefault(); handler(); });
    }
}
