document.addEventListener('DOMContentLoaded', () => {
    
    
    const formEditarPerfil = document.getElementById('formEditarPerfil');

    if (formEditarPerfil) {
        formEditarPerfil.addEventListener('submit', function(event) {
            event.preventDefault(); 
            
           
            alert("¡Tu perfil ha sido actualizado correctamente!");
            
            
            window.location.href = '../actividades/listado.html';
        });
    }
});