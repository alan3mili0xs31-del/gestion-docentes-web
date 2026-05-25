// js/crear-docente.js

document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('formCrear');
  
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const cedula = document.getElementById('cedula').value.trim();
      const nombres = document.getElementById('nombres').value.trim();
      const apellidos = document.getElementById('apellidos').value.trim();

      if (!cedula || !nombres || !apellidos) {
        alert('❌ Por favor completa todos los campos');
        return;
      }

      let docentes = JSON.parse(localStorage.getItem('docentes')) || [];
      
      const nuevoId = docentes.length > 0 ? Math.max(...docentes.map(d => d.id)) + 1 : 1;

      const nuevoDocente = {
        id: nuevoId,
        cedula: cedula,
        nombres: nombres,
        apellidos: apellidos
      };

      docentes.push(nuevoDocente);
      localStorage.setItem('docentes', JSON.stringify(docentes));

      alert('Docente creado exitosamente');
      window.location.href = 'listado-docentes.html';
    });
  }
});