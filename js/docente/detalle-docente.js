// js/detalle-docente.js

document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const id = parseInt(urlParams.get('id'));
  
  if (!id) {
    alert("ID de docente no válido");
    window.location.href = 'listado-docentes.html';
    return;
  }

  let docentes = JSON.parse(localStorage.getItem('docentes')) || [];
  const docente = docentes.find(d => d.id === id);

  if (docente) {
    document.getElementById('cedula').value = docente.cedula || '';
    document.getElementById('nombres').value = docente.nombres || '';
    document.getElementById('apellidos').value = docente.apellidos || '';
  
    const btnEditar = document.getElementById('btnEditar');
    btnEditar.href = `editar-docente.html?id=${id}`;

  } else {
    alert("Docente no encontrado");
    window.location.href = 'listado-docentes.html';
  }
});