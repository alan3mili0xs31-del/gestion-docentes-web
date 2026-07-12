const editar = document.getElementById("editar-curso");
const guardar = document.getElementById("guardar-curso");

const id_curso = document.getElementById("id_curso");
const nombre = document.getElementById("nombre");
const descripcion = document.getElementById("descripcion");
const id_docente = document.getElementById("id_docente");
const id_asignatura = document.getElementById("id_asignatura");
const estado = document.getElementById("estado");


function main() {
    guardar.hidden = true;

    id_curso.readOnly = true;
    nombre.readOnly = true;
    descripcion.readOnly = true;
    id_docente.disabled = true;
    id_asignatura.disabled = true;
    estado.disabled = true;

    editar.addEventListener("click", tongleReadonly);
    guardar.addEventListener("click", guardarCurso);
}

main();


async function guardarCurso (ev) {
    ev.preventDefault();
    const datos = {
        id_curso: id_curso.value,
        nombre: nombre.value,
        descripcion: descripcion.value,
        id_docente: id_docente.value,
        id_asignatura: id_asignatura.value,
        estado: estado.value
    };

    try {
        const resp = await fetch("/gestion-docentes-web/cursos?accion=actualizar", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(datos)
        });

        if (!resp.ok) {
            throw new Error("Error al guardar el curso");
        }

        const data = await resp.json();

        mostrarMensaje(data.success, data.mensaje);
    }
    catch (error) {
        console.error("Error:", error);
    }
}

function tongleReadonly(ev) {
    ev.preventDefault();
    editar.style.display = "none";

    guardar.hidden = false;
    guardar.classList.add("btn-save");

    id_curso.readOnly = false;
    nombre.readOnly = false;
    descripcion.readOnly = false;
    id_docente.disabled = false;
    id_asignatura.disabled = false;
    estado.disabled = false;
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
