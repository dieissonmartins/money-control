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
   
    return $view->render('layout.html.twig'); 
    
});

$app->get('/category-costs', function(RequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');
   
    return $view->render('category-costs/index.html.twig'); 
    
});

$app->start();