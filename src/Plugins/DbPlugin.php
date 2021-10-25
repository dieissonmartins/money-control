<?php

namespace Src\Plugins;

use Src\ServiceContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;


class DbPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $capsule = new Capsule();
        $config = include __DIR__ . '/../../config/db.php';

        $capsule->addConnection($config['development']);

        $capsule->bootEloquent();
        
    }
}