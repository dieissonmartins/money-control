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
    
},'category-costs.index');

$app->get('/category-costs/create', function(RequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');

    return $view->render('category-costs/create.html.twig'); 
    
},'category-costs.create');

$app->post('/category-costs/store', function(ServerRequestInterface $request) use ($app) {
    
    //create category
    $data = $request->getParsedBody();
    \Src\Models\CategoryCost::create($data);
 
    return $app->redirect('/category-costs');
},'category-costs.store');

$app->get('/category-costs/{id}/edit', function(ServerRequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');

    $id = $request->getAttribute('id');
    $categoryCost =  \Src\Models\CategoryCost::find($id);

    return $view->render('category-costs/edit.html.twig',[
        'category' => $categoryCost
    ]); 
},'category-costs.edit');

$app->post('/category-costs/{id}/update', function(ServerRequestInterface $request) use ($app) {

    $id = $request->getAttribute('id');
    $data = $request->getParsedBody(); //update category

    $categoryCost =  \Src\Models\CategoryCost::findOrFail($id);
    $categoryCost->update($data);

    return $app->redirect('/category-costs');

},'category-costs.update');

$app->get('/category-costs/{id}/destroy', function(ServerRequestInterface $request) use ($app) {

    $id = $request->getAttribute('id');
    
    $categoryCost =  \Src\Models\CategoryCost::findOrFail($id);
    $categoryCost->delete();

    return $app->redirect('/category-costs');

},'category-costs.destroy');

$app->start();