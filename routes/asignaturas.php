<?php

$accion = $_GET["accion"] ?? "listar";

require_once __DIR__ . "/../app/controladores/AsignaturaControlador.php";

$controlador = new AsignaturaControlador();

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

    case "api_listar":
        $controlador->api_listar();
        break;

    case "api_buscar":
    case "buscar":
        $controlador->api_buscar();
        break;

    default:
        $controlador->listar();
        break;
}
