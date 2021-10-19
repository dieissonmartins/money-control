<?php

use Psr\Http\Message\RequestInterface;
use Src\Application;
use Src\Plugins\RoutePlugin;
use Src\ServiceContainer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

require_once __DIR__ . '/../vendor/autoload.php';


$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);


$app->plugin(new RoutePlugin());


$app->get('/', function(RequestInterface $request) {
    
    var_dump($request->getUri());
    die();
    
});

$app->get('/home/{name}', function(ServerRequestInterface $request) {
    
    var_dump($request->getAttribute('name'));
    die();
});


$app->start();