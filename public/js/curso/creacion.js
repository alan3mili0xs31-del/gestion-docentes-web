function main() {
    console.log("Hello");
    crearCurso();
}

main();

async function crearCurso() {
    const formulario = document.getElementById("crearCurso_form");
    formulario.addEventListener("submit", async function (e) {
        e.preventDefault();

        const nombre = document.getElementById("cursoNombreInput").value.trim();
        const id_docente = document.getElementById("docenteCursoInput").value;
        const id_asignatura = document.getElementById("asignaturaCursoInput").value;
        const descripcion = document.getElementById("cursoDescripcionInput").value.trim();
        const paralelo = document.getElementById("cursoParaleloInput").value.trim();
        const horaInicio = document.getElementById("cursoHoraInicioInput").value;
        const horaFin = document.getElementById("cursoHoraFinInput").value;

        // Días seleccionados
        const diasSeleccionados = [];

        const diasMap = {
            lunesCheck: "Lun.",
            martesCheck: "Mar.",
            miercolesCheck: "Mie.",
            juevesCheck: "Jue.",
            viernesCheck: "Vie.",
            sabadoCheck: "Sab.",
            domingoCheck: "Dom."
        };

        for (const id in diasMap) {
            if (document.getElementById(id).checked) {
                diasSeleccionados.push(diasMap[id]);
            }
        }


        // Validar cantidad de días
        if (diasSeleccionados.length === 0) {
            alert("Debe seleccionar al menos un día.");
            return;
        }

        if (diasSeleccionados.length > 2) {
            alert("Solo puede seleccionar un máximo de dos días.");
            return;
        }

        // Validar horas
        if (!horaInicio || !horaFin) {
            alert("Debe seleccionar la hora de inicio y la hora de fin.");
            return;
        }

        // Validar que la hora de inicio sea menor
        if (horaInicio >= horaFin) {
            alert("La hora de inicio debe ser menor que la hora de fin.");
            return;
        }

        // Calcular diferencia en minutos
        const [hInicio, mInicio] = horaInicio.split(":").map(Number);
        const [hFin, mFin] = horaFin.split(":").map(Number);

        const minutosInicio = hInicio * 60 + mInicio;
        const minutosFin = hFin * 60 + mFin;

        const diferencia = minutosFin - minutosInicio;

        // Máximo 2 horas
        if (diferencia > 120) {
            alert("La duración del curso no puede ser mayor a 2 horas.");
            return;
        }

        // Ej: "Mie. & Sab. 11:00 - 12:00"
        const horario = diasSeleccionados.join(" & ") + " " + horaInicio + " - " + horaFin;

        const datos = {
            nombre,
            id_docente,
            id_asignatura,
            descripcion,
            horario,
            paralelo
        };

        try {
            const resp = await fetch("/gestion-docentes-web/cursos?accion=guardar", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(datos)
            });

            if (resp.ok) {
                const data = await resp.json();
                mostrarMensaje(data.success, data.mensaje);
            } else {
                mostrarMensaje(false, "Error al crear el curso");
            }

        } catch (error) {
            console.log(error);
            mostrarMensaje(false, error.message);
        }
        formulario.reset();
    });
}

function mostrarMensaje(estado, mensaje) {
    const toastLiveExample = document.getElementById('liveToast')
    const contenido = document.querySelector('.toast-body')
    const icon_repuesta = document.getElementById('icono_respuesta');

    if (estado) {
        icon_repuesta.innerHTML = `<svg id="success_icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="9 12 12 15 16 9"></polyline>
        </svg>`;
    }
    else {
        icon_repuesta.innerHTML = `<svg id="error_icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>`;
    }

    contenido.innerText = mensaje
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
    toastBootstrap.show()
}
