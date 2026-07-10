
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