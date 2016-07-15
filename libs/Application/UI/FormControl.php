<?php

namespace Libs\Application\UI;

use Libs\Forms\FormFactory;
use Nette\Application\UI\Form;

class FormControl extends Control
{
    const INPUT_SUBMIT = 'submit';

    /** @var FormFactory */
    private $formFactory;

    /** @var Form */
    private $form;

    /**
     * @param FormFactory $formFactory
     */
    public function injectFormFactory(FormFactory $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * @return Form
     */
    protected function getInstance() : Form
    {
        if (!$this->form) {
            $this->form = $this->createForm();
        }

        return $this->form;
    }

    /**
     * @return Form
     */
    protected function createForm() : Form
    {
        return $this->formFactory->create();
    }
}