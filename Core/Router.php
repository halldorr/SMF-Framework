<?php
namespace Core;

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

		// Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

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

	//dispatch the route
	public function dispatch($url)
    {
		$url = $this->removeQueryStringVariables($url);

        if ($this->match($url)) 
		{
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
			//$controller = "App\Controllers\\$controller";
			$controller = $this->getNamespace() . $controller;

            if (class_exists($controller)) 
			{
                $controller_object = new $controller($this->params);

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if (preg_match('/action$/i', $action) == 0)
				{
                    $controller_object->$action();

                } 
				else 
				{
                    echo "Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method";
                }
            } 
			else 
			{
                echo "Controller class $controller not found";
            }
        } 
		else 
		{
            echo 'No route matched.';
        }
    }

	//convert string to StudlyCaps
    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    //convert string to camelCase
    protected function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

	 protected function removeQueryStringVariables($url)
    {
        if ($url != '') 
		{
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) 
			{
                $url = $parts[0];
            } 
			else 
			{
                $url = '';
            }
        }

        return $url;
    }

	protected function getNamespace()
	{
		$namespace = 'App\Controllers\\';

		if (array_key_exists('namespace', $this->params))
		{
			$namespace .= $this->params['namespace'] . '\\';
		}

		return $namespace;
	}
}