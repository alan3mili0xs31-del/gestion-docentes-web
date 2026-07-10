<?php

$router['GET']['/'] = ['AuthControlador', 'login'];

$router['GET']['/login'] = ['AuthControlador', 'login'];

$router['POST']['/login'] = ['AuthControlador', 'autenticar'];

$router['GET']['/logout'] = ['AuthControlador', 'cerrarSesion'];
