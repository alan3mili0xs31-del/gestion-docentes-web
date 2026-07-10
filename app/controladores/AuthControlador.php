<?php

require_once '../app/modelos/Usuario.php';

class AuthControlador
{
    public function login()
    {
        // TODO:
        // Mostrar el formulario de inicio de sesiÃ³n.
    }

    public function autenticar()
    {
        // TODO:
        // 1. Recibir usuario y contraseÃ±a.
        // 2. Validar las credenciales mediante el modelo Usuario.
        // 3. Crear la sesiÃ³n del usuario.
        // 4. Redirigir al menÃº principal o mostrar un mensaje de error.
    }

    public function cerrarSesion()
    {
        // TODO:
        // 1. Destruir la sesiÃ³n.
        // 2. Redirigir al formulario de inicio de sesiÃ³n.
    }
}
