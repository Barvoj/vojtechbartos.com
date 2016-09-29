<?php


namespace Auth\Components\Forms\SignInForm;

use Libs\Application\UI\TPresenter;

trait TSignInForm
{
    use TPresenter;

    /** @persistent */
    public $backlink;

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

            $this->restoreRequest($this->backlink);
            $this->redirect(':Home:default');
        };

        return $form;
    }
}