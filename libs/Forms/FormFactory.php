<?php
namespace Libs\Forms;

use Nette\Application\UI\Form;

interface FormFactory
{
    /**
     * @return Form
     */
    public function create() : Form;
}