<?php
namespace Libs\UI;


use Nette\Application\UI\Form;
use Nette\Localization\ITranslator;

class FormFactory
{
//    /** @var ITranslator */
//    private $translator;
//
//    /**
//     * FormFactory constructor.
//     * @param ITranslator $translator
//     */
//    public function __construct(ITranslator $translator)
//    {
//        $this->translator = $translator;
//    }

    /**
     * @return Form
     */
    public function create() : Form
    {
        $form = new Form();
//        $form->setTranslator($this->translator);

        return $form;
    }
}