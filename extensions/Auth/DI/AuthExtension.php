<?php

namespace Auth\DI;

use Kdyby\Doctrine\DI\IEntityProvider;
use Libs\DI\CompilerExtension;
use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;

class AuthExtension extends CompilerExtension implements IEntityProvider
{
    const M = 'module';
    const P = 'presenter';
    const A = 'action';

    public function loadConfiguration()
    {
        $this->addConfig(__DIR__ . '/config.neon');
    }

    public function beforeCompile()
    {
        $this->addPresenterMapping(['Auth' => 'Auth\\Modules\\*\\Presenters\\*Presenter']);
        $this->addRouter($this->getRouter());
    }

    /**
     * @return IRouter
     */
    public function getRouter() : IRouter
    {
        $router = new RouteList('Auth');
        $router[] = new Route('[<locale=cs cs|en>/]sign/<action>[/<id>]', [static::M => 'Front', static::P => 'Sign', static::A =>'in']);

        return $router;
    }

    public function getEntityMappings() : array
    {
        return [
            'Auth' => __DIR__ . '/..',
        ];
    }
}