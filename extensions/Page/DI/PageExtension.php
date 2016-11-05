<?php

namespace Page\DI;

use Kdyby\Doctrine\DI\IEntityProvider;
use Libs\DI\CompilerExtension;
use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;

class PageExtension extends CompilerExtension implements IEntityProvider
{
    public function loadConfiguration()
    {
        $this->addConfig(__DIR__ . '/config.neon');
    }

    public function beforeCompile()
    {
        $this->addPresenterMapping(['Page' => 'Page\\Modules\\*\\Presenters\\*Presenter']);
        $this->addRouter($this->getRouter());
    }

    /**
     * @return IRouter
     */
    public function getRouter(): IRouter
    {
        $router = new RouteList('Page');
        $router[] = new Route('[<locale=cs cs|en>/][<id>]', [static::M => 'Front', static::P => 'Detail', static::A => 'default']);

        return $router;
    }

    /**
     * @return array
     */
    public function getEntityMappings(): array
    {
        return [
            'Page' => __DIR__ . '/..',
        ];
    }
}