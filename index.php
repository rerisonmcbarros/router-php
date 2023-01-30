<?php

// Fazendo a inclusão do autoload ao arquivo raiz da aplicação.
require_once __DIR__."/autoload.php";

/**
 * O nome do diretório raiz do projeto deve er passado como parâmetro no construtor da classe
 * ex: new \Lib\Core\Request("Framework");
 **/
$request = new \Lib\Core\Request("Framework");

$route = new \Lib\Core\Route();


echo "<pre>", var_dump( $request->uri()), "</pre>";



