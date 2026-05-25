// js/asistencia.js

document.addEventListener('DOMContentLoaded', () => {
    const path = window.location.pathname;
    const isLoginPage = path.endsWith('login.html');
    const usuarioRol = sessionStorage.getItem('usuarioRol');
    
    if (!isLoginPage) {
        const usuarioLogueadoId = sessionStorage.getItem('usuarioLogueadoId');
        if (!usuarioLogueadoId) {
            window.location.href = 'login.html';
            return;
        }
    }

    function getDocenteLogueado() {
        const id = parseInt(sessionStorage.getItem('usuarioLogueadoId'));
        const usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];
        return usuarios.find(u => u.id === id);
    }
    
    const navbarUserName = document.getElementById('navbarUserName');
    if (navbarUserName) {
        const docente = getDocenteLogueado();
        if (docente) navbarUserName.textContent = docente.nombre;
    }

    const btnLogout = document.getElementById('btnLogout');
    if (btnLogout) {
        btnLogout.addEventListener('click', (e) => {
            e.preventDefault();
            sessionStorage.clear();
            window.location.href = 'login.html';
        });
    }

    const tablaDashboard = document.getElementById('tablaDashboard');
    const tablaHistorial = document.getElementById('tablaHistorial');
    const formRegistrar = document.getElementById('formRegistrar');
    const formEditar = document.getElementById('formEditar');

    if (tablaDashboard || tablaHistorial) {
        cargarTablaAsistencias(tablaDashboard || tablaHistorial);
    }

    function cargarTablaAsistencias(tbodyElement) {
        const docenteLogueado = getDocenteLogueado();
        const asistencias = JSON.parse(localStorage.getItem('asistencias')) || [];
        const cursos = JSON.parse(localStorage.getItem('cursos')) || [];
        const usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];
        const docentes = usuarios.filter(u => u.rol === 'docente');

        if (!docenteLogueado) return;

        let misAsistencias = asistencias;
        // Si no es admin, solo ve sus propias asistencias
        if (usuarioRol !== 'admin') {
            misAsistencias = asistencias.filter(a => a.id_docente === docenteLogueado.id);
        }

        misAsistencias.sort((a, b) => new Date(b.fecha_asistencia) - new Date(a.fecha_asistencia));
        tbodyElement.innerHTML = '';

        if (misAsistencias.length === 0) {
            tbodyElement.innerHTML = `<tr><td colspan="5" class="text-center">No hay registros de asistencia.</td></tr>`;
            return;
        }

        misAsistencias.forEach(asistencia => {
            const docente = docentes.find(d => d.id === asistencia.id_docente);
            const curso = cursos.find(c => c.id === asistencia.id_curso);
            
            let estadoBadge = asistencia.estado === 'Presente' ? '<span class="badge bg-success">Presente</span>' : 
                              (asistencia.estado === 'Ausente' ? '<span class="badge bg-danger">Ausente</span>' : 
                              '<span class="badge bg-warning text-dark">Atraso</span>');

            let acciones = tbodyElement.id === 'tablaDashboard' ? 
                `<a href="editar.html?id=${asistencia.id}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i> Editar</a>` : 
                `<span class="text-muted">Solo lectura</span>`;

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

    function cargarSelects(docenteSelectId, cursoSelectId) {
        const docenteSelect = document.getElementById(docenteSelectId);
        const cursoSelect = document.getElementById(cursoSelectId);
        
        const usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];
        const docentes = usuarios.filter(u => u.rol === 'docente');
        const cursos = JSON.parse(localStorage.getItem('cursos')) || [];

        if (docenteSelect) {
            docentes.forEach(d => {
                const option = document.createElement('option');
                option.value = d.id;
                option.textContent = d.nombre;
                docenteSelect.appendChild(option);
            });
            
            const docenteLogueado = getDocenteLogueado();
            if (docenteLogueado) {
                // Si es admin, NO bloqueamos el select
                if (usuarioRol !== 'admin') {
                    docenteSelect.value = docenteLogueado.id;
                    docenteSelect.disabled = true; 
                }
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

            asistencias.push({ id: nuevoId, id_docente: docenteId, id_curso: cursoId, fecha_asistencia: fecha, estado: estado });
            localStorage.setItem('asistencias', JSON.stringify(asistencias));
            
            window.location.href = usuarioRol === 'admin' ? 'admin_asistencias.html' : 'dashboard.html';
        });
    }

    if (formEditar) {
        cargarSelects('docente', 'curso');
        const urlParams = new URLSearchParams(window.location.search);
        const asistenciaId = parseInt(urlParams.get('id'));
        
        if (isNaN(asistenciaId)) {
            window.location.href = 'dashboard.html';
            return;
        }

        const asistencias = JSON.parse(localStorage.getItem('asistencias')) || [];
        const asistencia = asistencias.find(a => a.id === asistenciaId);

        if (!asistencia) {
            window.location.href = 'dashboard.html';
            return;
        }

        const docenteLogueadoId = parseInt(sessionStorage.getItem('usuarioLogueadoId'));
        // El admin se salta esta validación
        if (asistencia.id_docente !== docenteLogueadoId && usuarioRol !== 'admin') {
            alert("No tienes permiso para editar este registro.");
            window.location.href = 'dashboard.html';
            return;
        }

        document.getElementById('asistenciaId').value = asistencia.id;
        document.getElementById('docente').value = asistencia.id_docente;
        document.getElementById('curso').value = asistencia.id_curso;
        document.getElementById('fecha').value = asistencia.fecha_asistencia;
        document.getElementById('estado').value = asistencia.estado;

        formEditar.addEventListener('submit', (e) => {
            e.preventDefault();
            const id = parseInt(document.getElementById('asistenciaId').value);
            const index = asistencias.findIndex(a => a.id === id);
            
            if (index !== -1) {
                asistencias[index] = {
                    id: id,
                    id_docente: parseInt(document.getElementById('docente').value),
                    id_curso: parseInt(document.getElementById('curso').value),
                    fecha_asistencia: document.getElementById('fecha').value,
                    estado: document.getElementById('estado').value
                };
                localStorage.setItem('asistencias', JSON.stringify(asistencias));
                window.location.href = usuarioRol === 'admin' ? 'admin_asistencias.html' : 'dashboard.html';
            }
        });
    }
});