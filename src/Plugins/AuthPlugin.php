<?php

namespace Src\Plugins;

use Interop\Container\ContainerInterface;
use Src\Auth\JasnyAuth;
use Src\ServiceContainerInterface;
use Src\Auth\Auth;

class AuthPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy('jasny.auth', function (ContainerInterface $container) {
            $serviceUserRepository = $container->get('user.repository');
            return new JasnyAuth($serviceUserRepository);
        });

        $container->addLazy('auth', function (ContainerInterface $container) {
            $serviceJasnyRepository = $container->get('jasny.auth');
            return new Auth($serviceJasnyRepository);
        });
    }
}