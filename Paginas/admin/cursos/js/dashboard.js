import cursoRepo from "./cursoRepo.js";
import cursoSesion from "./cursoSesion.js";

const tablaCursos = document.getElementById("tablaCursos");
  

function main () {
  try {
    let cursos = cursoRepo.obtenerCursos();
    crearTabla(cursos);
    configurarFiltros();
  }
  catch(error) {
    alert(`Error: ${error.message}`);
  }
}

function crearFila(curso) {
  const itemComponent = document.createElement("tr");
  itemComponent.innerHTML = `
    <td class="id-curso">${curso.id}</td>
    <td class="nombre-curso">${curso.nombre}</td>
    <td class="docente-curso">${curso.docente}</td>
    <td class="asignatura-curso">${curso.asignatura}</td>
    <td class="fechainicio-curso">${curso.fechaInicio}</td>
    <td class="fechafin-curso">${curso.fechaFin}</td>
    <td>
      <div class="btn-group" role="group" aria-label="Basic mixed styles example">
        <a href="./cursoDetallesView.html"><button type="button" class="btn btn-success detallesBtn"><i class="bi bi-info-circle"></i></button></a>
        <a href="./cursoEdicionView.html"><button type="button" class="btn btn-warning modificarBtn"><i class="bi bi-pencil-square" style="color:white"></i></button></a>
        <button type="button" class="btn btn-danger eliminarBtn"><i class="bi bi-trash3-fill eliminarBtn"></i></button>
      </div>
    </td>
  `;
  const idCursoSeleccionado = parseInt(itemComponent.querySelector(".id-curso").textContent);

  const detallesBtn = itemComponent.querySelector(".detallesBtn");
  detallesBtn.addEventListener("click", () => {
    cursoSesion.actualizarId(idCursoSeleccionado);
  });

  const modificarBtn = itemComponent.querySelector(".modificarBtn");
  modificarBtn.addEventListener("click", () => {
    cursoSesion.actualizarId(idCursoSeleccionado);
  });

  const eliminarBtn = itemComponent.querySelector(".eliminarBtn");
  eliminarBtn.addEventListener('click', (event) => {
    cursoRepo.eliminarCurso(idCursoSeleccionado);
    itemComponent.remove();
  });

  return itemComponent;
}

function crearTabla(listaCursos) {
  const cursos = document.createDocumentFragment();
  listaCursos.forEach(curso => cursos.append(crearFila(curso)));
  tablaCursos.innerHTML = "";
  tablaCursos.append(cursos);
}

function configurarFiltros() {

  const filtrarBtn = document.getElementById("filtrarCursosBtn");
  filtrarBtn.addEventListener("click", () => {
    try {
      const filtroTxt = document.getElementById("filtroCursoInput").value;
      if (filtroTxt.trim().length === 0) 
        throw new Error("No ha ingresado ningun valor para filtrar.");
      let cursos = cursoRepo.filtrarCursos("nombre", filtroTxt);
      crearTabla(cursos);
    }
    catch(error) {
      alert(`Error: ${error.message}`);
    }
  });

  const resetearBtn = document.getElementById("resetearFiltrosBtn");
  resetearBtn.addEventListener("click", () => {
    let cursos = cursoRepo.obtenerCursos();
    crearTabla(cursos);
  });

}

main();