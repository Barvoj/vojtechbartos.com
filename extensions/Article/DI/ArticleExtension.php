<?php

namespace Article\DI;

use Kdyby\Doctrine\DI\IEntityProvider;
use Libs\DI\CompilerExtension;
use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;

class ArticleExtension extends CompilerExtension implements IEntityProvider
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
        $this->addPresenterMapping(['Article' => 'Article\\*Module\\Presenters\\*Presenter']);
        $this->addRouter($this->getRouter());
    }

    /**
     * @return IRouter
     */
    public function getRouter() : IRouter
    {
        $router = new RouteList('Article');
        $router[] = new Route('[<locale=cs cs|en>/]article/<presenter>[/<id>]', [static::M => 'Front', static::P => 'List', static::A =>'default']);
        $router[] = new Route('[<locale=cs cs|en>/]admin/article/<presenter>[/<id>]', [static::M => 'Admin', static::P => 'List', static::A =>'default']);

        return $router;
    }

    public function getEntityMappings() : array
    {
        return [
            'Article' => __DIR__ . '/..',
        ];
    }
}