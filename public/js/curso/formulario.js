
const formulario = document.getElementById("crearCurso_form");

function main() {
  const crearBtn = document.getElementById("crearCursoBtn");
  crearBtn.addEventListener("click", (evento) => {
    try {
      evento.preventDefault();
      const nuevoCurso = obtenerCursoDesdeFormulario();
      cursoRepo.agregarCurso(nuevoCurso);
      alert("¡Curso creado exitosamente!");
      formulario.reset();
    }
    catch(error) {
      alert(`Datos no validos: ${error.message}`);
    }
  });
}

main();

