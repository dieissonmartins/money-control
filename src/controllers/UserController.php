<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Src\Models\User;

$app->get('/users', function(RequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');

    $repository = $app->service('repository.factory')->factory(User::class);

    $users = $repository->all();
   
    return $view->render('users/index.html.twig',[
        'users' => $users
    ]); 
    
},'users.index');

$app->get('/users/create', function(RequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');

    return $view->render('users/create.html.twig'); 
    
},'users.create');

$app->post('/users/store', function(ServerRequestInterface $request) use ($app) {
    
    //create user
    $data = $request->getParsedBody();

    $repository = $app->service('user.repository');
    $auth = $app->service('auth');
    $data['password'] = $auth->hashPassword($data['password']);
    $repository->create($data);
    
    // \Src\Models\User::create($data);
 
    return $app->redirect('/users');
},'users.store');

$app->get('/users/{id}/edit', function(ServerRequestInterface $request) use ($app) {
    
    $view = $app->service('view.render');

    $id = $request->getAttribute('id');
    $user =  \Src\Models\User::find($id);

    return $view->render('users/edit.html.twig',[
        'user' => $user
    ]); 
},'users.edit');

$app->post('/users/{id}/update', function(ServerRequestInterface $request) use ($app) {

    $id = $request->getAttribute('id');
    $data = $request->getParsedBody(); //update user

    $user =  \Src\Models\User::findOrFail($id);
    $user->update($data);

    return $app->redirect('/users');

},'users.update');

$app->get('/users/{id}/destroy', function(ServerRequestInterface $request) use ($app) {

    $id = $request->getAttribute('id');
    
    $user =  \Src\Models\User::findOrFail($id);
    $user->delete();

    return $app->redirect('/users');

},'users.destroy');