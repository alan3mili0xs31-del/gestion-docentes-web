<?php

$accion = $_GET["accion"] ?? "listar";


require_once __DIR__."/../app/controladores/CursoControlador.php";

$controlador = new CursoControlador();


switch ($accion) {


    case "listar":

        $controlador->listar();

        break;


    case "crear":

        $controlador->crear();

        break;


    case "guardar":

        $controlador->guardar();

        break;


    case "actualizar":

        $controlador->actualizar();

        break;


    case "editar":

        $controlador->editar();

        break;


    case "eliminar":

        $controlador->eliminar();

        break;


    case "buscar":

        $controlador->buscar();

        break;


    default:

        $controlador->listar();

        break;
}
