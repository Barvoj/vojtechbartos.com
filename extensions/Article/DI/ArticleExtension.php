<?php

namespace Article\DI;

use Kdyby\Doctrine\DI\IEntityProvider;
use Libs\DI\CompilerExtension;
use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;

class ArticleExtension extends CompilerExtension implements IEntityProvider
{
    public function loadConfiguration()
    {
        $this->addConfig(__DIR__ . '/config.neon');
    }

    public function beforeCompile()
    {
        $this->addPresenterMapping(['Article' => 'Article\\Presenters\\*Presenter']);
        $this->addRouter($this->getRouter());
    }

    /**
     * @return IRouter
     */
    public function getRouter() : IRouter
    {
        $rourer = new RouteList('Article');
        $rourer[] = new Route('[<locale=cs cs|en>/]article/<action>[/<id>]', 'Article:list');

        return $rourer;
    }

    public function getEntityMappings() : array
    {
        return [
            'Article' => __DIR__ . '/..',
        ];
    }
}