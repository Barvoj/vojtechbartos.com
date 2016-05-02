<?php

namespace App\AdminModule\Presenters;

use VojtechBartos\Components\Forms\SignInForm\SignInFormFactory;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;

class SignPresenter extends Presenter
{

    /** @persistent */
    public $backlink = '';

    /** @var SignInFormFactory */
    public $signInFormFactory;

    /**
     * SignPresenter constructor.
     * @param SignInFormFactory $signFormFactory
     */
    public function __construct(SignInFormFactory $signFormFactory)
    {
        $this->signInFormFactory = $signFormFactory;
    }

    /**
     * Sign in action
     */
    public function actionIn()
    {
        // if user already logged in then redirect back
        if ($this->getUser()->isLoggedIn()) {
            $this->redirectBack();
        }
    }

    /**
     * Sign out action
     */
    public function actionOut()
    {
        $this->getUser()->logout();
        $this->flashMessage($this->translate('admin.sign.you_have_been_signed_out'));
        $this->redirect('in');
    }

    /**
     * Redirects user to previous page or homepage
     */
    private function redirectBack()
    {
        // try redirect to previous page
        $this->restoreRequest($this->backlink);
        // else redirect to homepage
        $this->redirect(":Admin:Home:default");
    }

    /**
     * SignForm factory method.
     * @return Form
     */
    protected function createComponentSignForm()
    {
        $form = $this->signInFormFactory->create();
        $form->onSuccess[] = function () {
            $this->flashMessage($this->translate('admin.sign.you_have_been_signed_in'));
            $this->redirectBack();
        };

        return $form;
    }
}