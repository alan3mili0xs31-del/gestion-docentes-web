document.addEventListener('DOMContentLoaded', () => {
    
    const formCrear = document.getElementById("formCrearAsistencia");
    if (formCrear) {
        formCrear.addEventListener("submit", async function (e) {
            e.preventDefault();
            
            const id_docente = document.getElementById("id_docente").value;
            const id_asignatura = document.getElementById("id_asignatura").value;
            const fecha = document.getElementById("fecha").value;
            const estado = document.getElementById("estado").value;
            
            const datos = { id_docente, id_asignatura, fecha, estado };
            
            try {
                const resp = await fetch("/gestion-docentes-web/asistencias-docente?accion=guardar", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(datos)
                });
                
                if (resp.ok) {
                    const data = await resp.json();
                    mostrarMensaje(data.success, data.mensaje);
                    if (data.success) {
                        setTimeout(() => window.location.href = '/gestion-docentes-web/asistencias-docente', 1500);
                    }
                } else {
                    mostrarMensaje(false, "Error al crear la asistencia");
                }
            } catch (error) {
                mostrarMensaje(false, error.message);
            }
        });
    }

    const formEditar = document.getElementById("formEditarAsistencia");
    if (formEditar) {
        formEditar.addEventListener("submit", async function (e) {
            e.preventDefault();
            
            const id_asistencia = document.getElementById("asistenciaId").value;
            const id_docente = document.getElementById("id_docente").value;
            const id_asignatura = document.getElementById("id_asignatura").value;
            const fecha = document.getElementById("fecha").value;
            const estado = document.getElementById("estado").value;
            
            const datos = { id_asistencia, id_docente, id_asignatura, fecha, estado };
            
            try {
                const resp = await fetch("/gestion-docentes-web/asistencias-docente?accion=actualizar", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(datos)
                });
                
                if (resp.ok) {
                    const data = await resp.json();
                    mostrarMensaje(data.success, data.mensaje);
                    if (data.success) {
                        setTimeout(() => window.location.href = '/gestion-docentes-web/asistencias-docente', 1500);
                    }
                } else {
                    mostrarMensaje(false, "Error al actualizar la asistencia");
                }
            } catch (error) {
                mostrarMensaje(false, error.message);
            }
        });
    }

    // Búsqueda en vivo para la tabla de asistencias
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tablaAsistencias');

    if (searchInput && tableBody) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            const rows = tableBody.querySelectorAll('tr');

            rows.forEach(row => {
                if (row.cells.length > 1) { // Ignorar la fila de "No hay asistencias"
                    const id = row.cells[0].textContent.toLowerCase();
                    const docente = row.cells[1].textContent.toLowerCase();
                    const asignatura = row.cells[2].textContent.toLowerCase();
                    const fecha = row.cells[3].textContent.toLowerCase();
                    const estado = row.cells[4].textContent.toLowerCase();

                    if (id.includes(searchTerm) || docente.includes(searchTerm) || asignatura.includes(searchTerm) || fecha.includes(searchTerm) || estado.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        });
    }
});

function mostrarMensaje(estadoTransaccion, mensaje) {
    const toastLiveExample = document.getElementById('liveToast')
    const contenido = document.getElementById('toastMessage')
    const icon_repuesta = document.getElementById('icono_respuesta');

    if (!toastLiveExample) return; // Si no hay toast en la página, no hace nada (ej. listado)

    if (estadoTransaccion) {
        icon_repuesta.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="9 12 12 15 16 9"></polyline>
        </svg>`;
    } else {
        icon_repuesta.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>`;
    }

    contenido.innerText = mensaje;
    if (typeof bootstrap !== 'undefined') {
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
        toastBootstrap.show();
    } else {
        alert(mensaje);
    }
}
