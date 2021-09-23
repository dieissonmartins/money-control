<?php

namespace Src;

use Src\Plugins\PluginInterface;

class Application
{
    private $serviceContainer;

    public function __construct(ServiceContainerInterface $serviceContainer)
    {
        $this->serviceContainer = $serviceContainer;
    }

    public function service($name)
    {
        return $this->serviceContainer->get($name);
    }

    public function addService(string $name, $service): void
    {
        if (is_callable($service)) {

            $this->serviceContainer->addLazy($name, $service);
        } else {

            $this->serviceContainer->add($name, $service);
        }
    }

    public function plugin(PluginInterface $plugin): void
    {
        $plugin->register($this->serviceContainer);
    }

    public function get($path, $action, $name = null): Application
    {
        $routing = $this->service('routing');
        $routing->get($name,$path,$action);

        return $this;
    }

    public function start(){


        $route = $this->service('route');
        $callable = $route->handler;
        $callable();
    }
}