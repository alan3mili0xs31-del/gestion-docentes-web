<?php

$router['GET']['/actividades'] = ['ActividadAcademicaControlador', 'listar'];

$router['GET']['/actividades/crear'] = ['ActividadAcademicaControlador', 'crear'];

$router['POST']['/actividades/guardar'] = ['ActividadAcademicaControlador', 'guardar'];

$router['GET']['/actividades/editar'] = ['ActividadAcademicaControlador', 'editar'];

$router['POST']['/actividades/actualizar'] = ['ActividadAcademicaControlador', 'actualizar'];

$router['POST']['/actividades/eliminar'] = ['ActividadAcademicaControlador', 'eliminar'];
