// js/dataMock.js

function initDataMock() {
    // Limpiamos la vieja clave "docentes" si existe, para forzar la actualización a "usuarios"
    if (localStorage.getItem('docentes')) {
        localStorage.removeItem('docentes');
    }

    if (!localStorage.getItem('usuarios')) {
        const usuarios = [
            // Docentes
            { id: 1, nombre: 'Juan Pérez', cedula: '1234567890', password: '123', rol: 'docente' },
            { id: 2, nombre: 'Ana Gómez', cedula: '0987654321', password: '123', rol: 'docente' },
            // Nuevo Administrador
            { id: 3, nombre: 'Admin Sistema', cedula: '0000000000', password: 'admin', rol: 'admin' }
        ];
        localStorage.setItem('usuarios', JSON.stringify(usuarios));
    }

    if (!localStorage.getItem('cursos')) {
        const cursos = [
            { id: 1, nombre_materia: 'Matemáticas' },
            { id: 2, nombre_materia: 'Física' },
            { id: 3, nombre_materia: 'Programación Web' }
        ];
        localStorage.setItem('cursos', JSON.stringify(cursos));
    }

    if (!localStorage.getItem('asistencias')) {
        const asistencias = [
            { id: 1, id_docente: 1, id_curso: 1, fecha_asistencia: '2026-05-20', estado: 'Presente' },
            { id: 2, id_docente: 1, id_curso: 3, fecha_asistencia: '2026-05-21', estado: 'Atraso' },
            { id: 3, id_docente: 2, id_curso: 2, fecha_asistencia: '2026-05-22', estado: 'Ausente' }
        ];
        localStorage.setItem('asistencias', JSON.stringify(asistencias));
    }
}

initDataMock();