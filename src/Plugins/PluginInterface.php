<?php

namespace Src\Plugins;

use Src\ServiceContainerInterface;

interface PluginInterface
{
    public function register(ServiceContainerInterface $container);
}