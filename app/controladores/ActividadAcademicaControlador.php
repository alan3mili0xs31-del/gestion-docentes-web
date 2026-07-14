<?php

require_once __DIR__.'/../modelos/ActividadAcademicaModelo.php';
require_once __DIR__.'/../modelos/DocenteModelo.php';

class ActividadAcademicaControlador
{
    private $modelo;
    private $docenteModelo;

    public function __construct()
    {
        $this->modelo = new ActividadAcademicaModelo();
        $this->docenteModelo = new DocenteModelo();
    }

    private function getIdDocenteActual()
    {
        if (isset($_SESSION["usuario"]) && isset($_SESSION["usuario"]["cedula"])) {
            $docente = $this->docenteModelo->buscarPorCedula($_SESSION["usuario"]["cedula"]);
            if ($docente) {
                return $docente['id_docente'];
            }
        }
        return null;
    }

    public function listar()
    {
        $id_docente = $this->getIdDocenteActual();
        if (!$id_docente) {
            die("Error: No se encontró el docente asociado al usuario.");
        }
        
        $actividades = $this->modelo->listar($id_docente);
        require_once "app/vistas/actividad-docente/listado.php";
    }

    public function perfil()
    {
        require_once "app/vistas/actividad-docente/perfil.php";
    }

    public function crear()
    {
        require_once "app/vistas/actividad-docente/crear.php";
    }

    public function guardar()
    {
        $id_docente = $this->getIdDocenteActual();
        if (!$id_docente) {
            die("Error: No se encontró el docente asociado al usuario.");
        }

        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $datos = [
                'id_docente' => $id_docente,
                'categoria' => $_POST['categoria'] ?? '',
                'horas' => $_POST['horas'] ?? 0,
                'fecha_inicio' => $_POST['fechaInicio'] ?? '',
                'fecha_fin' => $_POST['fechaFin'] ?? ''
            ];

            $this->modelo->guardar($datos);
            header("Location: ?accion=listar");
            exit;
        }
    }

    public function editar()
    {
        $id_docente = $this->getIdDocenteActual();
        $id_actividad = $_GET['id'] ?? null;
        
        if ($id_actividad && $id_docente) {
            $actividad = $this->modelo->buscar($id_actividad, $id_docente);
            if ($actividad) {
                require_once "app/vistas/actividad-docente/editar.php";
                return;
            }
        }
        header("Location: ?accion=listar");
        exit;
    }

    public function actualizar()
    {
        $id_docente = $this->getIdDocenteActual();
        $id_actividad = $_GET['id'] ?? null;

        if ($_SERVER["REQUEST_METHOD"] == 'POST' && $id_actividad && $id_docente) {
            $datos = [
                'id_docente' => $id_docente,
                'categoria' => $_POST['categoria'] ?? '',
                'horas' => $_POST['horas'] ?? 0,
                'fecha_inicio' => $_POST['fechaInicio'] ?? '',
                'fecha_fin' => $_POST['fechaFin'] ?? ''
            ];

            $this->modelo->actualizar($id_actividad, $datos);
            header("Location: ?accion=listar");
            exit;
        }
    }

    public function eliminar()
    {
        $id_docente = $this->getIdDocenteActual();
        $id_actividad = $_GET['id'] ?? null;

        if ($id_actividad && $id_docente) {
            $this->modelo->eliminar($id_actividad, $id_docente);
        }
        header("Location: ?accion=listar");
        exit;
    }
}
