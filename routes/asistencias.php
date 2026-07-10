<?php

$router['GET']['/asistencias'] = ['AsistenciaControlador', 'listar'];

$router['GET']['/asistencias/crear'] = ['AsistenciaControlador', 'crear'];

$router['POST']['/asistencias/guardar'] = ['AsistenciaControlador', 'guardar'];

$router['GET']['/asistencias/editar'] = ['AsistenciaControlador', 'editar'];

$router['POST']['/asistencias/actualizar'] = ['AsistenciaControlador', 'actualizar'];

$router['POST']['/asistencias/eliminar'] = ['AsistenciaControlador', 'eliminar'];
