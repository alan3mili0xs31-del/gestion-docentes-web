<?php

require_once __DIR__."/Usuario.php";

class LoginModelo {
  private Usuario $usuarioModelo;

  public function __construct() {
    $this->usuarioModelo = new Usuario();
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
      "cedula" => $usuario["cedula"]
    ];
  }

}
