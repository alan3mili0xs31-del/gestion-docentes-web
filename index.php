<?php

session_start();

require_once 'config/Conexion.php';

// Arreglo donde se almacenarán todas las rutas
$router = [];

// Cargar rutas
// Cada router aÃ±ade las rutas usando el arreglo de router
require_once 'routes/auth.php';
require_once 'routes/docentes.php';
require_once 'routes/cursos.php';
require_once 'routes/asignaturas.php';
require_once 'routes/asistencias.php';
require_once 'routes/actividades.php';
require_once 'routes/usuarios.php';


// Obtener la ruta solicitada
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


// Si el proyecto está dentro de una carpeta en localhost,
// elimina esa parte de la URL.
$base = '/gestion-docentes-mvc';
$uri = str_replace($base, '', $uri);


if ($uri == '') {
    $uri = '/';
}


$method = $_SERVER['REQUEST_METHOD'];


// Buscar la ruta
if (isset($router[$method][$uri])) {

    $controlador = $router[$method][$uri][0];
    $action = $router[$method][$uri][1];

    require_once "app/controladores/$controlador.php";

    $obj = new $controlador();

    $obj->$action();

} else {

    http_response_code(404);

    echo "<h1>404 - Página no encontrada</h1>";

}

