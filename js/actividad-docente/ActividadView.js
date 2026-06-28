class ActividadView {
    constructor() {
        this.tablaActividades = document.getElementById('tablaActividades');
        this.formCrearActividad = document.getElementById('formCrearActividad');
        this.formEditarActividad = document.getElementById('formEditarActividad');
        this.contenedorDetalle = document.getElementById('contenedorDetalle');
    }

    renderTable(actividades, onEliminarClick) {
        if (!this.tablaActividades) return;
        this.tablaActividades.innerHTML = ''; 

        actividades.forEach((act, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td style="font-weight: 600; color: var(--text-dark);">${act.categoria}</td>
                <td>${act.docente}</td>
                <td>${act.horas} h</td>
                <td>${act.fechaInicio}</td>
                <td>${act.fechaFin}</td>
                <td style="white-space: nowrap;">
                    <a href="detalle.html?id=${index}" class="btn-cancel" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; margin-right: 0.5rem; text-decoration: none;">Ver / Calificar</a>
                    <a href="editar.html?id=${index}" style="color: var(--text-gray); text-decoration: none; font-size: 0.85rem; font-weight: 500; margin-right: 0.5rem;">Editar</a>
                    <button type="button" class="btn-eliminar" data-id="${index}" style="background: transparent; border: none; color: #DC2626; cursor: pointer; font-size: 0.85rem; font-weight: 500;">Eliminar</button>
                </td>
            `;
            this.tablaActividades.appendChild(tr);
        });

        // Vincular eventos de eliminar
        const deleteButtons = this.tablaActividades.querySelectorAll('.btn-eliminar');
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const id = e.target.getAttribute('data-id');
                onEliminarClick(id);
            });
        });
    }

    bindCrearActividad(handler) {
        if (this.formCrearActividad) {
            this.formCrearActividad.addEventListener('submit', (e) => {
                e.preventDefault();
                const data = {
                    categoria: document.getElementById('categoria').value,
                    docente: "Sebastián Acosta", 
                    horas: document.getElementById('horas').value,
                    fechaInicio: document.getElementById('fechaInicio').value,
                    fechaFin: document.getElementById('fechaFin').value
                };
                handler(data);
            });
        }
    }

    bindEditarActividad(actividadData, handler) {
        if (this.formEditarActividad && actividadData) {
            document.getElementById('categoria').value = actividadData.categoria;
            document.getElementById('horas').value = actividadData.horas;
            document.getElementById('fechaInicio').value = actividadData.fechaInicio;
            document.getElementById('fechaFin').value = actividadData.fechaFin;

            this.formEditarActividad.addEventListener('submit', (e) => {
                e.preventDefault();
                const data = {
                    categoria: document.getElementById('categoria').value,
                    docente: actividadData.docente,
                    horas: document.getElementById('horas').value,
                    fechaInicio: document.getElementById('fechaInicio').value,
                    fechaFin: document.getElementById('fechaFin').value
                };
                handler(data);
            });
        }
    }

    renderDetalle(act, actividadId) {
        if (this.contenedorDetalle && act) {
            this.contenedorDetalle.innerHTML = `
                <div class="grid-2" style="text-align: left;">
                    <div class="meta-group"><div class="meta-label">Categoría</div><div class="meta-value">${act.categoria}</div></div>
                    <div class="meta-group"><div class="meta-label">Docente</div><div class="meta-value">${act.docente}</div></div>
                    <div class="meta-group"><div class="meta-label">Horas Realizadas</div><div class="meta-value">${act.horas} horas</div></div>
                    <div class="meta-group"><div class="meta-label">Fecha de Inicio</div><div class="meta-value">${act.fechaInicio}</div></div>
                    <div class="meta-group"><div class="meta-label">Fecha de Fin</div><div class="meta-value">${act.fechaFin}</div></div>
                </div>
                
                <div class="form-actions-bar">
                    <a href="listado.html" class="btn-cancel">Regresar</a>
                    <a href="editar.html?id=${actividadId}" class="btn-save" style="text-decoration: none;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        Ir a Editar
                    </a>
                </div>
            `;
        }
    }
}
