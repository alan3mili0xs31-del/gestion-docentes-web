<?php

$router['GET']['/docentes'] = ['DocenteController', 'index'];

$router['GET']['/docentes/crear'] = ['DocenteController', 'crear'];

$router['POST']['/docentes/guardar'] = ['DocenteController', 'guardar'];

$router['GET']['/docentes/editar'] = ['DocenteController', 'editar'];

$router['POST']['/docentes/actualizar'] = ['DocenteController', 'actualizar'];

$router['POST']['/docentes/eliminar'] = ['DocenteController', 'eliminar'];