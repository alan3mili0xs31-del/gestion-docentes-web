<?php

require_once 'config/Conexion.php';

class CursoModelo
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }


    public function listar(?int $id_docente = null)
    {
        // TODO:
        // Obtener todos los cursos registrados.
        $sql = '';
        $stmt = '';
        if (!$id_docente) {
          $sql = 'SELECT `id_curso`, `id_docente`, `id_asignatura`, `nombre`, `descripcion`, `paralelo`, `horario`, `cantidad_alumnos`, `fecha_creacion`, `fecha_modificacion`, `estado`
              FROM `cursos`
              WHERE 1
              ORDER BY id_curso';
          $stmt = $this->conexion->query($sql);
        }
        else {
          $sql = 'SELECT `id_curso`, `id_docente`, `id_asignatura`, `nombre`, `descripcion`, `paralelo`, `horario`, `cantidad_alumnos`, `fecha_creacion`, `fecha_modificacion`, `estado`
              FROM `cursos`
              WHERE id_docente = :id_docente
              ORDER BY id_curso';
          $stmt = $this->conexion->prepare($sql);
          $stmt->execute([
              "id_docente" => $id_docente
          ]);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function buscarPorId($id_curso)
    {
        // TODO:
        // Buscar un curso por su identificador.
        $sql = 'SELECT `id_curso`, `id_docente`, `id_asignatura`, `nombre`, `descripcion`, `paralelo`, `horario`, `cantidad_alumnos`, `fecha_creacion`, `fecha_modificacion`, `estado`
              FROM `cursos`
              WHERE id_curso = :id_curso';
          $stmt = $this->conexion->prepare($sql);
          $stmt->execute([
              "id_curso" => $id_curso
          ]);
          return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function guardar($datos)
    {
        // TODO:
        // Registrar un nuevo curso.
    }


    public function actualizar($id, $datos)
    {
        // TODO:
        // Modificar la información de un curso.
    }


    public function eliminar($id)
    {
        // TODO:
        // Eliminar un curso.
    }
}
