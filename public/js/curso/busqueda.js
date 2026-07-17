function main() {
    const buscador = document.getElementById("cursoBuscador");
    console.log(buscador);

    buscador.addEventListener("keyup", async (ev) => {
        const busqueda_arg = buscador.value.trim();console.log(busqueda_arg);
        if (busqueda_arg.length > 0) {

            const resp = await fetch(`/gestion-docentes-web/cursos?accion=filtrar_nombre&nombre=${busqueda_arg}`);

            const datos = await resp.json();

            cargarTablaCursos(datos);

        }
    });
}

main();

function cargarTablaCursos(cursos) {
    const tabla = document.getElementById("tablaCursos");

    if (!cursos || cursos.length === 0) {
        tabla.innerHTML = `
            <tr>
                <td colspan="7" style="text-align: center; padding: 2rem; color: var(--text-gray);">
                    No hay cursos registrados.
                </td>
            </tr>
        `;
        return;
    }

    tabla.innerHTML = "";

    cursos.forEach(curso => {

        const estado = curso.estado === "activo"
            ? `<span style="background: #e8f5e9; color: #2e7d32; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: 600;">Activo</span>`
            : `<span style="background: #ffebee; color: #c62828; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: 600;">Inactivo</span>`;

        tabla.innerHTML += `
            <tr style="background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: transform 0.2s;">

                <td style="padding: 1rem; border-radius: 8px 0 0 8px;">
                    ${curso.id_curso}
                </td>

                <td style="padding: 1rem; font-weight: 600; color: var(--c-primary-main);">
                    ${curso.nombre}
                </td>

                <td style="padding: 1rem;">
                    ${curso.paralelo}
                </td>

                <td style="padding: 1rem;">
                    ${curso.docente}
                </td>

                <td style="padding: 1rem;">
                    ${curso.asignatura}
                </td>

                <td style="padding: 1rem;">
                    ${estado}
                </td>

                <td style="padding: 1rem; border-radius: 0 8px 8px 0;">
                    <div style="display: flex; gap: 0.5rem;">

                        <a href="?accion=buscar&id_curso=${curso.id_curso}"
                           class="btn-outline"
                           style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">
                            Detalle
                        </a>

                        <a href="?accion=eliminar&id_curso=${curso.id_curso}"
                           class="btn-red"
                           style="padding: 0.4rem 0.8rem; font-size: 0.85rem;"
                           onclick="return confirm('¿Está seguro de eliminar este curso?');">
                            Eliminar
                        </a>

                    </div>
                </td>

            </tr>
        `;
    });
}
