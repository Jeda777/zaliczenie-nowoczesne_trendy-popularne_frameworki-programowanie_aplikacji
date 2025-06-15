<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/src/config/database.php';
require_once __DIR__ . '/src/Utils/Router.php';
require_once __DIR__ . '/src/Controllers/MessageController.php';
require_once __DIR__ . '/src/Models/Message.php';
require_once __DIR__ . '/src/Controllers/UserController.php';
require_once __DIR__ . '/src/Models/User.php';

header('Content-Type: application/json');

$router = new Router();

// GET /api/message
$router->addRoute('GET', '/api/message', function() {
    $messageController = new MessageController();
    $messageController->getAllMessages();
});

// POST /api/message
$router->addRoute('POST', '/api/message', function() {
    $messageController = new MessageController();
    $messageController->createMessage();
});

// POST /api/user/login
$router->addRoute('POST', '/api/user/login', function() {
    $userController = new UserController();
    $userController->login();
});

// POST /api/user/register
$router->addRoute('POST', '/api/user/register', function() {
    $userController = new UserController();
    $userController->register();
});

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

?>
