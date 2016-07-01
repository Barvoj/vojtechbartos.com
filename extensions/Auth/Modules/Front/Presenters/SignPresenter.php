<?php

namespace Auth\Modules\Front\Presenters;

use Libs\Application\UI\Presenter;
use Auth\Components\Forms\SignInForm\SignInFormFactory;
use Nette\Application\UI\Form;

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
     * Sign out action
     */
    public function actionOut()
    {
        $this->getUser()->logout();
        $this->flashMessage($this->translate('messages.sign.you_have_been_signed_out'));
        $this->redirect('in');
    }

    /**
     * SignForm factory method.
     * @param SignInFormFactory $signInFormFactory
     * @return Form
     */
    protected function createComponentSignForm(SignInFormFactory $signInFormFactory)
    {
        $form = $signInFormFactory->create();
        $form->onSuccess[] = function () {
            $this->flashMessage($this->translate('messages.sign.you_have_been_signed_in'));
            $this->restoreRequest($this->backlink);
            $this->redirect(':Home:default');
        };

        return $form;
    }
}