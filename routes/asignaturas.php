<?php

$router['GET']['/asignaturas'] = ['AsignaturaController', 'index'];

$router['GET']['/asignaturas/crear'] = ['AsignaturaController', 'crear'];

$router['POST']['/asignaturas/guardar'] = ['AsignaturaController', 'guardar'];

$router['GET']['/asignaturas/editar'] = ['AsignaturaController', 'editar'];

$router['POST']['/asignaturas/actualizar'] = ['AsignaturaController', 'actualizar'];

$router['POST']['/asignaturas/eliminar'] = ['AsignaturaController', 'eliminar'];