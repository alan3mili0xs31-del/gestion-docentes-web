// js/listado-docentes.js

function cargarDocentes() {
  const guardados = localStorage.getItem('docentes');
  if (guardados) {
    return JSON.parse(guardados);
  }
  
  const iniciales = [
    { id: 1, cedula: "1712345678", nombres: "Juan Carlos", apellidos: "Pérez López" },
    { id: 2, cedula: "1756789012", nombres: "María Elena", apellidos: "González Ruiz" },
    { id: 3, cedula: "1709876543", nombres: "Carlos Andrés", apellidos: "Mendoza Torres" },
  ];
  localStorage.setItem('docentes', JSON.stringify(iniciales));
  return iniciales;
}

let docentes = cargarDocentes();

function guardarDocentes() {
  localStorage.setItem('docentes', JSON.stringify(docentes));
}

function renderTabla(data = docentes) {
  const tbody = document.getElementById('tablaDocentes');
  if (!tbody) return;
  
  tbody.innerHTML = '';

  data.forEach(doc => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${doc.id}</td>
      <td>${doc.cedula}</td>
      <td>${doc.nombres}</td>
      <td>${doc.apellidos}</td>
      <td class="text-center">
        <a href="detalle-docente.html?id=${doc.id}" class="text-blue-600 hover:text-blue-800 mx-2 text-xl">
          <i class="fas fa-eye"></i>
        </a>
        <a href="editar-docente.html?id=${doc.id}" class="text-amber-600 hover:text-amber-800 mx-2 text-xl">
          <i class="fas fa-edit"></i>
        </a>
        <button onclick="eliminarDocente(${doc.id})" class="text-red-600 hover:text-red-800 mx-2 text-xl">
          <i class="fas fa-trash"></i>
        </button>
      </td>
    `;
    tbody.appendChild(tr);
  });
}

function filtrarDocentes() {
  const term = document.getElementById('searchInput').value.toLowerCase().trim();
  const filtrados = docentes.filter(doc => 
    doc.cedula.toLowerCase().includes(term) || 
    doc.nombres.toLowerCase().includes(term) || 
    doc.apellidos.toLowerCase().includes(term)
  );
  renderTabla(filtrados);
}

function eliminarDocente(id) {
  if (confirm('¿Estás seguro de eliminar este docente?')) {
    docentes = docentes.filter(d => d.id !== id);
    guardarDocentes();
    renderTabla();
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('searchInput');
  if (searchInput) searchInput.addEventListener('keyup', filtrarDocentes);
  renderTabla();
});