<?php

namespace Src\View\Twig;

use Src\Auth\AuthInterface;

class TwigGlobals extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    private AuthInterface $auth;

    public function __construct(AuthInterface $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @return AuthInterface[]
     */
    public function getGlobals(): array
    {
       $ret = [
           'Auth' => $this->auth
       ];

       return $ret;
    }
}