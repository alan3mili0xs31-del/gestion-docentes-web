<?php

require_once __DIR__.'/../modelos/UsuarioModelo.php';

class PerfilControlador {
    private UsuarioModelo $usuarioModelo;

    public function __construct() {
        $this->usuarioModelo = new UsuarioModelo();
    }

    public function mostrarPerfil() {
        require_once __DIR__."/../vistas/perfil.php";
    }

    public function actualizar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            # session_start();
            $id_usuario = $_SESSION["usuario"]["usuario_id"];

            $nombre = $_POST["nombre"] ?? "";
            $correo = $_POST["correo"] ?? "";
            $telefono = $_POST["telefono"] ?? "";
            $clave_nueva = $_POST["clave_nueva"] ?? "";
            $clave_confirmar = $_POST["clave_confirmar"] ?? "";

            $clave = null;
            if (!empty($clave_nueva) && $clave_nueva === $clave_confirmar) {
                $clave = $clave_nueva;
            } else if (!empty($clave_nueva) && $clave_nueva !== $clave_confirmar) {
                $error = "Las contraseñas no coinciden.";
                require_once __DIR__."/../vistas/perfil.php";
                return;
            }

            $exito = $this->usuarioModelo->actualizarPerfil($id_usuario, $nombre, $correo, $telefono, $clave);

            if ($exito) {
                // Actualizar sesion
                $_SESSION["usuario"]["nombre"] = $nombre;
                $_SESSION["usuario"]["correo"] = $correo;
                $_SESSION["usuario"]["telefono"] = $telefono;

                $mensaje = "Perfil actualizado correctamente.";
            } else {
                $error = "Ocurrió un error al actualizar el perfil.";
            }

            require_once __DIR__."/../vistas/perfil.php";
        }
    }
}
