
import cursoRepo from "./cursoRepo.js";
import { obtenerCursoDesdeFormulario } from "./cursoFormularioComponente.js";
import { cargarDatosAlFormulario } from "./cursoFormularioComponente.js";

//@ts-check
function main() {
  cargarDatosAlFormulario();
  const guardarCambiosBtn = document.getElementById("guardarCambios");
  const idCurso = document.getElementById("idCursoCargado");
  guardarCambiosBtn.addEventListener("click", (evento) => {
    try {
      evento.preventDefault();
      const cursoActualizado = obtenerCursoDesdeFormulario();
      cursoRepo.actualizarCurso(parseInt(idCurso.textContent), cursoActualizado);
      alert("¡Curso actualizado exitosamente!");
    }
    catch(error) {
      alert(`Datos no validos: ${error.message}`);
    }
  });
}

main();