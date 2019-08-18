<?php

class Router
{
	//Array of routes
	protected $routes = [];
	//Params from matched route
	protected $params = [];

	//Add a route to the routing table
	public function add($route, $params)
	{
		$this->routes[$route] = $params;
	}

	//Get all routes
	public function getRoutes()
	{
		return $this->routes;
	}

	//match the routes in the routing table, setting params property if route found
	public function match($url)
	{
		foreach ($this->routes as $route => $params)
		{
			if ($url == $route)
			{
				$this->params = $params;
				return true;
			}
		}

		return false;
	}

	//get currently matched parameters
	public function getParams()
	{
		$this->params;
	}
}