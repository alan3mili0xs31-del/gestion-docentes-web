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
        $sql = "INSERT INTO cursos(nombre, descripcion, id_docente, id_asignatura, horario, paralelo)
                VALUES(:nombre,  :descripcion, :id_docente, :id_asignatura, :horario, :paralelo)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':nombre' => $datos["nombre"],
            ':descripcion' => $datos["descripcion"],
            ':id_docente' => $datos["id_docente"],
            ':id_asignatura' => $datos["id_asignatura"],
            ':horario' => $datos["horario"],
            ':paralelo' => $datos["paralelo"],
        ]);

        return $stmt->rowCount();
    }


    public function actualizar($id_curso, $cambios)
    {
        $sql = "UPDATE cursos
                SET nombre = :nombre,
                    descripcion = :descripcion,
                    id_docente = :id_docente,
                    id_asignatura = :id_asignatura,
                    estado = :estado
                WHERE id_curso = :id_curso";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':nombre' => $cambios["nombre"],
            ':descripcion' => $cambios["descripcion"],
            ':id_docente' => $cambios["id_docente"],
            ':id_asignatura' => $cambios["id_asignatura"],
            ':estado' => $cambios["estado"],
            ':id_curso' => $id_curso
        ]);

        return $stmt->rowCount();
    }


    public function eliminar($id_curso)
    {
        $sql = 'DELETE FROM cursos
                WHERE id_curso = :id_curso';

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id_curso" => $id_curso
        ]);
    }
}
