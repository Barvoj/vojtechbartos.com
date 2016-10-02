<?php

namespace VojtechBartos\Components\Menu;

use Auth\User;
use Libs\Application\UI\Control;

class Menu extends Control
{
    /** @var User */
    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    public function render()
    {
        $this->template->isLoggedIn = $this->user->isLoggedIn();
        $this->template->username = $this->user->getUsername();
        $this->template->name = $this->user->getName();
        parent::render();
    }
}