<?php

namespace Src\Plugins;

use Src\ServiceContainerInterface;
use Src\Auth\Auth;

class AuthPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        
        $container->addLazy('auth', function ($container) {     
          return new Auth();
        });
    }
}