function mainaa() {
  const lista = document.getElementById("lista-peliculas");
  lista.addEventListener("click", (e) => {
    const target = e.target;
    if (target.classList.contains("seleccionar")) {
      const fila = target.closest("tr");
      document.getElementById("id").value = fila.querySelector(".id").innerText;
      document.getElementById("title").value = fila.querySelector(".title").innerText;
      document.getElementById("genre").value = fila.querySelector(".genre").innerText;
      document.getElementById("release_year").value = fila.querySelector(".release_year").innerText;
    }
  });

  const editar = document.getElementById("editar-curso");
  const cancelar = document.getElementById("cancelar");
  const guardar = document.getElementById("guardar");
  const title = document.getElementById("title");
  const genre = document.getElementById("genre");
  const anio = document.getElementById("release_year");

  cancelar.addEventListener("click", tongleReadonly);
  editar.addEventListener("click", tongleReadonly);

  function tongleReadonly(ev) {
    ev.preventDefault();
    guardar.hidden = !guardar.hidden;
    cancelar.hidden = !cancelar.hidden;
    editar.hidden = !editar.hidden;

    genre.readOnly = !genre.readOnly;
    title.readOnly = !title.readOnly;
    anio.readOnly = !anio.readOnly;
  }
}

console.log("Hola");

function main() {
    const editar = document.getElementById("editar-curso");
    const guardar = document.getElementById("guardar-curso");
    console.log(guardar);
    guardar.hidden = true;

    const id_curso = document.getElementById("id_curso");
    const nombre = document.getElementById("nombre");
    const descripcion = document.getElementById("descripcion");
    const id_docente = document.getElementById("id_docente");
    const id_asignatura = document.getElementById("id_asignatura");
    const estado = document.getElementById("estado");

    editar.addEventListener("click", tongleReadonly);

    function tongleReadonly(ev) {
        ev.preventDefault();
        guardar.hidden = !guardar.hidden;
        editar.hidden = !editar.hidden;

        id_curso.readOnly = !id_curso.readOnly;
        nombre.readOnly = !nombre.readOnly;
        descripcion.readOnly = !descripcion.readOnly;
        id_docente.readOnly = !id_docente.readOnly;
        id_asignatura.readOnly = !id_asignatura.readOnly;
        estado.readOnly = !estado.readOnly;
    }
}

main();
