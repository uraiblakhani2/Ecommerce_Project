<?php
namespace app\core;

class App{
	private $controller = 'Home';
	private $method = 'index';

	public function __construct(){
		//echo $_GET['url'];
		//TODO: replace this echo with the routing algorithm
		//goal: separate the url in parts

		$url = self::parseUrl(); //get the url parsed and returned as an array of URL segment


		if(!empty($url[0])){
			if(file_exists('app/controllers/' . $url[0] . '.php')){
				$this->controller = $url[0]; //$this refers to the current object
			}
			unset($url[0]);
		}
		$this->controller = 'app\\controllers\\' . $this->controller; //provide a fully qualified classname
		$this->controller = new $this->controller;

		//use the second part to determine the method to run

		if(isset($url[1])){
			if(method_exists($this->controller, $url[1])){
				$this->method = $url[1];
			}
			unset($url[1]);
		}

		//access filtering
		//attribute discovery
		$reflection = new \ReflectionObject($this->controller);

		$classAttributes = $reflection->getAttributes();
		$methodAttributes = $reflection->getMethod($this->method)->getAttributes();

		$attributes = array_values(array_merge($classAttributes, $methodAttributes));

		//running the attribute class methods
		foreach ($attributes as $attribute) {
			$filter = $attribute->newInstance();//making the object of class, e.g., Login
			if($filter->execute())
				return;
		}

		//...while passing all other parts as arguments
		//repackage the parameters
		$params = $url ? array_values($url) : [];
		call_user_func_array([ $this->controller, $this->method ], $params);
	}

	public static function parseUrl(){

        $url = $_SERVER['REQUEST_URI'];
        $url =  ltrim($url, '/');
        $url = strtok($url, '?');
        if($url)//get url exists
        {
            return explode('/', //return parts in an array, separated by /
                filter_var(	//remove non-URL characters and sequences
                    rtrim($url, '/'))
                ,FILTER_SANITIZE_URL);
        }
	}



}