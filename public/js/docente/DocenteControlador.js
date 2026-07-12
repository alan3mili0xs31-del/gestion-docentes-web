document.addEventListener('DOMContentLoaded', () => {
    
    const formCrear = document.getElementById("formCrear");
    if (formCrear) {
        formCrear.addEventListener("submit", async function (e) {
            e.preventDefault();
            
            const cedula = document.getElementById("cedula").value.trim();
            const nombres = document.getElementById("nombres").value.trim();
            const apellidos = document.getElementById("apellidos").value.trim();
            
            const datos = { cedula, nombres, apellidos };
            
            try {
                const resp = await fetch("/gestion-docentes-web/docentes?accion=guardar", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(datos)
                });
                
                if (resp.ok) {
                    const data = await resp.json();
                    mostrarMensaje(data.success, data.mensaje);
                    if (data.success) {
                        setTimeout(() => window.location.href = '/gestion-docentes-web/docentes', 1500);
                    }
                } else {
                    mostrarMensaje(false, "Error al crear el docente");
                }
            } catch (error) {
                mostrarMensaje(false, error.message);
            }
        });
    }

    const formEditar = document.getElementById("formEditar");
    if (formEditar) {
        formEditar.addEventListener("submit", async function (e) {
            e.preventDefault();
            
            const id_docente = document.getElementById("docenteId").value;
            const cedula = document.getElementById("cedula").value.trim();
            const nombres = document.getElementById("nombres").value.trim();
            const apellidos = document.getElementById("apellidos").value.trim();
            const estado = document.getElementById("estado").value;
            
            const datos = { id_docente, cedula, nombres, apellidos, estado };
            
            try {
                const resp = await fetch("/gestion-docentes-web/docentes?accion=actualizar", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(datos)
                });
                
                if (resp.ok) {
                    const data = await resp.json();
                    mostrarMensaje(data.success, data.mensaje);
                    if (data.success) {
                        setTimeout(() => window.location.href = '/gestion-docentes-web/docentes', 1500);
                    }
                } else {
                    mostrarMensaje(false, "Error al actualizar el docente");
                }
            } catch (error) {
                mostrarMensaje(false, error.message);
            }
        });
    }
});

function mostrarMensaje(estado, mensaje) {
    const toastLiveExample = document.getElementById('liveToast')
    const contenido = document.getElementById('toastMessage')
    const icon_repuesta = document.getElementById('icono_respuesta');

    if (!toastLiveExample) return; // Si no hay toast en la página, no hace nada (ej. listado)

    if (estado) {
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

// Búsqueda en vivo para la tabla de docentes
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tablaDocentes');

    if (searchInput && tableBody) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            const rows = tableBody.querySelectorAll('tr');

            rows.forEach(row => {
                if (row.cells.length > 1) { // Ignorar la fila de "No hay docentes"
                    const cedula = row.cells[1].textContent.toLowerCase();
                    const nombres = row.cells[2].textContent.toLowerCase();
                    const apellidos = row.cells[3].textContent.toLowerCase();

                    if (cedula.includes(searchTerm) || nombres.includes(searchTerm) || apellidos.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        });
    }
});

