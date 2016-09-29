<?php

namespace Auth\Modules\Front\Presenters;

use Auth\Components\Forms\SignInForm\TSignInForm;
use VojtechBartos\Presenters\Presenter;

class SignPresenter extends Presenter
{
    use TSignInForm;

    /**
     * Sign in action
     */
    public function actionIn()
    {
        // if user already logged in then redirect back
        if ($this->getUser()->isLoggedIn()) {
            $this->restoreRequest($this->backlink);
            $this->redirect(':Home:default');
        }
    }
}