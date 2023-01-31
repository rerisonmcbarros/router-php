<?php

namespace Lib\Core;

use \Lib\Core\Request;

class Route{
	
	private $request;
	private $routes;
	private $separator;

	public function __construct(Request $request, string $separator = "::"){

		$this->request = $request;
		$this->separator = $separator;
	}
	
	public function get(string $route, $function){

		$httpMethod = "GET";

		$this->addRoute($httpMethod, $route, $function);
	}

	public function post(string $route, $function){

		$httpMethod = "POST";

		$this->addRoute($httpMethod, $route, $function);
	}

	private function addRoute($httpMethod, $route, $action){

		$separatorLen = strlen($this->separator);

		$controller = strstr($action, $this->separator, true);
		$function = substr(strstr($action, $this->separator), $separatorLen);

		$this->routes[$httpMethod][$route] = ['controller' => $controller, 'function' => $function];
	}

	private function routeExists($httpMethod){

		$uri = $this->request->uri();
		$explodeUri = explode("/", $uri);
		$countUri = count($explodeUri);

		foreach($this->routes[$httpMethod] as $route => $value){

			$explodeRoute = explode("/",$route);
			$countRoute = count($explodeRoute);

			if($countUri == $countRoute){

				for ($i=0; $i < $countUri ; $i++) { 
				
					if(strpos($explodeRoute[$i], "{") !== false){

						$paramName = substr(strstr($explodeRoute[$i],"}", true), 1);
						$paramValue = $explodeUri[$i];
				
						$this->request->get = array_merge($this->request->get(), [$paramName => $paramValue]);

						$explodeRoute[$i] = $explodeUri[$i];
					}
				}

				$implodeRoute = implode("/", $explodeRoute);

				if($implodeRoute == $uri){

					return $route;
				}
			}
		}

		return false;
	}

	public function dispatch(){

		try{

			$httpMethod = $this->request->httpMethod();

			if(empty($this->routes[$httpMethod])){

				throw new \Exception("Not Implemented", 501);
			}
			
			if(!$this->routeExists($httpMethod)){

				throw new \Exception("Not Found", 404);
			}
			
			$route = $this->routeExists($httpMethod);

			$controller = $this->routes[$httpMethod][$route]['controller'];

			$objectController = new $controller($this->request);

			$function = $this->routes[$httpMethod][$route]['function'];

			return call_user_func([$objectController, $function]);			
		}
		catch(\Exception $e){

			http_response_code($e->getCode());

			return "{$e->getMessage()} {$e->getCode()}";
		}	
	}
}