<?php

require_once 'config/Conexion.php';

class UsuarioModelo
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }


    public function buscarPorCedula($cedula)
    {
        $sql = 'SELECT id_usuario, cedula, clave, rol, nombre, correo, telefono
            FROM usuarios
            WHERE cedula = :cedula';
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            "cedula" => $cedula
        ]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario;
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


    public function actualizarPerfil($id_usuario, $nombre, $correo, $telefono, $clave = null)
    {
        try {
            if ($clave) {
                $sql = "UPDATE usuarios SET nombre = :nombre, correo = :correo, telefono = :telefono, clave = :clave WHERE id_usuario = :id_usuario";
                $stmt = $this->conexion->prepare($sql);
                $stmt->execute([
                    "nombre" => $nombre,
                    "correo" => $correo,
                    "telefono" => $telefono,
                    "clave" => $clave,
                    "id_usuario" => $id_usuario
                ]);
            } else {
                $sql = "UPDATE usuarios SET nombre = :nombre, correo = :correo, telefono = :telefono WHERE id_usuario = :id_usuario";
                $stmt = $this->conexion->prepare($sql);
                $stmt->execute([
                    "nombre" => $nombre,
                    "correo" => $correo,
                    "telefono" => $telefono,
                    "id_usuario" => $id_usuario
                ]);
            }
            return true;
        } catch (PDOException $e) {
            error_log("Error actualizando perfil: " . $e->getMessage());
            return false;
        }
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
