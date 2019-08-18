<?php

//require_once dirname(__DIR__) . '/vendor/twig/twig/lib/Twig/Autoloader.php';
require '../vendor/autoload.php';
//Twig_Autoloader::register();

/*spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);   // get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});*/

set_error_handler('\Core\Error::errorHandler');
set_exception_handler('\Core\Error::exceptionHandler');

$router = new Core\Router();

//Add routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
//$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('{controller}/{action}');
//$router->add('admin/{action}/{controller}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);


/*echo '<pre>'; echo htmlspecialchars(print_r($router->getRoutes(), true)); echo '</pre>';

$url = $_SERVER['QUERY_STRING'];

if ($router->match($url))
{
	var_dump($router->getParams());
}
else
{
	echo 'No route found from: ' . $url;
}*/

$router->dispatch($_SERVER['QUERY_STRING']);