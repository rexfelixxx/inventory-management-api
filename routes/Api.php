<?php

require_once 'helpers/Router.php';
require_once 'controllers/UsersController.php';

// ROUTING
Router::addDefault();
Router::add('/login', 'POST', [UsersController::class, 'login']);
Router::add('/users', 'GET', [UsersController::class, 'users']);
Router::add('/auth', 'POST', [UsersController::class, 'auth']);
Router::run();
