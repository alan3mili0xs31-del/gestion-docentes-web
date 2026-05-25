// js/editar-docente.js

document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const id = parseInt(urlParams.get('id'));
  
  let docentes = JSON.parse(localStorage.getItem('docentes')) || [];
  const docente = docentes.find(d => d.id === id);

  if (docente) {
    document.getElementById('cedula').value = docente.cedula;
    document.getElementById('nombres').value = docente.nombres;
    document.getElementById('apellidos').value = docente.apellidos;
  } else {
    alert("Docente no encontrado");
    window.location.href = 'listado-docentes.html';
  }

  const form = document.getElementById('formEditar');
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();

      const nombres = document.getElementById('nombres').value.trim();
      const apellidos = document.getElementById('apellidos').value.trim();

      if (!nombres || !apellidos) {
        alert('❌ Completa los campos');
        return;
      }

      // Actualizar
      const index = docentes.findIndex(d => d.id === id);
      if (index !== -1) {
        docentes[index].nombres = nombres;
        docentes[index].apellidos = apellidos;
        localStorage.setItem('docentes', JSON.stringify(docentes));
        
        alert('Docente actualizado correctamente');
        window.location.href = 'listado-docentes.html';
      }
    });
  }
});