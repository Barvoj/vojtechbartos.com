<?php

namespace Article\DI;

use Kdyby\Doctrine\DI\IEntityProvider;
use Libs\DI\CompilerExtension;
use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;

class ArticleExtension extends CompilerExtension implements IEntityProvider
{
    /** @var array */
    public $defaults = [
        'testName' => 'New test'
    ];

    public function loadConfiguration()
    {
        $this->addConfig(__DIR__ . '/config.neon');
    }

    public function beforeCompile()
    {
        $this->setPresenterMapping(['Article' => 'Article\\Presenters\\*Presenter']);
        $this->setRouter($this->getRouter());
    }

    /**
     * @return IRouter
     */
    public function getRouter() : IRouter
    {
        $public = new RouteList('Article');
        $public[] = new Route('[<locale=cs cs|en>/]article/<action>[/<id>]', 'Article:list');

        return $public;
    }

    public function getEntityMappings() : array
    {
        return [
            'Article' => __DIR__ . '/..',
        ];
    }
}