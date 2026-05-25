// js/admin.js

document.addEventListener('DOMContentLoaded', () => {
    // 1. Verificación de Seguridad y Rol
    const usuarioLogueadoId = sessionStorage.getItem('usuarioLogueadoId');
    const usuarioRol = sessionStorage.getItem('usuarioRol');

    if (!usuarioLogueadoId || usuarioRol !== 'admin') {
        window.location.href = 'login.html';
        return;
    }

    // Configurar nombre en el navbar
    const usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];
    const adminActual = usuarios.find(u => u.id === parseInt(usuarioLogueadoId));
    if (adminActual && document.getElementById('navbarUserName')) {
        document.getElementById('navbarUserName').textContent = adminActual.nombre;
    }

    // Logout
    const btnLogout = document.getElementById('btnLogout');
    if (btnLogout) {
        btnLogout.addEventListener('click', (e) => {
            e.preventDefault();
            sessionStorage.clear();
            window.location.href = 'login.html';
        });
    }

    // 2. Lógica CRUD de Asignaturas
    const tablaAsignaturas = document.getElementById('tablaAsignaturas');
    const formAsignatura = document.getElementById('formAsignatura');
    const btnNuevaAsignatura = document.getElementById('btnNuevaAsignatura');
    const modalAsignaturaLabel = document.getElementById('modalAsignaturaLabel');
    
    // Instancia del modal de Bootstrap para controlarlo por JS
    const modalInstancia = new bootstrap.Modal(document.getElementById('modalAsignatura'));

    // (Leer) Renderizar la tabla
    function cargarTablaCursos() {
        const cursos = JSON.parse(localStorage.getItem('cursos')) || [];
        tablaAsignaturas.innerHTML = '';

        if (cursos.length === 0) {
            tablaAsignaturas.innerHTML = `<tr><td colspan="3" class="text-center">No hay asignaturas registradas.</td></tr>`;
            return;
        }

        cursos.forEach(curso => {
            tablaAsignaturas.innerHTML += `
                <tr>
                    <td>${curso.id}</td>
                    <td>${curso.nombre_materia}</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-primary me-1" onclick="editarCurso(${curso.id})"><i class="bi bi-pencil"></i> Editar</button>
                        <button class="btn btn-sm btn-outline-danger" onclick="eliminarCurso(${curso.id})"><i class="bi bi-trash"></i> Eliminar</button>
                    </td>
                </tr>
            `;
        });
    }

    // Preparar el modal para Crear (limpiar datos viejos)
    if (btnNuevaAsignatura) {
        btnNuevaAsignatura.addEventListener('click', () => {
            document.getElementById('asignaturaId').value = '';
            document.getElementById('nombreMateria').value = '';
            modalAsignaturaLabel.textContent = 'Nueva Asignatura';
        });
    }

    // (Crear y Actualizar) Manejar el envío del formulario
    if (formAsignatura) {
        formAsignatura.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const idInput = document.getElementById('asignaturaId').value;
            const nombreMateria = document.getElementById('nombreMateria').value;
            let cursos = JSON.parse(localStorage.getItem('cursos')) || [];

            if (idInput) {
                // Actualizar existente
                const id = parseInt(idInput);
                const index = cursos.findIndex(c => c.id === id);
                if (index !== -1) {
                    cursos[index].nombre_materia = nombreMateria;
                }
            } else {
                // Crear nuevo
                const nuevoId = cursos.length > 0 ? Math.max(...cursos.map(c => c.id)) + 1 : 1;
                cursos.push({
                    id: nuevoId,
                    nombre_materia: nombreMateria
                });
            }

            localStorage.setItem('cursos', JSON.stringify(cursos));
            cargarTablaCursos();
            modalInstancia.hide();
        });
    }

    // (Actualizar - Paso 1) Cargar datos en el formulario
    window.editarCurso = function(id) {
        const cursos = JSON.parse(localStorage.getItem('cursos')) || [];
        const curso = cursos.find(c => c.id === id);
        
        if (curso) {
            document.getElementById('asignaturaId').value = curso.id;
            document.getElementById('nombreMateria').value = curso.nombre_materia;
            modalAsignaturaLabel.textContent = 'Editar Asignatura';
            modalInstancia.show();
        }
    };

    // (Eliminar) Borrar un curso
    window.eliminarCurso = function(id) {
        if (confirm('¿Estás seguro de que deseas eliminar esta asignatura?')) {
            let cursos = JSON.parse(localStorage.getItem('cursos')) || [];
            cursos = cursos.filter(c => c.id !== id);
            localStorage.setItem('cursos', JSON.stringify(cursos));
            cargarTablaCursos();
        }
    };

    // Cargar la tabla al iniciar
    if (tablaAsignaturas) {
        cargarTablaCursos();
    }
});