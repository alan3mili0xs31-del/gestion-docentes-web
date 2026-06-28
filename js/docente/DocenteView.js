class DocenteView {
    constructor() {
        this.tablaDocentes = document.getElementById('tablaDocentes');
        this.searchInput = document.getElementById('searchInput');
        this.formCrear = document.getElementById('formCrear');
        this.formEditar = document.getElementById('formEditar');
        this.contenedorDetalle = document.getElementById('contenedorDetalle');
    }

    renderTable(docentes, onEliminarClick) {
        if (!this.tablaDocentes) return;
        this.tablaDocentes.innerHTML = ''; 

        docentes.forEach(doc => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td style="color: var(--text-gray);">${doc.id}</td>
                <td style="font-weight: 600; color: var(--text-dark);">${doc.cedula}</td>
                <td>${doc.nombres}</td>
                <td>${doc.apellidos}</td>
                <td style="white-space: nowrap;">
                    <a href="detalle-docente.html?id=${doc.id}" class="btn-cancel" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; margin-right: 0.5rem; text-decoration: none;">Ver Detalle</a>
                    <a href="editar-docente.html?id=${doc.id}" style="color: var(--text-gray); text-decoration: none; font-size: 0.85rem; font-weight: 500; margin-right: 0.5rem;">Editar</a>
                    <button type="button" class="btn-eliminar" data-id="${doc.id}" style="background: transparent; border: none; color: #DC2626; cursor: pointer; font-size: 0.85rem; font-weight: 500;">Eliminar</button>
                </td>
            `;
            this.tablaDocentes.appendChild(tr);
        });

        const deleteButtons = this.tablaDocentes.querySelectorAll('.btn-eliminar');
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const id = e.target.getAttribute('data-id');
                onEliminarClick(id);
            });
        });
    }

    bindSearch(handler) {
        if (this.searchInput) {
            this.searchInput.addEventListener('keyup', (e) => {
                handler(e.target.value);
            });
        }
    }

    bindCrearDocente(handler) {
        if (this.formCrear) {
            this.formCrear.addEventListener('submit', (e) => {
                e.preventDefault();
                const cedula = document.getElementById('cedula').value.trim();
                const nombres = document.getElementById('nombres').value.trim();
                const apellidos = document.getElementById('apellidos').value.trim();

                if (!cedula || !nombres || !apellidos) {
                    alert('❌ Por favor completa todos los campos');
                    return;
                }

                handler({ cedula, nombres, apellidos });
            });
        }
    }

    bindEditarDocente(docente, handler) {
        if (this.formEditar && docente) {
            document.getElementById('docenteId').value = docente.id;
            document.getElementById('cedula').value = docente.cedula;
            document.getElementById('nombres').value = docente.nombres;
            document.getElementById('apellidos').value = docente.apellidos;

            this.formEditar.addEventListener('submit', (e) => {
                e.preventDefault();
                const cedula = document.getElementById('cedula').value.trim();
                const nombres = document.getElementById('nombres').value.trim();
                const apellidos = document.getElementById('apellidos').value.trim();

                if (!cedula || !nombres || !apellidos) {
                    alert('❌ Por favor completa todos los campos');
                    return;
                }

                handler({ cedula, nombres, apellidos });
            });
        }
    }

    renderDetalle(docente) {
        if (this.contenedorDetalle && docente) {
            this.contenedorDetalle.innerHTML = `
                <div class="grid-2" style="text-align: left;">
                    <div class="meta-group"><div class="meta-label">ID Docente</div><div class="meta-value">${docente.id}</div></div>
                    <div class="meta-group"><div class="meta-label">Cédula</div><div class="meta-value">${docente.cedula}</div></div>
                    <div class="meta-group"><div class="meta-label">Nombres</div><div class="meta-value">${docente.nombres}</div></div>
                    <div class="meta-group"><div class="meta-label">Apellidos</div><div class="meta-value">${docente.apellidos}</div></div>
                </div>
                
                <div class="form-actions-bar">
                    <a href="listado-docentes.html" class="btn-cancel">Regresar</a>
                    <a href="editar-docente.html?id=${docente.id}" class="btn-save" style="text-decoration: none;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        Editar Docente
                    </a>
                </div>
            `;
        }
    }
}
