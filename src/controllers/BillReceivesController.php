<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Src\Models\BillReceive;

$app->get('/bill-receives', function(RequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');

    $repository = $app->service('repository.factory')->factory(BillReceive::class);

    $auth = $app->service('auth');
    $billReceives = $repository->findByField('user_id',$auth->user()->getId());
   
    return $view->render('bill-receives/index.html.twig',[
        'bills' => $billReceives
    ]); 
    
},'bill-receives.index');

$app->get('/bill-receives/create', function(RequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');

    return $view->render('bill-receives/create.html.twig');
    
},'bill-receives.create');

$app->post('/bill-receives/store', function(ServerRequestInterface $request) use ($app) {

    $auth = $app->service('auth');

    //create category
    $data = $request->getParsedBody();
    $data['user_id'] = $auth->user()->getId();

    \Src\Models\BillReceive::create($data);
 
    return $app->redirect('/bill-receives');
},'bill-receives.store');

$app->get('/bill-receives/{id}/edit', function(ServerRequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');

    $id = $request->getAttribute('id');
    $billReceive =  \Src\Models\BillReceive::find($id);

    return $view->render('bill-receives/edit.html.twig',[
        'bill' => $billReceive
    ]); 
},'bill-receives.edit');

$app->post('/bill-receives/{id}/update', function(ServerRequestInterface $request) use ($app) {

    $auth = $app->service('auth');

    $id = $request->getAttribute('id');
    $data = $request->getParsedBody(); //update category
    $data['user_id'] = $auth->user()->getId();

    $billReceive =  \Src\Models\BillReceive::findOrFail($id);
    $billReceive->update($data);

    return $app->redirect('/bill-receives');

},'bill-receives.update');

$app->get('/bill-receives/{id}/destroy', function(ServerRequestInterface $request) use ($app) {

    $id = $request->getAttribute('id');

    $billReceive =  \Src\Models\BillReceive::findOrFail($id);
    $billReceive->delete();

    return $app->redirect('/bill-receives');

},'bill-receives.destroy');