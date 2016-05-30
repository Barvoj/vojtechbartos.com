<?php

namespace Libs\DI;

use Nette\Application\IPresenterFactory;
use Nette\Application\IRouter;

class CompilerExtension extends \Nette\DI\CompilerExtension
{
    /**
     * @param string $file
     */
    public function addConfig(string $file)
    {
        $builder = $this->getContainerBuilder();
        $config = $this->loadFromFile($file);
        $this->compiler->parseServices($builder, $config);
    }

    /**
     * @param IRouter $router
     */
    protected function addRouter(IRouter $router)
    {
        $builder = $this->getContainerBuilder();

        $builder->getDefinition('router.factory')
            ->addSetup('add', [$router]);
    }

    /**
     * @param array $mapping
     */
    protected function addPresenterMapping(array $mapping)
    {
        $builder = $this->getContainerBuilder();

        $builder
            ->getDefinition($builder->getByType(IPresenterFactory::class) ?: 'nette.presenterFactory')
            ->addSetup('setMapping', [$mapping]);
    }
}