<?php

use Psr\Http\Message\RequestInterface;
use Src\Application;
use Src\Plugins\RoutePlugin;
use Src\ServiceContainer;
use Src\Plugins\ViewPlugin;
use Src\Plugins\DbPlugin;
use Src\Plugins\AuthPlugin;

require_once __DIR__ . '/../vendor/autoload.php';


$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);


$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());
$app->plugin(new DbPlugin());
$app->plugin(new AuthPlugin());


$app->get('/', function(RequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');
   
    return $view->render('layout.html.twig'); 
    
});

require_once(__DIR__ . '/../src/controllers/BillReceivesController.php');
require_once(__DIR__ . '/../src/controllers/CategoryConstsController.php');
require_once(__DIR__ . '/../src/controllers/UserController.php');
require_once(__DIR__ . '/../src/controllers/AuthController.php');

$app->start();