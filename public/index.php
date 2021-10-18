<?php

use Src\Application;
use Src\Plugins\RoutePlugin;
use Src\ServiceContainer;

require_once __DIR__ . '/../vendor/autoload.php';


$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);


$app->plugin(new RoutePlugin());


$app->get('/teste', function () {
    echo "Home router start";
});

$app->start();