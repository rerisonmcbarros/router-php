<?php

// Fazendo a inclusão do autoload ao arquivo raiz da aplicação.
require_once __DIR__."/autoload.php";

/**
 * O nome do diretório raiz do projeto deve er passado como parâmetro no construtor da classe
 * ex: new \Lib\Core\Request("Framework");
 **/
$request = new \Lib\Core\Request("Framework");

/**
 * A instância da Classe 'Route' espera dois parâmetros em seu método construtor,
 * O primeiro parâmetro é uma instancia da classe 'Request',
 * O segundo parâmetro é uma string do separador de identificação do Nome da Classe a ser chamada na rota e seu respectivo metódo,
 * O segundo parâmetro não é obrigátório, e caso não seja passado, será automaticamente definido como '::'
 **/
$route = new \Lib\Core\Route($request, "::");

/**
 * As Rotas devem ser definidas chamando o método da Classe 'Route' que especifica o nome do verbo HTTP usado na rota,
 * os métodos de definição de rota esperam dois parâmetros, o primeiro é uma string com o padrão da rota, e o segundo é uma 
 * string com o nome da Classe a ser chamada o separador de identificação e o nome do método da Classe que será executado.
**/
//Exemplo de definição de rotas 
$route->get("/", "\Lib\Core\Controller::method");
$route->post("/", "\Lib\Core\Controller::method");

/**
 * Caso seja passado parâmetros na string que define a rota, estes devem ser passados entre chaves ex:'{parâmetro}'
 **/
//Exemplo de definição de rotas
$route->get("/page/{id}/show", "\Lib\Core\Controller::method");
$route->post("/page/{id}/show", "\Lib\Core\Controller::method");

/**
 * Metódo que executa a ação chamada caso uma rota seja encontrada
 * Este metódo deve ser chamado após a definição de todas as rotas da aplicação
 **/
$route->dispatch();




