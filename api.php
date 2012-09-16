<?php

require_once(__DIR__ . '/zaphpa/zaphpa.lib.php');
require_once(__DIR__ . '/MyController.class.php');
require_once(__DIR__ . '/JsonBodyMiddleware.class.php');


$router = new Zaphpa_Router();
$router->attach('JsonBodyMiddleware');

$router->addRoute(array(
  'path' => '/users',
  'get' => array("MyController", "index")
));

$router->addRoute(array(
  'path' => '/users/{id}',
  'handlers' => array(
    'id' => Zaphpa_Constants::PATTERN_DIGIT, //enforced to be numeric
  ),
  'get' => array('MyController', 'getPage'),
  'post' => array('MyController', 'postPage'),
));

try {

  $router->route();

} catch (Zaphpa_InvalidPathException $ex) {

  header("Content-Type: application/json;", TRUE, 404);
  $out = array("error" => "not found");        
  die(json_encode($out));

}