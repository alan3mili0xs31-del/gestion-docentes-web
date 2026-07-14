<?php

require_once __DIR__.'/../modelos/DocenteModelo.php';

class DocenteControlador
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new DocenteModelo();
    }

    public function listar()
    {
        $docentes = $this->modelo->listar();
        require_once "app/vistas/docente/listado-docentes.php";
    }

    public function crear()
    {
        require_once "app/vistas/docente/crear-docente.php";
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'cedula' => $_POST['cedula'] ?? '',
                'primer_nombre' => $_POST['primer_nombre'] ?? '',
                'segundo_nombre' => $_POST['segundo_nombre'] ?? '',
                'primer_apellido' => $_POST['primer_apellido'] ?? '',
                'segundo_apellido' => $_POST['segundo_apellido'] ?? '',
            ];
            $this->modelo->guardar($datos);
        }
        header("Location: /gestion-docentes-web/docentes?accion=listar");
        exit;
    }

    public function editar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $docente = $this->modelo->buscar($id);
            if ($docente) {
                require_once "app/vistas/docente/editar-docente.php";
                return;
            }
        }
        header("Location: /gestion-docentes-web/docentes?accion=listar");
        exit;
    }

    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $datos = [
                    'cedula' => $_POST['cedula'] ?? '',
                    'primer_nombre' => $_POST['primer_nombre'] ?? '',
                    'segundo_nombre' => $_POST['segundo_nombre'] ?? '',
                    'primer_apellido' => $_POST['primer_apellido'] ?? '',
                    'segundo_apellido' => $_POST['segundo_apellido'] ?? '',
                ];
                $this->modelo->actualizar($id, $datos);
            }
        }
        header("Location: /gestion-docentes-web/docentes?accion=listar");
        exit;
    }

    public function eliminar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelo->eliminar($id);
        }
        header("Location: /gestion-docentes-web/docentes?accion=listar");
        exit;
    }
}
