<?php

require_once 'helpers/Router.php';
require_once 'controllers/UserController.php';
require_once 'controllers/LoginController.php';
require_once 'controllers/LogoutController.php';
require_once 'controllers/CategoryController.php';
require_once 'controllers/ItemController.php';
require_once 'controllers/StockController.php';

// ROUTING
Router::addDefault();
Router::add('user', 'POST', [UserController::class, 'create']);
Router::add('user', 'DELETE', [UserController::class, 'delete']);
Router::add('user', 'PUT', [UserController::class, 'update']);
Router::add('user', 'GET', [UserController::class, 'get']);

Router::add('category', 'POST', [CategoryController::class, 'create']);
Router::add('category', 'GET', [CategoryController::class, 'get']);
Router::add('category', 'DELETE', [CategoryController::class, 'delete']);
Router::add('category', 'PUT', [CategoryController::class, 'update']);

Router::add('item', 'POST', [ItemController::class, 'create']);
Router::add('item', 'GET', [ItemController::class, 'get']);
Router::add('item', 'DELETE', [ItemController::class, 'delete']);
Router::add('item', 'PATCH', [ItemController::class, 'patch']);

Router::add('stock', 'POST', [StockController::class, 'create']);

Router::add('login', 'POST', [LoginController::class, 'login']);
Router::add('logout', 'GET', [LogoutController::class, 'logout']);
Router::run();
