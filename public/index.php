<?php

use Src\Application;
use Src\Plugins\RoutePlugin;
use Src\ServiceContainer;
use Psr\Http\Message\ResponseInterface;

require_once __DIR__ . '/../vendor/autoload.php';


$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);


$app->plugin(new RoutePlugin());


$app->get('/', function() {
    
    echo "teste coreção rota home.";
});

$app->get('/teste', function() {
    
    echo "teste coreção rota teste.";
});


$app->start();