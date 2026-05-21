document.addEventListener('DOMContentLoaded', () => {
    
    const tablaActividades = document.getElementById('tablaActividades');
    const formCrearActividad = document.getElementById('formCrearActividad');
    const formEditarActividad = document.getElementById('formEditarActividad');
    const contenedorDetalle = document.getElementById('contenedorDetalle');

    const urlParams = new URLSearchParams(window.location.search);
    const actividadId = urlParams.get('id');

    function cargarActividades() {
        if (!tablaActividades) return;

        const actividades = JSON.parse(localStorage.getItem('db_actividades')) || [];
        tablaActividades.innerHTML = ''; 

        actividades.forEach((act, index) => {
            tablaActividades.innerHTML += `
                <tr>
                    <td>${act.categoria}</td>
                    <td>${act.docente}</td>
                    <td>${act.horas}</td>
                    <td>${act.fechaInicio}</td>
                    <td>${act.fechaFin}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="detalle.html?id=${index}" class="btn btn-sm btn-outline-secondary" title="Ver Detalle"><i class="bi bi-eye"></i></a>
                            <a href="editar.html?id=${index}" class="btn btn-sm btn-outline-dark" title="Editar"><i class="bi bi-pencil"></i></a>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="eliminarActividad(${index})" title="Eliminar"><i class="bi bi-trash"></i></button>
                        </div>
                    </td>
                </tr>
            `;
        });
    }

    if (tablaActividades) {
        cargarActividades();
    }

    if (formCrearActividad) {
        formCrearActividad.addEventListener('submit', function(event) {
            event.preventDefault();

            const nuevaActividad = {
                categoria: document.getElementById('categoria').value,
                docente: "Sebastián Acosta", 
                horas: document.getElementById('horas').value,
                fechaInicio: document.getElementById('fechaInicio').value,
                fechaFin: document.getElementById('fechaFin').value
            };

            const actividades = JSON.parse(localStorage.getItem('db_actividades')) || [];
            actividades.push(nuevaActividad);
            localStorage.setItem('db_actividades', JSON.stringify(actividades));

            window.location.href = 'listado.html';
        });
    }

    if (formEditarActividad && actividadId !== null) {
        const actividades = JSON.parse(localStorage.getItem('db_actividades')) || [];
        const act = actividades[actividadId];

        if (act) {
            document.getElementById('categoria').value = act.categoria;
            document.getElementById('horas').value = act.horas;
            document.getElementById('fechaInicio').value = act.fechaInicio;
            document.getElementById('fechaFin').value = act.fechaFin;
        }

        formEditarActividad.addEventListener('submit', function(event) {
            event.preventDefault();

            actividades[actividadId].categoria = document.getElementById('categoria').value;
            actividades[actividadId].horas = document.getElementById('horas').value;
            actividades[actividadId].fechaInicio = document.getElementById('fechaInicio').value;
            actividades[actividadId].fechaFin = document.getElementById('fechaFin').value;

            localStorage.setItem('db_actividades', JSON.stringify(actividades));
            window.location.href = 'listado.html';
        });
    }

    if (contenedorDetalle && actividadId !== null) {
        const actividades = JSON.parse(localStorage.getItem('db_actividades')) || [];
        const act = actividades[actividadId];

        if (act) {
            contenedorDetalle.innerHTML = `
                <div class="row mb-3"><div class="col-sm-4 fw-bold">Categoría:</div><div class="col-sm-8">${act.categoria}</div></div><hr class="text-muted">
                <div class="row mb-3"><div class="col-sm-4 fw-bold">Docente:</div><div class="col-sm-8">${act.docente}</div></div><hr class="text-muted">
                <div class="row mb-3"><div class="col-sm-4 fw-bold">Horas Realizadas:</div><div class="col-sm-8">${act.horas} horas</div></div><hr class="text-muted">
                <div class="row mb-3"><div class="col-sm-4 fw-bold">Fecha de Inicio:</div><div class="col-sm-8">${act.fechaInicio}</div></div><hr class="text-muted">
                <div class="row mb-3"><div class="col-sm-4 fw-bold">Fecha de Fin:</div><div class="col-sm-8">${act.fechaFin}</div></div>
                
                <div class="d-flex justify-content-end mt-4">
                    <a href="editar.html?id=${actividadId}" class="btn btn-dark me-2">Ir a Editar</a>
                    <a href="listado.html" class="btn btn-outline-secondary">Regresar</a>
                </div>
            `;
        }
    }
});

window.eliminarActividad = function(index) {
    if(confirm("¿Estás seguro de que deseas eliminar esta actividad académica?")) {
        const actividades = JSON.parse(localStorage.getItem('db_actividades')) || [];
        actividades.splice(index, 1); 
        localStorage.setItem('db_actividades', JSON.stringify(actividades));
        location.reload(); 
    }
}