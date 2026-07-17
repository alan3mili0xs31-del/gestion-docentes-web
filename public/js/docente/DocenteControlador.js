document.addEventListener('DOMContentLoaded', () => {

    // ===========================
    // CREAR DOCENTE
    // ===========================
    const formCrear = document.getElementById("formCrear");
    if (formCrear) {
        formCrear.addEventListener("submit", async function (e) {
            e.preventDefault();

            const cedula = document.getElementById("cedula").value.trim();
            const primer_nombre = document.getElementById("primer_nombre").value.trim();
            const segundo_nombre = document.getElementById("segundo_nombre").value.trim();
            const primer_apellido = document.getElementById("primer_apellido").value.trim();
            const segundo_apellido = document.getElementById("segundo_apellido").value.trim();
            const especialidad = document.getElementById("especialidad").value.trim();

            const datos = {
                cedula,
                primer_nombre,
                segundo_nombre,
                primer_apellido,
                segundo_apellido,
                especialidad
            };

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
                        setTimeout(() => {
                            window.location.href = "/gestion-docentes-web/docentes";
                        }, 1500);
                    }
                } else {
                    mostrarMensaje(false, "Error al crear el docente");
                }

            } catch (error) {
                mostrarMensaje(false, error.message);
            }
        });
    }

    // ===========================
    // EDITAR DOCENTE
    // ===========================
    const formEditar = document.getElementById("formEditar");
    if (formEditar) {
        formEditar.addEventListener("submit", async function (e) {
            e.preventDefault();

            const id_docente = document.getElementById("docenteId").value;
            const cedula = document.getElementById("cedula").value.trim();
            const primer_nombre = document.getElementById("primer_nombre").value.trim();
            const segundo_nombre = document.getElementById("segundo_nombre").value.trim();
            const primer_apellido = document.getElementById("primer_apellido").value.trim();
            const segundo_apellido = document.getElementById("segundo_apellido").value.trim();
            const especialidad = document.getElementById("especialidad").value;
            const estado = document.getElementById("estado").value;

            const datos = {
                id_docente,
                cedula,
                primer_nombre,
                segundo_nombre,
                primer_apellido,
                segundo_apellido,
                especialidad,
                estado
            };
            console.log(datos);
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
                        setTimeout(() => {
                            window.location.href = "/gestion-docentes-web/docentes";
                        }, 1500);
                    }
                } else {
                    mostrarMensaje(false, "Error al actualizar el docente");
                }

            } catch (error) {
                mostrarMensaje(false, error.message);
            }
        });
    }

    // ===========================
    // BÚSQUEDA EN VIVO
    // ===========================
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tablaDocentes');

    if (searchInput && tableBody) {
        searchInput.addEventListener('input', function () {

            const searchTerm = this.value.toLowerCase().trim();
            const rows = tableBody.querySelectorAll('tr');

            rows.forEach(row => {

                if (row.cells.length > 1) {

                    // Ajusta los índices según el orden de tus columnas
                    const cedula = row.cells[1].textContent.toLowerCase();
                    const nombres = row.cells[2].textContent.toLowerCase();
                    const apellidos = row.cells[3].textContent.toLowerCase();
                    const especialidad = row.cells[4].textContent.toLowerCase();

                    if (
                        cedula.includes(searchTerm) ||
                        nombres.includes(searchTerm) ||
                        apellidos.includes(searchTerm) ||
                        especialidad.includes(searchTerm)
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
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="#198754" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="9 12 12 15 16 9"></polyline>
            </svg>`;
    } else {
        icon_repuesta.innerHTML = `
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="#dc3545" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
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
