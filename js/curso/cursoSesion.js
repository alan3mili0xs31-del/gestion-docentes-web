class CursoSesion {
  obtenerId() {
    return JSON.parse(localStorage.getItem("idCursoSesion") ?? '1');
  }

  actualizarId(idCurso) {
    localStorage.setItem("idCursoSesion", JSON.parse(idCurso));
  }
}

const cursoSesion = new CursoSesion();

export default cursoSesion;