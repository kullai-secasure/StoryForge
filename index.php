<?php
require_once 'config/database.php';
require_once 'lib/Router.php';
require_once 'lib/Session.php';

Session::start();

$router = new Router();
$router->addRoute('GET', '/', 'controllers/HomeController.php');
$router->addRoute('GET', '/story', 'controllers/StoryController.php');
$router->addRoute('POST', '/story/choice', 'controllers/StoryController.php');
$router->addRoute('GET', '/admin', 'controllers/AdminController.php');

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
?>
