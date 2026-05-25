// js/login.js

document.addEventListener('DOMContentLoaded', () => {
    const formLogin = document.getElementById('formLogin');
    if (!formLogin) return;

    formLogin.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const cedula = document.getElementById('cedula').value;
        const password = document.getElementById('password').value;
        const alertaError = document.getElementById('alertaError');
        
        // Ahora buscamos en 'usuarios' en lugar de 'docentes'
        const usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];
        const usuario = usuarios.find(u => u.cedula === cedula && u.password === password);
        
        if (usuario) {
            // Guardamos el ID y el Rol en la sesión
            sessionStorage.setItem('usuarioLogueadoId', usuario.id);
            sessionStorage.setItem('usuarioRol', usuario.rol);
            
            // Redirección basada en el rol
            if (usuario.rol === 'admin') {
                window.location.href = 'admin_dashboard.html';
            } else {
                window.location.href = 'dashboard.html';
            }
        } else {
            alertaError.classList.remove('d-none');
        }
    });
});