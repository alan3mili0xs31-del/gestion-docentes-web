document.addEventListener('DOMContentLoaded', () => {
    const formLogin = document.getElementById('formLogin');
    if (!formLogin) return;

    formLogin.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const cedula = document.getElementById('cedula').value;
        const password = document.getElementById('password').value;
        const alertaError = document.getElementById('alertaError');
        
        const docentes = JSON.parse(localStorage.getItem('docentes')) || [];
        const docente = {id: 1}// docentes.find(d => d.cedula === cedula && d.password === password);
        
        if (docente) {
            sessionStorage.setItem('docenteLogueadoId', docente.id);
            window.location.href = '../html/home.html';
        } else {
            alertaError.classList.remove('d-none');
        }
    });
});