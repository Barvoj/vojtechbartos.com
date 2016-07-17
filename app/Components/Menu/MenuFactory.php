<?php

namespace VojtechBartos\Components\Menu;

interface MenuFactory
{
    /**
     * @return Menu
     */
    public function create() : Menu;
}