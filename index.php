<?php

session_start();

// Extraer el modulo al que intenta acceder y redirigirlo a su router
$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$baseUrl = "/gestion-docentes-web";
$path = str_replace($baseUrl, '', $url);

switch ($path) {

    case "/auth":
        require_once "routes/auth.php";
        break;


    case "/inicio":
        require_once "app/vistas/home.php";
        break;


    case "/usuarios":
        require_once "routes/usuarios.php";
        break;


    case "/docentes":
        require_once "routes/docentes.php";
        break;


    case "/cursos":
        require_once "routes/cursos.php";
        break;


    case "/asignaturas":
        require_once "routes/asignaturas.php";
        break;


    case "/asistencias-docente":
        require_once "routes/asistencias.php";
        break;


    case "/actividades":
        require_once "routes/actividades.php";
        break;


    default:
        header("Location: ".$baseUrl."/auth");
        exit;
}
