document.addEventListener('DOMContentLoaded', () => {
    // Check if user is logged in for protected pages
    const path = window.location.pathname;
    const isLoginPage = path.endsWith('login.html');
    
    if (!isLoginPage) {
        const docenteLogueadoId = sessionStorage.getItem('docenteLogueadoId');
        if (!docenteLogueadoId) {
            window.location.href = 'login.html';
            return;
        }
    }

    // Helper to get logged-in user
    function getDocenteLogueado() {
        const id = parseInt(sessionStorage.getItem('docenteLogueadoId'));
        console.log(id);
        const docentes = JSON.parse(localStorage.getItem('docentes')) || [];
        console.log(docentes);
        return docentes.find(d => d.id === id);
    }
    
    // Set user name in navbar
    const navbarUserName = document.getElementById('navbarUserName');
    if (navbarUserName) {
        const docente = getDocenteLogueado();
        if (docente) navbarUserName.textContent = docente.nombre;
    }

    // Logout
    const btnLogout = document.getElementById('btnLogout');
    if (btnLogout) {
        btnLogout.addEventListener('click', (e) => {
            e.preventDefault();
            sessionStorage.removeItem('docenteLogueadoId');
            window.location.href = 'login.html';
        });
    }

    const tablaDashboard = document.getElementById('tablaDashboard');
    const tablaHistorial = document.getElementById('tablaHistorial');
    const formRegistrar = document.getElementById('formRegistrar');
    const formEditar = document.getElementById('formEditar');

    // Dashboard & Historial - Load Table
    if (tablaDashboard || tablaHistorial) {
        cargarTablaAsistencias(tablaDashboard || tablaHistorial);
    }

    function cargarTablaAsistencias(tbodyElement) {
        const docenteLogueado = getDocenteLogueado();
        const asistencias = JSON.parse(localStorage.getItem('asistencias')) || [];
        const cursos = JSON.parse(localStorage.getItem('cursos')) || [];
        const docentes = JSON.parse(localStorage.getItem('docentes')) || [];

        const misAsistencias = asistencias
            .filter(a => a.id_docente === docenteLogueado.id)
            .sort((a, b) => new Date(b.fecha_asistencia) - new Date(a.fecha_asistencia));

        tbodyElement.innerHTML = '';

        if (misAsistencias.length === 0) {
            tbodyElement.innerHTML = `<tr><td colspan="5" class="text-center">No hay registros de asistencia.</td></tr>`;
            return;
        }

        misAsistencias.forEach(asistencia => {
            const docente = docentes.find(d => d.id === asistencia.id_docente);
            const curso = cursos.find(c => c.id === asistencia.id_curso);
            
            let estadoBadge = '';
            if (asistencia.estado === 'Presente') estadoBadge = '<span class="badge bg-success">Presente</span>';
            else if (asistencia.estado === 'Ausente') estadoBadge = '<span class="badge bg-danger">Ausente</span>';
            else estadoBadge = '<span class="badge bg-warning text-dark">Atraso</span>';

            let acciones = '';
            if (tbodyElement.id === 'tablaDashboard') {
                acciones = `
                    <a href="editar.html?id=${asistencia.id}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i> Editar</a>
                `;
            } else {
                 acciones = `<span class="text-muted">Solo lectura</span>`;
            }

            tbodyElement.innerHTML += `
                <tr>
                    <td>${docente ? docente.nombre : 'Desconocido'}</td>
                    <td>${asistencia.fecha_asistencia}</td>
                    <td>${curso ? curso.nombre_materia : 'Desconocido'}</td>
                    <td>${estadoBadge}</td>
                    <td>${acciones}</td>
                </tr>
            `;
        });
    }

    // Registrar / Editar - Load Selects
    function cargarSelects(docenteSelectId, cursoSelectId) {
        const docenteSelect = document.getElementById(docenteSelectId);
        const cursoSelect = document.getElementById(cursoSelectId);
        
        const docentes = JSON.parse(localStorage.getItem('docentes')) || [];
        const cursos = JSON.parse(localStorage.getItem('cursos')) || [];

        if (docenteSelect) {
            docentes.forEach(d => {
                const option = document.createElement('option');
                option.value = d.id;
                option.textContent = d.nombre;
                docenteSelect.appendChild(option);
            });
            // Pre-select logged in user
            const docenteLogueado = getDocenteLogueado();
            if (docenteLogueado) {
                docenteSelect.value = docenteLogueado.id;
                docenteSelect.disabled = true; // Prevent changing own id for simplicity in this flow
            }
        }

        if (cursoSelect) {
            cursos.forEach(c => {
                const option = document.createElement('option');
                option.value = c.id;
                option.textContent = c.nombre_materia;
                cursoSelect.appendChild(option);
            });
        }
    }

    if (formRegistrar) {
        cargarSelects('docente', 'curso');

        formRegistrar.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const docenteId = parseInt(document.getElementById('docente').value);
            const cursoId = parseInt(document.getElementById('curso').value);
            const fecha = document.getElementById('fecha').value;
            const estado = document.getElementById('estado').value;

            const asistencias = JSON.parse(localStorage.getItem('asistencias')) || [];
            const nuevoId = asistencias.length > 0 ? Math.max(...asistencias.map(a => a.id)) + 1 : 1;

            asistencias.push({
                id: nuevoId,
                id_docente: docenteId,
                id_curso: cursoId,
                fecha_asistencia: fecha,
                estado: estado
            });

            localStorage.setItem('asistencias', JSON.stringify(asistencias));
            window.location.href = 'dashboard.html';
        });
    }

    if (formEditar) {
        cargarSelects('docente', 'curso');
        
        const urlParams = new URLSearchParams(window.location.search);
        const asistenciaId = parseInt(urlParams.get('id'));
        
        if (isNaN(asistenciaId)) {
            alert("ID de asistencia no válido.");
            window.location.href = 'dashboard.html';
            return;
        }

        const asistencias = JSON.parse(localStorage.getItem('asistencias')) || [];
        const asistencia = asistencias.find(a => a.id === asistenciaId);

        if (!asistencia) {
            alert("Asistencia no encontrada.");
            window.location.href = 'dashboard.html';
            return;
        }

        // Check if the current user owns this record (security check for prototype)
        const docenteLogueadoId = parseInt(sessionStorage.getItem('docenteLogueadoId'));
        if (asistencia.id_docente !== docenteLogueadoId) {
            alert("No tienes permiso para editar este registro.");
            window.location.href = 'dashboard.html';
            return;
        }

        // Fill form
        document.getElementById('asistenciaId').value = asistencia.id;
        document.getElementById('docente').value = asistencia.id_docente;
        document.getElementById('curso').value = asistencia.id_curso;
        document.getElementById('fecha').value = asistencia.fecha_asistencia;
        document.getElementById('estado').value = asistencia.estado;

        formEditar.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const id = parseInt(document.getElementById('asistenciaId').value);
            const docenteId = parseInt(document.getElementById('docente').value);
            const cursoId = parseInt(document.getElementById('curso').value);
            const fecha = document.getElementById('fecha').value;
            const estado = document.getElementById('estado').value;

            const index = asistencias.findIndex(a => a.id === id);
            if (index !== -1) {
                asistencias[index] = {
                    id: id,
                    id_docente: docenteId,
                    id_curso: cursoId,
                    fecha_asistencia: fecha,
                    estado: estado
                };
                localStorage.setItem('asistencias', JSON.stringify(asistencias));
                window.location.href = 'dashboard.html';
            }
        });
    }
});