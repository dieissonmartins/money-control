<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Src\Models\CategoryCost;

$app->get('/category-costs', function(RequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');

    $repository = $app->service('repository.factory')->factory(CategoryCost::class);

    $auth = $app->service('auth');
    $categoryCosts = $repository->findByField('user_id',$auth->user()->getId());
   
    return $view->render('category-costs/index.html.twig',[
        'categories' => $categoryCosts
    ]); 
    
},'category-costs.index');

$app->get('/category-costs/create', function(RequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');

    return $view->render('category-costs/create.html.twig'); 
    
},'category-costs.create');

$app->post('/category-costs/store', function(ServerRequestInterface $request) use ($app) {

    $auth = $app->service('auth');

    //create category
    $data = $request->getParsedBody();
    $data['user_id'] = $auth->user()->getId();

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

    $auth = $app->service('auth');

    $id = $request->getAttribute('id');
    $data = $request->getParsedBody(); //update category
    $data['user_id'] = $auth->user()->getId();

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