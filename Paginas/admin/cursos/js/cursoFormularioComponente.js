import cursoRepo from "./cursoRepo.js";
import cursoSesion from "./cursoSesion.js";

function obtenerHorario() {
  // checkbox de horario
  const lunes = document.getElementById("lunesCheck");
  const martes = document.getElementById("martesCheck");
  const miercoles = document.getElementById("miercolesCheck");
  const jueves = document.getElementById("juevesCheck");
  const viernes = document.getElementById("viernesCheck");
  const sabado = document.getElementById("sabadoCheck");
  const domingo = document.getElementById("domingoCheck");
  const horarioCheck = [lunes, martes, miercoles, jueves, viernes, sabado, domingo];

  let horarioCurso = [];
  horarioCheck.forEach((dia) => {
    if (dia.checked) 
      horarioCurso.push(dia.value);
  });
  return horarioCurso;
}

export function obtenerCursoDesdeFormulario() {
  const docente = document.getElementById("docenteCursoInput");
  const nombre = document.getElementById("cursoNombreInput").value;
  const asignatura = document.getElementById("asignaturaCursoInput");
  const descripcion = document.getElementById("cursoDescripcionInput").value;
  const fechaInicio = document.getElementById("cursofechaInicioInput").value;
  const fechaFin = document.getElementById("cursofechaFinInput").value;
  let horario = obtenerHorario();

  // validar datos
  if (nombre.trim().length === 0) 
    throw new Error("No ha ingresado un nombre de curso válido.");  
  if (docente.selectedIndex < 1) 
    throw new Error("No ha seleccionado un docente.");  
  if (asignatura.selectedIndex < 1) 
    throw new Error("No ha seleccionado una asignatura."); 
  if (fechaInicio.trim().length === 0) 
    throw new Error("No ha ingresado una fecha de inicio de curso.");
  if (fechaFin.trim().length === 0) 
    throw new Error("No ha ingresado una fecha de finalización de curso.");
  if (Date.parse(fechaInicio) < Date.now()) 
    throw new Error("La fecha de inicio del curso no puede ser menor que la fecha actual.");
  if (Date.parse(fechaFin) <= Date.parse(fechaInicio)) 
    throw new Error("La fecha de finalizacion del curso no puede ser menor o igual que la fecha de inicio.");
  if (horario.length < 1) 
    throw new Error("Debe seleccionar por lo menos 1 día de horario de clases.");

  return {
    nombre,
    docente: docente.options[docente.selectedIndex].textContent,
    asignatura: asignatura.options[asignatura.selectedIndex].textContent,
    descripcion,
    fechaInicio,
    fechaFin,
    horario
  };
}

export function cargarDatosAlFormulario() {
  const curso = cursoRepo.obtenerCursoPorId(cursoSesion.obtenerId());

  const idCurso = document.getElementById("idCursoCargado");
  const docente = document.getElementById("docenteCursoInput");
  const asignatura = document.getElementById("asignaturaCursoInput");
  const nombre = document.getElementById("cursoNombreInput");
  const descripcion = document.getElementById("cursoDescripcionInput");
  const fechaInicio = document.getElementById("cursofechaInicioInput");
  const fechaFin = document.getElementById("cursofechaFinInput");

  idCurso.textContent = curso.id;
  nombre.value = curso.nombre;
  cargarAlSelect(docente, curso.docente);
  cargarAlSelect(asignatura, curso.asignatura);
  descripcion.value = curso.descripcion;
  fechaInicio.value = curso.fechaInicio;
  fechaFin.value = curso.fechaFin;
  cargarHorario(curso.horario);

  console.log(curso);
}

export function cargarHorario(horarioCurso) {
  // checkbox de horario
  const lunes = document.getElementById("lunesCheck");
  const martes = document.getElementById("martesCheck");
  const miercoles = document.getElementById("miercolesCheck");
  const jueves = document.getElementById("juevesCheck");
  const viernes = document.getElementById("viernesCheck");
  const sabado = document.getElementById("sabadoCheck");
  const domingo = document.getElementById("domingoCheck");
  const horarioCheck = [lunes, martes, miercoles, jueves, viernes, sabado, domingo];

  horarioCheck.forEach((dia) => {
    if (horarioCurso.includes(dia.value)) {
      dia.checked = true;
    }   
  });
}

export function cargarAlSelect(select, nombre) {
  for(let opcion of select.children) {
    if(opcion.textContent === nombre) {
      select.selectedIndex = opcion.value;
      break;
    }
  }
}