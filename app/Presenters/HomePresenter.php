<?php

namespace VojtechBartos\Presenters;

use Auth\Components\Forms\SignInForm\SignInFormFactory;
use Libs\Modal\Modal;

class HomePresenter extends Presenter
{
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
                $this->restoreRequest($this->backlink);

                if ($this->isAjax()) {
                    $this['menu']->redrawControl();
                    $modal->hide();
                } else {
                    $this->redirect(':Home:default');
                }
            };

            return $form;
        }))->setLinkClose($this->lazyLink('this'));
    }
}