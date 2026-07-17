<?php

require_once __DIR__.'/../modelos/AsistenciaModelo.php';
require_once __DIR__.'/../modelos/DocenteModelo.php';
require_once __DIR__.'/../modelos/CursoModelo.php';


class AsistenciaControlador
{
    private AsistenciaModelo $asistenciaModelo;
    private DocenteModelo $docenteModelo;
    private CursoModelo $cursoModelo;


    public function __construct()
    {
        $this->asistenciaModelo = new AsistenciaModelo();
        $this->docenteModelo = new DocenteModelo();
        $this->cursoModelo = new CursoModelo();
    }


    public function listar()
    {
        $usuario_session = $_SESSION["usuario"];

        $asistencias = [];


        if (strcmp($usuario_session["rol"], "administrador") != 0) {

            $docente = $this->docenteModelo->buscarPorCedula($usuario_session["cedula"]);

            $asistencias = $this->asistenciaModelo->listarMisAsistencias(
                $docente["id_docente"]
            );

        } else {

            $asistencias = $this->asistenciaModelo->listar();

        }


        require_once "app/vistas/asistencias-docente/asistencia_listado.php";
    }



    public function crear()
    {

        $docentes = [];
        $cursos = [];
        if ($_SESSION["usuario"]["rol"] == "administrador") {
            $docentes = $this->docenteModelo->listar();
            $cursos = $this->cursoModelo->listar();
        } else {
            $docentes = [$this->docenteModelo->buscarPorCedula($_SESSION["usuario"]["cedula"])];
            $cursos = $this->cursoModelo->listar($docentes[0]["id_docente"]);
        }

        require_once "app/vistas/asistencias-docente/asistencia_crear.php";
    }



    public function guardar()
    {
        header('Content-Type: application/json');

        try {

            $json = file_get_contents("php://input");
            $datos = json_decode($json, true);


            if (
                !$datos ||
                empty($datos['id_curso']) ||
                empty($datos['id_docente']) ||
                empty($datos['fecha']) ||
                empty($datos['estado'])
            ) {

                throw new Exception("Datos inválidos o incompletos");

            }


            $resultado = $this->asistenciaModelo->guardar([

                'id_curso' => $datos['id_curso'],
                'id_docente' => $datos['id_docente'],
                'fecha' => $datos['fecha'],
                'estado' => $datos['estado']

            ]);


            if ($resultado > 0) {

                echo json_encode([
                    "success" => true,
                    "mensaje" => "Asistencia registrada correctamente"
                ]);

            } else {

                echo json_encode([
                    "success" => false,
                    "mensaje" => "No se pudo registrar la asistencia"
                ]);

            }


        } catch (Exception $e) {

            http_response_code(400);

            echo json_encode([
                "success" => false,
                "mensaje" => $e->getMessage()
            ]);

        }
    }



    public function editar()
    {
        $id_asistencia = $_GET["id_asistencia"] ?? '';

        $asistencia = $this->asistenciaModelo->buscar($id_asistencia);


        if ($asistencia) {

            $docentes = $this->docenteModelo->listar();
            $cursos = $this->cursoModelo->listar();

            require_once "app/vistas/asistencias-docente/asistencia_editar.php";


        } else {

            require_once "app/vistas/layout/no-encontrado.php";

        }
    }




    public function actualizar()
    {
        header('Content-Type: application/json');


        try {

            $json = file_get_contents("php://input");
            $datos = json_decode($json, true);



            if (
                !$datos ||
                empty($datos['id_asistencia']) ||
                empty($datos['id_curso']) ||
                empty($datos['id_docente']) ||
                empty($datos['fecha']) ||
                empty($datos['estado'])
            ) {

                throw new Exception("Datos inválidos o incompletos");

            }



            $resultado = $this->asistenciaModelo->actualizar(
                $datos['id_asistencia'],
                [

                    'id_curso' => $datos['id_curso'],
                    'id_docente' => $datos['id_docente'],
                    'fecha' => $datos['fecha'],
                    'estado' => $datos['estado']

                ]
            );



            if ($resultado > 0) {

                echo json_encode([
                    "success" => true,
                    "mensaje" => "Asistencia actualizada correctamente"
                ]);

            } else {

                echo json_encode([
                    "success" => false,
                    "mensaje" => "No se pudo actualizar la asistencia"
                ]);

            }



        } catch (Exception $e) {

            http_response_code(400);

            echo json_encode([
                "success" => false,
                "mensaje" => $e->getMessage()
            ]);

        }
    }




    public function eliminar()
    {
        $id_asistencia = $_GET["id_asistencia"] ?? '';


        if ($id_asistencia) {

            $this->asistenciaModelo->eliminar($id_asistencia);

            header("Location: " . BASE_URL . "/asistencias-docente");

            exit();

        }
    }

    public function buscar()
    {
        $id_asistencia = $_GET["id_asistencia"] ?? '';

        $asistencia = $this->asistenciaModelo->buscar($id_asistencia);

        if ($asistencia) {
            require_once "app/vistas/asistencias-docente/asistencia_detalle.php";
        } else {
            require_once "app/vistas/layout/no-encontrado.php";
        }
    }

}
