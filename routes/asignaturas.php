<?php

$router['GET']['/asignaturas'] = ['AsignaturaControlador', 'listar'];

$router['GET']['/asignaturas/crear'] = ['AsignaturaControlador', 'crear'];

$router['POST']['/asignaturas/guardar'] = ['AsignaturaControlador', 'guardar'];

$router['GET']['/asignaturas/editar'] = ['AsignaturaControlador', 'editar'];

$router['POST']['/asignaturas/actualizar'] = ['AsignaturaControlador', 'actualizar'];

$router['POST']['/asignaturas/eliminar'] = ['AsignaturaControlador', 'eliminar'];
