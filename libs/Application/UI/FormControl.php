<?php

namespace Libs\Application\UI;

use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class FormControl extends Control
{
    /** @var FormFactory */
    private $formFactory;

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
    protected function createForm() : Form
    {
        return $this->formFactory->create();
    }
}