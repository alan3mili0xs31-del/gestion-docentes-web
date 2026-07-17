document.addEventListener('DOMContentLoaded', () => {

    const formCrear = document.getElementById("formCrearAsignatura");
    if (formCrear) {
        formCrear.addEventListener("submit", async function (e) {
            e.preventDefault();

            const codigo = document.getElementById("codigo").value.trim();
            const nombre = document.getElementById("nombre").value.trim();
            const semestre = document.getElementById("semestre").value;
            const creditos = parseInt(document.getElementById("creditos").value, 10);

            if (!codigo || !nombre || !semestre || isNaN(creditos) || creditos <= 0) {
                mostrarMensaje(false, "Todos los campos son obligatorios.");
                return;
            }

            const datos = {
                codigo,
                nombre,
                semestre,
                creditos
            };

            try {
                const resp = await fetch("/gestion-docentes-web/asignaturas?accion=guardar", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(datos)
                });

                if (resp.ok) {
                    const data = await resp.json();
                    mostrarMensaje(data.success, data.mensaje);

                    if (data.success) {
                        setTimeout(() => {
                            window.location.href = "/gestion-docentes-web/asignaturas";
                        }, 1500);
                    }
                } else {
                    mostrarMensaje(false, "Error al crear la asignatura.");
                }
            } catch (error) {
                mostrarMensaje(false, error.message);
            }
        });
    }

    const formEditar = document.getElementById("formEditarAsignatura");
    if (formEditar) {
        formEditar.addEventListener("submit", async function (e) {
            e.preventDefault();

            const id_asignatura = document.getElementById("asignaturaId").value;
            const codigo = document.getElementById("codigo").value.trim();
            const nombre = document.getElementById("nombre").value.trim();
            const semestre = document.getElementById("semestre").value;
            const creditos = parseInt(document.getElementById("creditos").value, 10);
            const estado = document.getElementById("estado").value;

            if (!codigo || !nombre || !semestre || isNaN(creditos) || creditos <= 0) {
                mostrarMensaje(false, "Todos los campos son obligatorios.");
                return;
            }

            const datos = {
                id_asignatura,
                codigo,
                nombre,
                semestre,
                creditos,
                estado
            };

            try {
                const resp = await fetch("/gestion-docentes-web/asignaturas?accion=actualizar", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(datos)
                });

                if (resp.ok) {
                    const data = await resp.json();
                    mostrarMensaje(data.success, data.mensaje);

                    if (data.success) {
                        setTimeout(() => {
                            window.location.href = "/gestion-docentes-web/asignaturas";
                        }, 1500);
                    }
                } else {
                    mostrarMensaje(false, "Error al actualizar la asignatura.");
                }
            } catch (error) {
                mostrarMensaje(false, error.message);
            }
        });
    }

    // Búsqueda en vivo para la tabla de asignaturas
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tablaAsignaturas');

    if (searchInput && tableBody) {
        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase().trim();
            const rows = tableBody.querySelectorAll('tr');

            rows.forEach(row => {
                if (row.cells.length > 1) {
                    const id = row.cells[0].textContent.toLowerCase();
                    const codigo = row.cells[1].textContent.toLowerCase();
                    const nombre = row.cells[2].textContent.toLowerCase();
                    const semestre = row.cells[3].textContent.toLowerCase();

                    if (
                        id.includes(searchTerm) ||
                        codigo.includes(searchTerm) ||
                        nombre.includes(searchTerm) ||
                        semestre.includes(searchTerm)
                    ) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        });
    }
});

function mostrarMensaje(estado, mensaje) {
    const toastLiveExample = document.getElementById('liveToast');
    const contenido = document.getElementById('toastMessage');
    const icon_repuesta = document.getElementById('icono_respuesta');

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

    if (typeof bootstrap !== 'undefined') {
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
        toastBootstrap.show();
    } else {
        alert(mensaje);
    }
}
