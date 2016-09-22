<?php

namespace VojtechBartos\Components\Menu;

trait TMenu
{
    /**
     * @param MenuFactory $menuFactory
     * @return Menu
     */
    public function createComponentMenu(MenuFactory $menuFactory) : Menu
    {
        $component = $menuFactory->create();

        return $component;
    }
}