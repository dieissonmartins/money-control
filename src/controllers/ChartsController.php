<?php

use Psr\Http\Message\ServerRequestInterface;
use Src\Models\CategoryCost;


$app
    ->get(
        '/charts', function (ServerRequestInterface $request) use ($app) {
        $view = $app->service('view.render');

        $repository = $app->service('repository.factory')->factory(CategoryCost::class);

        $auth = $app->service('auth');
        $data = $request->getQueryParams();

        $dateStart = $data['date_start'] ?? (new \DateTime())->modify('-1 month');
        $dateStart = $dateStart instanceof \DateTime ? $dateStart->format('Y-m-d')
            : \DateTime::createFromFormat('d/m/Y', $dateStart)->format('Y-m-d');

        $dateEnd = $data['date_end'] ?? new \DateTime();
        $dateEnd = $dateEnd instanceof \DateTime ? $dateEnd->format('Y-m-d')
            : \DateTime::createFromFormat('d/m/Y', $dateEnd)->format('Y-m-d');

        $categories = $repository->findByField('user_id',$auth->user()->getId());

        return $view->render(
            'charts.html.twig', [
                'categories' => $categories
            ]
        );
    }, 'charts.index'
    );