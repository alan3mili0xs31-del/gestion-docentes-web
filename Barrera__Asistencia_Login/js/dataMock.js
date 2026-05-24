// Initialize mock data if not present
function initDataMock() {
    if (!localStorage.getItem('docentes')) {
        const docentes = [
            { id: 1, nombre: 'Juan Pérez', cedula: '1234567890', password: '123' },
            { id: 2, nombre: 'Ana Gómez', cedula: '0987654321', password: '123' }
        ];
        localStorage.setItem('docentes', JSON.stringify(docentes));
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