<?php

$router['GET']['/asistencias'] = ['AsistenciaController', 'index'];

$router['GET']['/asistencias/crear'] = ['AsistenciaController', 'crear'];

$router['POST']['/asistencias/guardar'] = ['AsistenciaController', 'guardar'];

$router['GET']['/asistencias/editar'] = ['AsistenciaController', 'editar'];

$router['POST']['/asistencias/actualizar'] = ['AsistenciaController', 'actualizar'];

$router['POST']['/asistencias/eliminar'] = ['AsistenciaController', 'eliminar'];