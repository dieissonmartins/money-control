<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Src\Models\BillPay;
use Src\Models\CategoryCost;

$app->get('/bill-pays', function(RequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');

    $repository = $app->service('repository.factory')->factory(BillPay::class);

    $auth = $app->service('auth');
    $billPays = $repository->findByField('user_id',$auth->user()->getId());
   
    return $view->render('bill-pays/index.html.twig',[
        'bills' => $billPays
    ]); 
    
},'bill-pays.index');

$app->get('/bill-pays/create', function(RequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');

    $repository = $app->service('repository.factory')->factory(CategoryCost::class);
    $auth = $app->service('auth');
    $categories = $repository->findByField('user_id',$auth->user()->getId());

    return $view->render('bill-pays/create.html.twig',[
        'categories' => $categories
    ]);
    
},'bill-pays.create');

$app->post('/bill-pays/store', function(ServerRequestInterface $request) use ($app) {

    $auth = $app->service('auth');

    //create category
    $data = $request->getParsedBody();
    $data['user_id'] = $auth->user()->getId();

    \Src\Models\BillPay::create($data);
 
    return $app->redirect('/bill-pays');
},'bill-pays.store');

$app->get('/bill-pays/{id}/edit', function(ServerRequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');

    $id = $request->getAttribute('id');
    $billReceive =  \Src\Models\BillPay::find($id);

    $repository = $app->service('repository.factory')->factory(CategoryCost::class);
    $auth = $app->service('auth');
    $categories = $repository->findByField('user_id',$auth->user()->getId());

    return $view->render('bill-pays/edit.html.twig',[
        'bill' => $billReceive,
        'categories' => $categories
    ]); 
},'bill-pays.edit');

$app->post('/bill-pays/{id}/update', function(ServerRequestInterface $request) use ($app) {

    $auth = $app->service('auth');

    $id = $request->getAttribute('id');
    $data = $request->getParsedBody(); //update category
    $data['user_id'] = $auth->user()->getId();

    $billReceive =  \Src\Models\BillPay::findOrFail($id);
    $billReceive->update($data);

    return $app->redirect('/bill-pays');

},'bill-pays.update');

$app->get('/bill-pays/{id}/destroy', function(ServerRequestInterface $request) use ($app) {

    $id = $request->getAttribute('id');

    $billReceive =  \Src\Models\BillPay::findOrFail($id);
    $billReceive->delete();

    return $app->redirect('/bill-pays');

},'bill-pays.destroy');