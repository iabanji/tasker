<?php

namespace app\core;

/**
 * Class FrontController
 * @package app\core
 */
class FrontController
{
	static function run()
	{
        /**
         * try parse route & set default action
         * call controller method
         */

		$action_name = 'index';
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		if (!empty($routes[1]))
		{	
			$controllerName = ucfirst($routes[1]) . 'Controller';
		}else
        {
            $controllerName = 'DefaultController';
		}

		if ( !empty($routes[2]) )
		{
			$filteredAction = strstr($routes[2], '?', true);
			$action_name = (!$filteredAction) ? $routes[2] : $filteredAction;
		}

		$fullName = 'app\controllers\\' . urldecode($controllerName);

		$controller = new $fullName();

		if(method_exists($controller, $action_name))
		{

            $controller->childCName = strtolower(substr($controllerName, 0, strpos($controllerName, 'Controller')));
			$controller->$action_name();
		}
		else
		{
			die('А здесь может быть страница 404');
		}
	}
}