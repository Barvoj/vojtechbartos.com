<?php

namespace VojtechBartos\Presenters;

use Libs\Application\UI\Presenter;
use VojtechBartos\Components\Forms\SignInForm\SignInFormFactory;
use Nette\Application\UI\Form;

class SignPresenter extends Presenter
{
    /** @var SignInFormFactory */
    private $signInFormFactory;

    /**
     * SignPresenter constructor.
     * @param SignInFormFactory $signFormFactory
     */
    public function __construct(SignInFormFactory $signFormFactory)
    {
        parent::__construct();
        $this->signInFormFactory = $signFormFactory;
    }

    /**
     * Sign in action
     */
    public function actionIn()
    {
        // if user already logged in then redirect back
        if ($this->getUser()->isLoggedIn()) {
            $this->redirect('Home:default');
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
     * @return Form
     */
    protected function createComponentSignForm()
    {
        $form = $this->signInFormFactory->create();
        $form->onSuccess[] = function () {
            $this->flashMessage($this->translate('messages.sign.you_have_been_signed_in'));
            $this->redirect('Home:default');
        };

        return $form;
    }
}