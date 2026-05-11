function main() {
  const formulario = document.getElementById('formulario');
  const tabla = document.getElementById('tablaSolicitudes');
  const contador = document.getElementById('contador');

  formulario.addEventListener('submit', function(event) {
    event.preventDefault();

    const cedula = document.getElementById('cedula').value;
    const nombre = document.getElementById('nombre').value;
    const apellido = document.getElementById('apellido').value;
    const fechaInicio = document.getElementById('fechaInicio').value;
    const fechaFin = document.getElementById('fechaFin').value;

    const fila = document.createElement('tr');
    fila.innerHTML = `
      <td>${cedula}</td>
      <td>${nombre}</td>
      <td>${apellido}</td>
      <td>${fechaInicio}</td>
      <td>${fechaFin}</td>
      <td><button class="btn btn-sm btn-danger eliminar">Eliminar</button></td>
    `;

    tabla.appendChild(fila);

    actualizarContador();
    formulario.reset();
  });

  tabla.addEventListener('click', function(event) {
    if (event.target.classList.contains('eliminar')) {
      event.target.closest('tr').remove();
      actualizarContador();
    }
  });

  function actualizarContador() {
    contador.textContent = tabla.querySelectorAll('tr').length;
  }
}

main();