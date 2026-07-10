<?php

$router['GET']['/actividades'] = ['ActividadAcademicaController', 'index'];

$router['GET']['/actividades/crear'] = ['ActividadAcademicaController', 'crear'];

$router['POST']['/actividades/guardar'] = ['ActividadAcademicaController', 'guardar'];

$router['GET']['/actividades/editar'] = ['ActividadAcademicaController', 'editar'];

$router['POST']['/actividades/actualizar'] = ['ActividadAcademicaController', 'actualizar'];

$router['POST']['/actividades/eliminar'] = ['ActividadAcademicaController', 'eliminar'];