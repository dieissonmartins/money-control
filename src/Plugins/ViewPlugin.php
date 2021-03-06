<?php
declare(strict_types=1);

namespace Src\Plugins;

use Psr\Container\ContainerInterface;
use Src\ServiceContainerInterface;
use Src\View\Twig\TwigGlobals;
use Src\View\ViewRender;

class ViewPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy('twig', function(ContainerInterface $container) {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../templates');
            $twig = new \Twig_Environment($loader);

            $auth = $container->get('auth');

            $generator = $container->get('routing.generator');

            $twig->addExtension(new TwigGlobals($auth));

            $twig->addFunction(new \Twig_SimpleFunction('route',function(string $name, array $params = []) use ($generator) {
                return $generator->generate($name,$params);
            }));

            return $twig;
        });
        
        $container->addLazy('view.render', function (ContainerInterface $container) {
            $twigEnvironment = $container->get('twig');
            
            return new ViewRender($twigEnvironment);
        });
    }
}