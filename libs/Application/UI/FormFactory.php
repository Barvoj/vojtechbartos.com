<?php
namespace Libs\Application\UI;

use Nette\Application\UI\Form;

interface FormFactory
{
    /**
     * @return Form
     */
    public function create() : Form;
}