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
        estaAutenticado();
        require_once "app/vistas/home.php";
        break;

    case "/perfil":
        estaAutenticado();
        require_once "app/controladores/PerfilControlador.php";
        $controlador = new PerfilControlador();
        $controlador->mostrarPerfil();
        break;

    case "/perfil/actualizar":
        estaAutenticado();
        require_once "app/controladores/PerfilControlador.php";
        $controlador = new PerfilControlador();
        $controlador->actualizar();
        break;


    case "/usuarios":
        estaAutenticado();
        require_once "routes/usuarios.php";
        break;


    case "/docentes":
        estaAutenticado();
        require_once "routes/docentes.php";
        break;


    case "/cursos":
        estaAutenticado();
        require_once "routes/cursos.php";
        break;


    case "/asignaturas":
        esAdmin();
        estaAutenticado();
        require_once "routes/asignaturas.php";
        break;


    case "/asistencias-docente":
        estaAutenticado();
        require_once "routes/asistencias.php";
        break;


    case "/actividades-docente":
        estaAutenticado();
        require_once "routes/actividades.php";
        break;


    default:
        header("Location: ".$baseUrl."/auth");
        exit;
}


function estaAutenticado() {
    if (!isset($_SESSION["usuario"])) {
        header("Location: /gestion-docentes-web/auth");
        exit;
    }
}

function esAdmin() {
    if (strcmp($_SESSION["usuario"]["rol"], "administrador") != 0) {
      require_once __DIR__."/app/vistas/layout/no-autorizado.php";
      exit;
  }
}
