document.addEventListener('DOMContentLoaded', () => {

    const formCrear = document.getElementById("formCrearActividad");
    if (formCrear) {
        formCrear.addEventListener("submit", async function (e) {
            e.preventDefault();

            const datos = {
                id_curso: document.getElementById("id_curso").value,
                titulo: document.getElementById("titulo").value.trim(),
                descripcion: document.getElementById("descripcion").value.trim(),
                categoria: document.getElementById("categoria").value,
                fecha_apertura: document.getElementById("fecha_apertura").value,
                fecha_cierre: document.getElementById("fecha_cierre").value
            };

            try {
                const resp = await fetch("/gestion-docentes-web/actividades-docente?accion=guardar", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(datos)
                });

                if (resp.ok) {
                    const data = await resp.json();
                    mostrarMensaje(data.success, data.mensaje);

                    if (data.success) {
                        setTimeout(() => {
                            window.location.href = "/gestion-docentes-web/actividades-docente";
                        }, 1500);
                    }
                } else {
                    mostrarMensaje(false, "Error al crear la actividad.");
                }

            } catch (error) {
                mostrarMensaje(false, error.message);
            }
        });
    }

    const formEditar = document.getElementById("formEditarActividad");
    if (formEditar) {
        formEditar.addEventListener("submit", async function (e) {
            e.preventDefault();

            const datos = {
                id_actividad: document.getElementById("actividadId").value,
                id_curso: document.getElementById("id_curso").value,
                titulo: document.getElementById("titulo").value.trim(),
                descripcion: document.getElementById("descripcion").value.trim(),
                categoria: document.getElementById("categoria").value,
                fecha_apertura: document.getElementById("fecha_apertura").value,
                fecha_cierre: document.getElementById("fecha_cierre").value
            };

            try {
                const resp = await fetch("/gestion-docentes-web/actividades-docente?accion=actualizar", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(datos)
                });

                if (resp.ok) {
                    const data = await resp.json();
                    mostrarMensaje(data.success, data.mensaje);

                    if (data.success) {
                        setTimeout(() => {
                            window.location.href = "/gestion-docentes-web/actividades-docente";
                        }, 1500);
                    }
                } else {
                    mostrarMensaje(false, "Error al actualizar la actividad.");
                }

            } catch (error) {
                mostrarMensaje(false, error.message);
            }
        });
    }

    // Búsqueda en vivo
    const searchInput = document.getElementById("searchInput");
    const tableBody = document.getElementById("tablaActividades");

    if (searchInput && tableBody) {
        searchInput.addEventListener("input", function () {
            const searchTerm = this.value.toLowerCase().trim();
            const rows = tableBody.querySelectorAll("tr");

            rows.forEach(row => {
                if (row.cells.length > 1) {

                    const textoFila = Array.from(row.cells)
                        .map(td => td.textContent.toLowerCase())
                        .join(" ");

                    row.style.display = textoFila.includes(searchTerm) ? "" : "none";
                }
            });
        });
    }

});

function mostrarMensaje(estado, mensaje) {

    const toastLiveExample = document.getElementById("liveToast");
    const contenido = document.getElementById("toastMessage");
    const icon_repuesta = document.getElementById("icono_respuesta");

    if (!toastLiveExample) return;

    if (estado) {
        icon_repuesta.innerHTML = `
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="9 12 12 15 16 9"></polyline>
            </svg>`;
    } else {
        icon_repuesta.innerHTML = `
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>`;
    }

    contenido.innerText = mensaje;

    if (typeof bootstrap !== "undefined") {
        bootstrap.Toast.getOrCreateInstance(toastLiveExample).show();
    } else {
        alert(mensaje);
    }
}
