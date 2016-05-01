<?php

namespace VojtechBartos\Router;

use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;

class RouterFactory
{

    /**
     * @return IRouter
     */
    public static function createRouter()
    {
//        Route::$defaultFlags = Route::SECURED;

        $router = new RouteList;

        $router[] = new Route("<presenter>/<action>[/<id>]", ['presenter' => 'Home', 'action' => 'default']);

        return $router;
    }
}