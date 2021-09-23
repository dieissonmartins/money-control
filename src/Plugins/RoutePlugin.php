<?php
declare(strict_types=1);

namespace Src\Plugins;

use Aura\Router\RouterContainer;
use Cake\Core\ContainerInterface;
use Pimple\Container;
use Psr\Http\Message\RequestInterface;
use Src\ServiceContainerInterface;
use Zend\Diactoros\ServerRequestFactory;

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

        $request = $this->getRequest();

        $container->add('routing', $map);
        $container->add('routing.matcher', $matcher);
        $container->add('routing.generator', $generator);
        $container->add(RequestInterface::class, $request);

        $container->addLazy('route', function (ContainerInterface $container) {
            $matcher = $container->get('routing.matcher');
            $request = $container->get(RequestInterface::class);

            return $matcher->match($request);
        });
    }

    protected function getRequest(): RequestInterface
    {
        return ServerRequestFactory::fromGlobals(
            $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
        );
    }
}