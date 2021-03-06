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
        $this->addPresenterMapping(['Article' => 'Article\\Modules\\*\\Presenters\\*Presenter']);
        $this->addRouter($this->getRouter());
    }

    /**
     * @return IRouter
     */
    public function getRouter() : IRouter
    {
        $router = new RouteList('Article');
        $router[] = new Route('[<locale=cs cs|en>/]article/<presenter>[/<id>]', [static::M => 'Front', static::P => 'List', static::A =>'default']);
        $router[] = new Route('[<locale=cs cs|en>/]user/article/<presenter>[/<id>]', [static::M => 'User', static::P => 'List', static::A => 'default']);

        return $router;
    }

    /**
     * @return array
     */
    public function getEntityMappings() : array
    {
        return [
            'Article' => __DIR__ . '/..',
        ];
    }
}