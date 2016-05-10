<?php

namespace VojtechBartos\Components\Forms\SignInForm;

use Libs\Application\UI\FormFactory;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\User;

/**
 * @method onSuccess
 */
class SignInForm extends Control
{
    /** @var User */
    private $user;

    /** @var FormFactory */
    private $formFactory;

    /** @var array */
    public $onSuccess = [];

    /**
     * @param User $user
     * @param FormFactory $formFactory
     */
    public function __construct(User $user, FormFactory $formFactory)
    {
        parent::__construct();
        $this->user = $user;
        $this->formFactory = $formFactory;
    }

    public function render()
    {
        $this->getTemplate()->setFile(__DIR__ . '/SignInForm.latte');
        $this->getTemplate()->render();
    }

    /**
     * @return Form
     */
    public function createComponentForm() : Form
    {
        $form = $this->formFactory->create();

        $form->addText("username", "messages.sign.username")
            ->setAttribute("autocomplete", "off")
            ->setAttribute("placeholder", "messages.sign.username")
            ->setRequired()
            ->addRule(Form::MIN_LENGTH, null, 3);

        $form->addPassword("password", "messages.sign.password")
            ->setAttribute("autocomplete", "off")
            ->setAttribute("placeholder", "messages.sign.password")
            ->setRequired();

        $form->addSubmit("submit", "messages.sign.sign_in");

        $form->onSuccess[] = function(Form $form, $values) {
            $this->formSucceeded($form, $values);
        };

        return $form;
    }

    /**
     * Callback on form success
     * @param Form $form
     * @param $values
     */
    private function formSucceeded(Form $form, $values)
    {
        try {
            $this->user->login($values->username, $values->password);
        } catch (AuthenticationException $ex) {
            $form->addError($this->translator->translate("admin.sign.wrong_username_or_password"));

            return;
        }

        $this->onSuccess();
    }
}