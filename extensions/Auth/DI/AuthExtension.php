<?php

namespace Auth\DI;

use Kdyby\Doctrine\DI\IEntityProvider;
use Libs\DI\CompilerExtension;
use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;

class AuthExtension extends CompilerExtension implements IEntityProvider
{
    public function loadConfiguration()
    {
        $this->addConfig(__DIR__ . '/config.neon');
    }

    public function beforeCompile()
    {
        $this->addPresenterMapping(['Auth' => 'Auth\\Presenters\\*Presenter']);
        $this->addRouter($this->getRouter());
    }

    /**
     * @return IRouter
     */
    public function getRouter() : IRouter
    {
        $router = new RouteList('Auth');
        $router[] = new Route('[<locale=cs cs|en>/]sign/<action>[/<id>]', 'Sign:in');

        return $router;
    }

    public function getEntityMappings() : array
    {
        return [
            'Auth' => __DIR__ . '/..',
        ];
    }
}