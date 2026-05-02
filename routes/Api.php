<?php

require_once 'helpers/Router.php';
require_once 'controllers/UsersController.php';
require_once 'controllers/AuthControllers.php';

// ROUTING
Router::addDefault();
Router::add('/login', 'POST', [AuthControllers::class, 'login']);

// users
Router::add('/user', 'GET', [UsersController::class, 'users']);
Router::add('/user', 'PUT', [UsersController::class, 'create']);
Router::add('/user', 'DELETE', [UsersController::class, 'delete']);
Router::add('/user', 'POST', [UsersController::class, 'getUser']);
Router::add('/auth', 'POST', [UsersController::class, 'auth']);
Router::run();
