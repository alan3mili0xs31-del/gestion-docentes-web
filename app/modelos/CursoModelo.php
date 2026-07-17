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
        $sql = '';
        $stmt = '';
        if (!$id_docente) {
            $sql = "SELECT c.id_curso, CONCAT(d.primer_nombre, ' ', d.primer_apellido) as docente,
                a.nombre as asignatura, c.nombre, c.paralelo, c.descripcion,
                c.paralelo, c.horario, c.cantidad_alumnos, c.fecha_creacion,
                c.fecha_modificacion, c.estado
                FROM cursos c
                JOIN docentes d ON c.id_docente = d.id_docente
                JOIN asignaturas a ON c.id_asignatura = a.id_asignatura
                ORDER BY c.id_curso DESC";
          $stmt = $this->conexion->query($sql);
        }
        else {
            $sql = "SELECT c.id_curso, CONCAT(d.primer_nombre, ' ', d.primer_apellido) as docente,
                a.nombre as asignatura, c.nombre, c.paralelo, c.descripcion,
                c.paralelo, c.horario, c.cantidad_alumnos, c.fecha_creacion,
                c.fecha_modificacion, c.estado
                FROM cursos c
                JOIN docentes d ON c.id_docente = d.id_docente
                JOIN asignaturas a ON c.id_asignatura = a.id_asignatura
                WHERE c.id_docente = :id_docente
                ORDER BY c.id_curso DESC";
          $stmt = $this->conexion->prepare($sql);
          $stmt->execute([
              "id_docente" => $id_docente
          ]);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function buscarPorId($id_curso)
    {
        $sql = 'SELECT `id_curso`, `id_docente`, `id_asignatura`, `nombre`, `descripcion`, `paralelo`, `horario`, `cantidad_alumnos`, `fecha_creacion`, `fecha_modificacion`, `estado`
              FROM `cursos`
              WHERE id_curso = :id_curso';
          $stmt = $this->conexion->prepare($sql);
          $stmt->execute([
              "id_curso" => $id_curso
          ]);
          return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorNombre($nombre)
    {
            $sql = "SELECT c.id_curso, CONCAT(d.primer_nombre, ' ', d.primer_apellido) as docente,
                a.nombre as asignatura, c.nombre, c.paralelo, c.descripcion,
                c.paralelo, c.horario, c.cantidad_alumnos, c.fecha_creacion,
                c.fecha_modificacion, c.estado
                FROM cursos c
                JOIN docentes d ON c.id_docente = d.id_docente
                JOIN asignaturas a ON c.id_asignatura = a.id_asignatura
                WHERE c.nombre LIKE :nombre
                ORDER BY c.id_curso DESC";
          $stmt = $this->conexion->prepare($sql);
          $stmt->execute([
              "nombre" => "%{$nombre}%"
          ]);
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
