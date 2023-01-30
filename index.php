<?php

// Fazendo a inclusão do autoload ao arquivo raiz da aplicação.
require_once __DIR__."/autoload.php";

/* 
** As Classes devem ser instanciadas fazendo uso dos seus namespaces
** Caso a classe não seja encontrada será lançado um erro!
*/

/* 
** exemplo 1 **

use \Lib\Core\Route;

$route = new Route();

*/

/* exemplo 2 */

$route = new \Lib\Core\Route();






