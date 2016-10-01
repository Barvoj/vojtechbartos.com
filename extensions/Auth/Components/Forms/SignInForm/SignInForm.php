<?php

namespace Auth\Components\Forms\SignInForm;

use Article\Components\ArticleEditForm\SignValues;
use Libs\Application\UI\FormControl;
use Libs\Forms\FormFactory;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\User;

/**
 * @method onSuccess
 */
class SignInForm extends FormControl
{
    const INPUT_USERNAME = 'username';
    const INPUT_PASSWORD = 'password';

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

    /**
     * @return Form
     */
    public function createComponentForm() : Form
    {
        $form = $this->formFactory->create();
        $form->getElementPrototype()->addClass('ajax');

        $form->addText(self::INPUT_USERNAME, "messages.sign.username")
            ->setAttribute("autocomplete", "off")
            ->setAttribute("placeholder", "messages.sign.username")
            ->setRequired()
            ->addRule(Form::MIN_LENGTH, null, 3);

        $form->addPassword(self::INPUT_PASSWORD, "messages.sign.password")
            ->setAttribute("autocomplete", "off")
            ->setAttribute("placeholder", "messages.sign.password")
            ->setRequired();

        $form->addSubmit(self::INPUT_SUBMIT, "messages.sign.sign_in");

        $form->onSuccess[] = function(Form $form, $values) {
            $this->formSucceeded($form, new SignValues($values));
        };

        return $form;
    }

    /**
     * Callback on form success
     * @param Form $form
     * @param SignValues $values
     */
    private function formSucceeded(Form $form, SignValues $values)
    {
        try {
            $this->user->login($values->username, $values->password);
        } catch (AuthenticationException $ex) {
            $form->addError("messages.sign.wrong_username_or_password");

            return;
        }

        $this->onSuccess();
    }
}