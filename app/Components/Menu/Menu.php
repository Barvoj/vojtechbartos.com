<?php

namespace VojtechBartos\Components\Menu;

use Libs\Application\UI\Control;
use Nette\Security\User;

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
        $this->template->username = $this->user->getIdentity()->{'username'};
        parent::render();
    }
}