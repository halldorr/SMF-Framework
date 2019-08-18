<?php

//echo 'url: ' . $_SERVER['QUERY_STRING'];

require '../Core/Router.php';
$router = new Router();

//Add routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
//$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');
$router->add('{controller}/{id:\d+}/{action}');


echo '<pre>'; echo htmlspecialchars(print_r($router->getRoutes(), true)); echo '</pre>';

$url = $_SERVER['QUERY_STRING'];

if ($router->match($url))
{
	var_dump($router->getParams());
}
else
{
	echo 'No route found from: ' . $url;
}