<?php

namespace Src\Plugins;

use Src\Auth\JasnyAuth;
use Src\ServiceContainerInterface;
use Src\Auth\Auth;

class AuthPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy('jasny.auth', function ($container) {
            $serviceUserRepository = $container->get('user.repository');
            return new JasnyAuth($serviceUserRepository);
        });

        $container->addLazy('auth', function ($container) {
            $serviceJasnyRepository = $container->get('jasny.repository');
            return new Auth($serviceJasnyRepository);
        });
    }
}