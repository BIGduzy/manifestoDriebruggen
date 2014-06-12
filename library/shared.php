<?php

	function callHook($url)
	{
		/* Commentaar geldt voor bij het ingeven van de volgende url:
		 * users/viewall/1/2/3
		 */

		$urlArray = explode('/', $url);
		//var_dump($urlArray);
		$controller = $urlArray[0]; //$controller = users
		//echo $controller;
		array_shift($urlArray);
		//var_dump($urlArray);
		$action = $urlArray[0];		//$action = viewall
		//echo $action;
		array_shift($urlArray);
		//var_dump($urlArray);
		$querystring = $urlArray;	//querystring = array(1, 2, 3)
		//var_dump($querystring);

		//Mapnaam voor de controllers
		$controllerName = $controller; //$controllername = 'users'

		/* De naam van de modelclass wordt User. Dus we moeten een hoofdletter maken
		 * van de u en er moet een s van de naam afgehaald worden */
		 $controller = ucwords($controller); //$controller = 'Users';
		 //echo $controller;
		 $model = rtrim($controller, 's');  //$model = 'User'
		 //echo $model;
		 $controller .= 'Controller';		//$controller = 'UsersController'
		 //echo $controller;

		 $dispatch = new $controller($model, $controllerName, $action);

		 if (method_exists($controller, $action))
		 {
			call_user_func_array(array($dispatch, $action), $querystring);
			//call_user_func_array(array(new UsersController, Viewall), array(1,2,3))
		 }
		 else
		 {
			echo "method ".$action."NOT FOUND";
		 }

	}

	function __autoload($classname)
	{
		if ( file_exists(ROOT.DS.'library'.DS.strtolower($classname).'.class.php'))
		{
			require_once(ROOT.DS.'library'.DS.strtolower($classname).'.class.php');
		}
		else if( file_exists(ROOT.DS.'application'.DS.'controllers'.DS.strtolower($classname).'.php'))
		{
			require_once(ROOT.DS.'application'.DS.'controllers'.DS.strtolower($classname).'.php');
		}
		else if ( file_exists(ROOT.DS.'application'.DS.'models'.DS.strtolower($classname).'.php'))
		{
			require_once(ROOT.DS.'application'.DS.'models'.DS.strtolower($classname).'.php');
		}
		else
		{
			echo $classname." NOT FOUND";
		}
	}
	//Session_start() mag niet na "call_user_func_array(array($dispatch, $action), $querystring)" van
	//"callHook($url)" staan(link.php maakt gebruik van $_SESSION).  
	//maar niet eerder (bijv: tussen require_once(ROOT.DS.'config'.DS.'config.php'); en 
	//require_once(ROOT.DS.'library'.DS.'shared.php') van het bootstrap.php bestand;		
	session_start();
	callHook($url);	
?>