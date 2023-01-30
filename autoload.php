<?php

require_once __DIR__."/Lib/Core/Autoloader.php";

/* 
** Chamada da função spl_autoload_register que trás como callback o método 'load' da classe '\Lib\Core\Autoloader',
** O nome do Diretório raiz da aplicação deve ser passado ao construtor da classe '\Lib\Core\Autoloader' como parâmetro
	ex new \Lib\Core\Autoloader('Diretório raiz');
*/
spl_autoload_register([new \Lib\Core\Autoloader('Framework'), 'load']);
