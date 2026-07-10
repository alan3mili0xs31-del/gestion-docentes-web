
class CursoRepo {
  obtenerCursos() {
    let storage = localStorage.getItem("cursos_lista");
    let cursos = [];
    if (storage) 
      cursos = JSON.parse(storage);
    return cursos;
  }

  obtenerCursoPorId(idCurso) {
    let cursos = this.obtenerCursos();
    return cursos.find(curso => curso.id === idCurso);
  }

  filtrarCursos(parametro, valor) {
    let cursos = this.obtenerCursos();
    return cursos.filter(curso => curso[parametro.toLowerCase()].toLowerCase().includes(valor.toLowerCase()));
  }

  agregarCurso(curso) {
    let cursos = this.obtenerCursos();
    let nuevoId = this.#obtenerNuevoId();
    cursos.push({id: nuevoId, ...curso});
    localStorage.setItem("cursos_lista", JSON.stringify(cursos));
  }

  actualizarCurso(idCurso, cambios) {
    let cursos = this.obtenerCursos();
    cursos = cursos.map(curso => curso.id === idCurso ? {id: idCurso, ...cambios} : curso);
    localStorage.setItem("cursos_lista", JSON.stringify(cursos));
  }

  eliminarCurso(idCurso) {
    let cursos = this.obtenerCursos();
    cursos = cursos.filter(curso => curso.id !== idCurso);
    localStorage.setItem("cursos_lista", JSON.stringify(cursos));
  }

  #obtenerNuevoId() {
    let idActual = JSON.parse(localStorage.getItem("idCursoActual") ?? '1');
    localStorage.setItem("idCursoActual", JSON.stringify(idActual + 1));
    return idActual;
  }
}

const cursoRepo = new CursoRepo();

