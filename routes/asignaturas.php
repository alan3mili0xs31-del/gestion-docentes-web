<?php

$accion = $_GET["accion"] ?? "listar";


require_once "app/controladores/AsignaturaControlador.php";


$controlador = new AsignaturaControlador();


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
