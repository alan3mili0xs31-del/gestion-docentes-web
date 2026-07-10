<?php

$router['GET']['/usuarios'] = ['UsuarioControlador', 'listar'];

$router['GET']['/usuarios/crear'] = ['UsuarioControlador', 'crear'];

$router['POST']['/usuarios/guardar'] = ['UsuarioControlador', 'guardar'];

$router['GET']['/usuarios/editar'] = ['UsuarioControlador', 'editar'];

$router['POST']['/usuarios/actualizar'] = ['UsuarioControlador', 'actualizar'];

$router['POST']['/usuarios/eliminar'] = ['UsuarioControlador', 'eliminar'];
