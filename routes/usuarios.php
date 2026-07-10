<?php

$router['GET']['/usuarios'] = ['UsuarioController', 'index'];

$router['GET']['/usuarios/crear'] = ['UsuarioController', 'crear'];

$router['POST']['/usuarios/guardar'] = ['UsuarioController', 'guardar'];

$router['GET']['/usuarios/editar'] = ['UsuarioController', 'editar'];

$router['POST']['/usuarios/actualizar'] = ['UsuarioController', 'actualizar'];

$router['POST']['/usuarios/eliminar'] = ['UsuarioController', 'eliminar'];