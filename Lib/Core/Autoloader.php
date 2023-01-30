<?php

namespace Lib\Core;

class Autoloader{
	
	private $rootFolder;
	private $rootPath;
	private $class;

	public function __construct($rootFolder){

		$this->rootFolder = $rootFolder;
	}

	public function load($class){

		if($class){

			$this->class = str_replace("\\", "/", $class);
		}
		
		$file = $this->rootPath().$this->getNamespace().$this->getClassName().".php";

		if(file_exists($file) && is_file($file)){

			require_once $file;

			return true;
		}

		return false;
	}

	public function rootPath(){

		$rootPath = strstr(__DIR__, $this->rootFolder, true).$this->rootFolder."/";

		return $rootPath;
	}

	public function getClassName(){

		$className = substr(strrchr($this->class, "/"),1);

		return $className;
	}

	public function getNamespace(){

		$namespace = substr($this->class, 0, strrpos($this->class, "/")+1);

		return $namespace;
	}

}