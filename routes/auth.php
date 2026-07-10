<?php

$router['GET']['/'] = ['AuthController', 'login'];

$router['GET']['/login'] = ['AuthController', 'login'];

$router['POST']['/login'] = ['AuthController', 'autenticar'];

$router['GET']['/logout'] = ['AuthController', 'cerrarSesion'];