<?php

namespace Auth\Modules\Front\Presenters;

use Auth\Components\Forms\SignInForm\SignInForm;
use Auth\Components\Forms\SignInForm\SignInFormFactory;
use VojtechBartos\Presenters\Presenter;

class SignPresenter extends Presenter
{
    /** @persistent */
    public $backlink;

    /**
     * Sign in action
     */
    public function actionIn()
    {
        // if user already logged in then redirect back
        if ($this->getUser()->isLoggedIn()) {
            $this->redirect(':Home:default');
        }
    }

    /**
     * SignForm factory method.
     * @param SignInFormFactory $signInFormFactory
     * @return SignInForm
     */
    protected function createComponentSignForm(SignInFormFactory $signInFormFactory) : SignInForm
    {
        $form = $signInFormFactory->create();
        $form->onSuccess[] = function () {
            $this->flashMessage($this->translate('messages.sign.you_have_been_signed_in'));
//            $this->restoreRequest($this->backlink);
            $this->redirect(':Home:default');
        };

        return $form;
    }
}