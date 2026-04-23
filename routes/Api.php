<?php

require_once 'helpers/Router.php';
require_once 'controllers/UsersController.php';

// ROUTING
Router::addDefault();
Router::add('/login', 'POST', [UsersController::class, 'login']);

// users
Router::add('/user', 'GET', [UsersController::class, 'users']);
Router::add('/user', 'PUT', [UsersController::class, 'create']);
Router::add('/user', 'DELETE', [UsersController::class, 'delete']);
Router::add('/auth', 'POST', [UsersController::class, 'auth']);
Router::run();
