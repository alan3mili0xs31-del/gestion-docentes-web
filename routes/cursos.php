<?php

$router['GET']['/cursos'] = ['CursoController', 'index'];

$router['GET']['/cursos/crear'] = ['CursoController', 'crear'];

$router['POST']['/cursos/guardar'] = ['CursoController', 'guardar'];

$router['GET']['/cursos/editar'] = ['CursoController', 'editar'];

$router['POST']['/cursos/actualizar'] = ['CursoController', 'actualizar'];

$router['POST']['/cursos/eliminar'] = ['CursoController', 'eliminar'];