<?php

$router['GET']['/cursos'] = ['CursoControlador', 'listar'];

$router['GET']['/cursos/crear'] = ['CursoControlador', 'crear'];

$router['POST']['/cursos/guardar'] = ['CursoControlador', 'guardar'];

$router['GET']['/cursos/editar'] = ['CursoControlador', 'editar'];

$router['POST']['/cursos/actualizar'] = ['CursoControlador', 'actualizar'];

$router['POST']['/cursos/eliminar'] = ['CursoControlador', 'eliminar'];
