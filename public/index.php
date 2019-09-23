<?php

//INCLUDE THE FILES NEEDED...
// require_once('../App/view/LoginView.php');
// require_once('../App/view/DateTimeView.php');
// require_once('../App/view/LayoutView.php');

// require('../Core/Router.php');

require '../vendor/autoload.php';

// spl_autoload_register(function ($class) {
//   $root = dirname(__DIR__);
//   $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
//   if (is_readable($file)) {
//     require $root . '/' . str_replace('\\', '/', $class) . '.php';
//   }
// });

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
// $v = new App\View\LoginView();
// $dtv = new App\View\DateTimeView();
// $lv = new App\View\LayoutView();

$router = new Core\Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('login', ['controller' => 'Home', 'action' => 'create']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

$router->dispatch($_SERVER['QUERY_STRING']);

// $lv->render(false, $v, $dtv);

