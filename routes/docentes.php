<?php

$router['GET']['/docentes'] = ['DocenteControlador', 'listar'];

$router['GET']['/docentes/crear'] = ['DocenteControlador', 'crear'];

$router['POST']['/docentes/guardar'] = ['DocenteControlador', 'guardar'];

$router['GET']['/docentes/editar'] = ['DocenteControlador', 'editar'];

$router['POST']['/docentes/actualizar'] = ['DocenteControlador', 'actualizar'];

$router['POST']['/docentes/eliminar'] = ['DocenteControlador', 'eliminar'];
