<?php

namespace VojtechBartos\Router;

use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;

class RouterFactory
{
    /**
     * @var IRouter[]
     */
    protected $list = [];

    public function add(IRouter $route)
    {
        $this->list[] = $route;
    }

    /**
     * @return IRouter
     */
    public function create() : IRouter
    {
//        Route::$defaultFlags = Route::SECURED;

        $router = new RouteList;

        foreach ($this->list as $route) {
            $router[] = $route;
        }

        $router[] = new Route("[<locale=cs cs|en>/]<presenter>/<action>[/<id>]", ['presenter' => 'Home', 'action' => 'default']);

        return $router;
    }
}