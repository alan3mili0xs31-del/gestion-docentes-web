<?php

require_once __DIR__."/UsuarioModelo.php";

class LoginModelo {
  private UsuarioModelo $usuarioModelo;

  public function __construct() {
    $this->usuarioModelo = new UsuarioModelo();
  }

  public function autenticar(string $cedula, string $clave) {
    $usuario = $this->usuarioModelo->buscarPorCedula($cedula);
    if ($usuario == null) {
      return null;
    }

    if (strcmp($usuario["clave"], $clave) !== 0) {
      return null;
    }

    return [
      "usuario_id" => $usuario["id_usuario"],
      "cedula" => $usuario["cedula"],
      "rol" => $usuario["rol"]
    ];
  }

}
