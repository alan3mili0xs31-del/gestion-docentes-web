<?php

require_once 'app/modelos/LoginModelo.php';

class LoginControlador {
    private LoginModelo $loginModelo;

    public function __construct() {
        $this->loginModelo = new LoginModelo();
    }

    public function login()
    {

        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $cedula = $_POST["cedula"] ?? '';
            $clave = $_POST["clave"] ?? '';

            $usuario = $this->loginModelo->autenticar($cedula, $clave);

            if ($usuario) {
              session_start();
              $_SESSION["usuario"] = $usuario;


              header("Location: /gestion-docentes-web/inicio");
              exit();
            }
            else {
              $error = "Credenciales incorrectas";
              $this->mostrarFormulario($error);
            }
          }
          else {
            $this->mostrarFormulario();
          }
    }

    public function logout()
    {
        session_start();
        $_SESSION["usuario"] = '';
        session_unset();
        session_destroy();
        $this->mostrarFormulario();
    }

    public function mostrarFormulario(string $error = '') {
        require_once __DIR__."/../vistas/login.php";
    }
}
