<?php

require_once '../app/models/Usuario.php';

class AuthController
{
    public function login()
    {
        // TODO:
        // Mostrar el formulario de inicio de sesión.
    }

    public function autenticar()
    {
        // TODO:
        // 1. Recibir usuario y contraseña.
        // 2. Validar las credenciales mediante el modelo Usuario.
        // 3. Crear la sesión del usuario.
        // 4. Redirigir al menú principal o mostrar un mensaje de error.
    }

    public function cerrarSesion()
    {
        // TODO:
        // 1. Destruir la sesión.
        // 2. Redirigir al formulario de inicio de sesión.
    }
}