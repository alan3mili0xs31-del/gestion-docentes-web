<?php

$accion = $_GET["accion"] ?? "listar";


require_once __DIR__."/../app/controladores/ActividadAcademicaControlador.php";


$controlador = new ActividadAcademicaControlador();


switch ($accion) {


    case "listar":

        $controlador->listar();

        break;


    case "crear":

        $controlador->crear();

        break;

    case "editar":
        $controlador->editar();
        break;


    case "guardar":

        $controlador->guardar();

        break;


    case "actualizar":

        $controlador->actualizar();

        break;


    case "eliminar":

        $controlador->eliminar();

        break;


    case "buscar":

        $controlador->buscar();

        break;


    case "perfil":
        $controlador->perfil();
        break;

    default:
        $controlador->listar();
        break;

}
