<?php

namespace Lib\Core;

class Request{
	
	private $httpMethod;
	public  $get;
	public  $post;
	private $uri;

	/**
	 * O '$prefix' é o nome do diretório raiz do projeto
	 **/
	private $prefix;


	public function __construct(string $prefix){

		$this->prefix = $prefix;
		$this->httpMethod = filter_input(INPUT_SERVER, "REQUEST_METHOD");
		$this->get = filter_input_array(INPUT_GET);
		$this->post = filter_input_array(INPUT_POST);
		$this->uri = parse_url(filter_input(INPUT_SERVER, "REQUEST_URI"), PHP_URL_PATH);
	}

	public function httpMethod(){

		return $this->httpMethod;
	}

	public function get(){

		return $this->get;
	}

	public function post(){

		return $this->post;
	}

	public function uri(){

		$uri = $this->uri;

		if(strpos($this->uri, $this->prefix) !== false){

			$prefixLen = strlen($this->prefix);

			$uri = substr(strstr($this->uri, $this->prefix), $prefixLen);
		}

		return $uri;
	}

}