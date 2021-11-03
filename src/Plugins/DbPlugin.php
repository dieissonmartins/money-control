<?php

namespace Src\Plugins;

use Src\ServiceContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Repository\RepositoryFactory;

class DbPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $capsule = new Capsule();
        $config = include __DIR__ . '/../../config/db.php';

        $capsule->addConnection($config['development']);

        $capsule->bootEloquent();

        $container->add('repository.factory', new RepositoryFactory());
        
    }
}