class AsignaturaView {
    constructor() {
        this.tablaAsignaturas = document.getElementById('tablaAsignaturas');
        this.filtrarFacultad = document.getElementById('filtrarFacultad');
        this.formNueva = document.getElementById('formNueva');
        this.formEditar = document.getElementById('formEditar');
        this.contenedorDetalle = document.getElementById('contenedorDetalle');
    }

    renderTable(asignaturas, onEliminarClick) {
        if (!this.tablaAsignaturas) return;
        this.tablaAsignaturas.innerHTML = ''; 

        const semestresMap = {
            "1": "Primer Semestre",
            "2": "Segundo Semestre",
            "3": "Tercer Semestre",
            "4": "Cuarto Semestre",
            "5": "Quinto Semestre",
            "6": "Sexto Semestre"
        };
        const facultadesMap = {
            "FACCI": "Ciencias Informáticas",
            "FACI": "Ciencias Industriales",
            "FACE": "Ciencias Económicas"
        };

        asignaturas.forEach(asig => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td style="font-weight: 600; color: var(--text-dark);">${asig.codigo}</td>
                <td>${asig.nombre}</td>
                <td>${asig.creditos}</td>
                <td>${semestresMap[asig.semestre] || asig.semestre}</td>
                <td>${facultadesMap[asig.facultad] || asig.facultad}</td>
                <td style="white-space: nowrap;">
                    <a href="detalle-asignatura.html?id=${asig.id}" class="btn-cancel" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; margin-right: 0.5rem; text-decoration: none;">Ver Detalle</a>
                    <a href="editar-asignatura.html?id=${asig.id}" style="color: var(--text-gray); text-decoration: none; font-size: 0.85rem; font-weight: 500; margin-right: 0.5rem;">Editar</a>
                    <button type="button" class="btn-eliminar" data-id="${asig.id}" style="background: transparent; border: none; color: #DC2626; cursor: pointer; font-size: 0.85rem; font-weight: 500;">Eliminar</button>
                </td>
            `;
            this.tablaAsignaturas.appendChild(tr);
        });

        const deleteButtons = this.tablaAsignaturas.querySelectorAll('.btn-eliminar');
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const id = e.target.getAttribute('data-id');
                onEliminarClick(id);
            });
        });
    }

    bindFilter(handler) {
        if (this.filtrarFacultad) {
            this.filtrarFacultad.addEventListener('change', (e) => {
                handler(e.target.value);
            });
        }
    }

    bindCrearAsignatura(handler) {
        if (this.formNueva) {
            this.formNueva.addEventListener('submit', (e) => {
                e.preventDefault();
                const codigo = document.getElementById('codigo').value.trim();
                const nombre = document.getElementById('nombre').value.trim();
                const creditos = parseInt(document.getElementById('creditos').value);
                const semestre = document.getElementById('semestre').value;
                const facultad = document.getElementById('facultad').value;

                if (!codigo || !nombre || !creditos || !semestre || !facultad) {
                    alert('❌ Por favor completa todos los campos');
                    return;
                }

                handler({ codigo, nombre, creditos, semestre, facultad });
            });
        }
    }

    bindEditarAsignatura(asignatura, handler) {
        if (this.formEditar && asignatura) {
            document.getElementById('asignaturaId').value = asignatura.id;
            document.getElementById('codigo').value = asignatura.codigo;
            document.getElementById('nombre').value = asignatura.nombre;
            document.getElementById('creditos').value = asignatura.creditos;
            document.getElementById('semestre').value = asignatura.semestre;
            document.getElementById('facultad').value = asignatura.facultad;

            this.formEditar.addEventListener('submit', (e) => {
                e.preventDefault();
                const codigo = document.getElementById('codigo').value.trim();
                const nombre = document.getElementById('nombre').value.trim();
                const creditos = parseInt(document.getElementById('creditos').value);
                const semestre = document.getElementById('semestre').value;
                const facultad = document.getElementById('facultad').value;

                if (!codigo || !nombre || !creditos || !semestre || !facultad) {
                    alert('❌ Por favor completa todos los campos');
                    return;
                }

                handler({ codigo, nombre, creditos, semestre, facultad });
            });
        }
    }

    renderDetalle(asignatura) {
        if (this.contenedorDetalle && asignatura) {
            const semestresMap = { "1": "Primer Semestre", "2": "Segundo Semestre", "3": "Tercer Semestre", "4": "Cuarto Semestre", "5": "Quinto Semestre", "6": "Sexto Semestre" };
            const facultadesMap = { "FACCI": "Ciencias Informáticas", "FACI": "Ciencias Industriales", "FACE": "Ciencias Económicas" };

            this.contenedorDetalle.innerHTML = `
                <div class="grid-2" style="text-align: left;">
                    <div class="meta-group"><div class="meta-label">ID Sistema</div><div class="meta-value">${asignatura.id}</div></div>
                    <div class="meta-group"><div class="meta-label">Código</div><div class="meta-value">${asignatura.codigo}</div></div>
                    <div class="meta-group"><div class="meta-label">Nombre de Materia</div><div class="meta-value">${asignatura.nombre}</div></div>
                    <div class="meta-group"><div class="meta-label">Créditos</div><div class="meta-value">${asignatura.creditos}</div></div>
                    <div class="meta-group"><div class="meta-label">Semestre</div><div class="meta-value">${semestresMap[asignatura.semestre] || asignatura.semestre}</div></div>
                    <div class="meta-group"><div class="meta-label">Facultad</div><div class="meta-value">${facultadesMap[asignatura.facultad] || asignatura.facultad}</div></div>
                </div>
                
                <div class="form-actions-bar">
                    <a href="listado-asignaturas.html" class="btn-cancel">Regresar al listado</a>
                    <a href="editar-asignatura.html?id=${asignatura.id}" class="btn-save" style="text-decoration: none;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        Editar Asignatura
                    </a>
                </div>
            `;
        }
    }
}
