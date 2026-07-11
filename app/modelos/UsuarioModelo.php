<?php

require_once 'config/Conexion.php';

class Usuario
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }


    public function buscarPorCedula($cedula)
    {
        $sql = 'SELECT id_usuario, cedula, clave, rol
            FROM usuarios
            WHERE cedula = :cedula';
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            "cedula" => $cedula
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function listar()
    {
        // TODO:
        // Obtener todos los usuarios registrados.
        // Retornar un arreglo con los resultados.
    }


    public function guardar($datos)
    {
        // TODO:
        // Insertar un nuevo usuario en la base de datos.
    }


    public function actualizar($id, $datos)
    {
        // TODO:
        // Actualizar la información de un usuario existente.
    }


    public function eliminar($id)
    {
        // TODO:
        // Eliminar un usuario por su identificador.
    }
}
