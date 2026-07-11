<?php

$accion = $_GET["accion"] ?? "mostrar";


require_once "app/controladores/LoginControlador.php";


$controlador = new LoginControlador();


switch ($accion) {
    // Procesar formulario
    case "login":

        $controlador->login();

        break;


    // Cerrar sesión
    case "logout":

        $controlador->logout();

        break;


    default:

        $controlador->mostrarFormulario();

        break;
}
