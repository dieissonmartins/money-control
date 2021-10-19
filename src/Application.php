<?php
declare(strict_types=1);

namespace Src;

use Src\Plugins\PluginInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\Response\SapiEmitter;

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
        
        if(!$route) {
            echo "Page not found";
            exit;
        }


        /** @var ServerRequestInterface $request */
        $request = $this->service(RequestInterface::class);

        foreach($route->attributes as $key => $value) {
            $request = $request->withAttribute($key,$value);
        }

        $callable = $route->handler;
        $response = $callable($request);

        $this->emitResponse($response);
    }

    protected function emitResponse(ResponseInterface $response) {

        // Sapi - Server API - Server Applicartion Promma Interface
        $emitter = new SapiEmitter();
        $emitter->emit($response);
    }
}