<?php

namespace Src\Plugins;

use Aura\Router\RouterContainer;
use Src\ServiceContainerInterface;

class RoutePlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $routerContainer = new RouterContainer();

        /* register routes */
        $map = $routerContainer->getMap();

        /* identify router access */
        $matcher = $routerContainer->getMatcher();

        /* generate link by base router registered  */
        $generator = $routerContainer->getGenerator();

        $container->add('routing', $map);
        $container->add('routing.matcher', $matcher);
    }
}