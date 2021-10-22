<?php

use Psr\Http\Message\RequestInterface;
use Src\Application;
use Src\Plugins\RoutePlugin;
use Src\ServiceContainer;
use Src\Plugins\ViewPlugin;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

require_once __DIR__ . '/../vendor/autoload.php';


$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);


$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());


$app->get('/', function(RequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');
   
    return $view->render('teste.html.twig', [
        'name' => 'Dieison Martins'
    ]); 
    
});

$app->get('/home/{name}', function(ServerRequestInterface $request) {
    
    $response = new Response();
    
    $response
        ->getBody()
        ->write("response");

    return $response;

});


$app->start();