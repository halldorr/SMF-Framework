<?php

class Router
{
	//Array of routes
	protected $routes = [];
	//Params from matched route
	protected $params = [];

	//Add a route to the routing table
	public function add($route, $params = [])
	{
		// Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

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
		/*foreach ($this->routes as $route => $params)
		{
			if ($url == $route)
			{
				$this->params = $params;
				return true;
			}
		}

		$reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";*/

        foreach ($this->routes as $route => $params) 
		{
            if (preg_match($route, $url, $matches)) 
			{
                // Get named capture group values
                //$params = [];

                foreach ($matches as $key => $match) 
				{
                    if (is_string($key)) 
					{
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }

		return false;
	}

	//get currently matched parameters
	public function getParams()
	{
		return $this->params;
	}
}