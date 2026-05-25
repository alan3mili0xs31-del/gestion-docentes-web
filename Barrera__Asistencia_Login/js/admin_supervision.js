// js/admin_supervision.js

document.addEventListener('DOMContentLoaded', () => {
    const usuarioRol = sessionStorage.getItem('usuarioRol');
    if (usuarioRol !== 'admin') {
        window.location.href = 'login.html';
        return;
    }

    // Configurar navbar y botón salir
    const adminActual = JSON.parse(localStorage.getItem('usuarios')).find(u => u.id === parseInt(sessionStorage.getItem('usuarioLogueadoId')));
    if (adminActual) document.getElementById('navbarUserName').textContent = adminActual.nombre;
    
    document.getElementById('btnLogout').addEventListener('click', () => {
        sessionStorage.clear();
        window.location.href = 'login.html';
    });

    const tabla = document.getElementById('tablaSupervision');
    const filtroDocente = document.getElementById('filtroDocente');
    const filtroFecha = document.getElementById('filtroFecha');
    const filtroEstado = document.getElementById('filtroEstado');
    
    // Cargar selector de docentes para el filtro
    const docentes = JSON.parse(localStorage.getItem('usuarios')).filter(u => u.rol === 'docente');
    docentes.forEach(d => {
        filtroDocente.innerHTML += `<option value="${d.id}">${d.nombre}</option>`;
    });

    function renderTabla() {
        let asistencias = JSON.parse(localStorage.getItem('asistencias')) || [];
        const cursos = JSON.parse(localStorage.getItem('cursos')) || [];

        // Aplicar Filtros
        if (filtroDocente.value) asistencias = asistencias.filter(a => a.id_docente == filtroDocente.value);
        if (filtroFecha.value) asistencias = asistencias.filter(a => a.fecha_asistencia === filtroFecha.value);
        if (filtroEstado.value) asistencias = asistencias.filter(a => a.estado === filtroEstado.value);

        // Ordenar por fecha reciente
        asistencias.sort((a, b) => new Date(b.fecha_asistencia) - new Date(a.fecha_asistencia));

        tabla.innerHTML = '';
        if(asistencias.length === 0) {
            tabla.innerHTML = `<tr><td colspan="5" class="text-center">No se encontraron registros.</td></tr>`;
            return;
        }

        asistencias.forEach(a => {
            const doc = docentes.find(d => d.id == a.id_docente);
            const cur = cursos.find(c => c.id == a.id_curso);
            let badge = a.estado === 'Presente' ? 'bg-success' : (a.estado === 'Ausente' ? 'bg-danger' : 'bg-warning text-dark');
            
            tabla.innerHTML += `
                <tr>
                    <td>${doc ? doc.nombre : 'Desconocido'}</td>
                    <td>${a.fecha_asistencia}</td>
                    <td>${cur ? cur.nombre_materia : ''}</td>
                    <td><span class="badge ${badge}">${a.estado}</span></td>
                    <td><a href="editar.html?id=${a.id}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i> Editar</a></td>
                </tr>
            `;
        });
    }

    // Escuchar cambios en los filtros
    filtroDocente.addEventListener('change', renderTabla);
    filtroFecha.addEventListener('change', renderTabla);
    filtroEstado.addEventListener('change', renderTabla);

    document.getElementById('btnLimpiar').addEventListener('click', () => {
        filtroDocente.value = ''; filtroFecha.value = ''; filtroEstado.value = '';
        renderTabla();
    });

    renderTabla();
});