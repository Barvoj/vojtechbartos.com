<?php

namespace VojtechBartos\Components\Menu;

trait TMenu
{
    /** @var MenuFactory */
    public $menuFactory;

    /**
     * @param MenuFactory $menuFactory
     */
    public function injectMenuFactory(MenuFactory $menuFactory)
    {
        $this->menuFactory = $menuFactory;
    }

    /**
     * @return Menu
     */
    public function createComponentMenu() : Menu
    {
        $component = $this->menuFactory->create();

        return $component;
    }
}