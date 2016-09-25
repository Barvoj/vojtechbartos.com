<?php


namespace Auth\Components\Forms\SignInForm;


use Libs\Application\UI\TPresenter;
use Libs\Modal\Modal;

trait TSignInForm
{
    use TPresenter;

    /** @persistent */
    public $backlink;

    /**
     * SignForm factory method.
     * @param SignInFormFactory $signInFormFactory
     * @return Modal
     */
    protected function createComponentSignForm(SignInFormFactory $signInFormFactory) : Modal
    {
        return (new Modal(function (Modal $modal) use ($signInFormFactory) {
            $form = $signInFormFactory->create();
            $form->onSuccess[] = function () use ($modal) {
                $this->flashMessage($this->translate('messages.sign.you_have_been_signed_in'));
//                $this->restoreRequest($this->backlink);

                $this->redirectAfterSignIn();
            };

            return $form;
        }))->setLinkClose($this->lazyLink('this'));
    }

    protected function redirectAfterSignIn()
    {
        $this->redirect('this');
    }
}