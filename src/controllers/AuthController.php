<?php

use Psr\Http\Message\ServerRequestInterface;

$app->get('/login', function () use ($app) {
    $view = $app->service('view.render');
    return $view->render('auth/login.html.twig');
}, 'auth.show_login_form');


$app->post('/login', function (ServerRequestInterface $request) use ($app) {

    $view = $app->service('view.render');
    $auth = $app->service('auth');
    $data = $request->getParsedBody();
    $result = $auth->login($data);

    if (!$result) {
        return $view->render('auth/login.html.twig');
    }

    return $app->redirect('/category-costs');

}, 'auth.login');

/*
$app->get(
    '/logout', function () use ($app) {
        $app->service('auth')->logout();
        return $app->route('auth.show_login_form');
    }, 'auth.logout'
);*/