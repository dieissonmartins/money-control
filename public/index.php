<?php

use Psr\Http\Message\RequestInterface;
use Src\Application;
use Src\Plugins\RoutePlugin;
use Src\ServiceContainer;
use Src\Plugins\ViewPlugin;
use Psr\Http\Message\ServerRequestInterface;
use Src\Plugins\DbPlugin;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;

require_once __DIR__ . '/../vendor/autoload.php';


$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);


$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());
$app->plugin(new DbPlugin());


$app->get('/', function(RequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');
   
    return $view->render('layout.html.twig'); 
    
});

$app->get('/category-costs', function(RequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');

    $model = new \Src\Models\CategoryCost();
    $categoryCosts = $model->all();
   
    return $view->render('category-costs/index.html.twig',[
        'categories' => $categoryCosts
    ]); 
    
});

$app->get('/category-costs/create', function(RequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');

    return $view->render('category-costs/create.html.twig'); 
    
});

$app->post('/category-costs/store', function(ServerRequestInterface $request) use ($app) {
    
    //create category
    $data = $request->getParsedBody();
    \Src\Models\CategoryCost::create($data);
 
    return $app->redirect('/category-costs');
 });

$app->start();