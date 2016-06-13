<?php

namespace Libs\Forms\Rendering;


use Nette\Forms\Controls\Button;
use Nette\Forms\Controls\Checkbox;
use Nette\Forms\Controls\CheckboxList;
use Nette\Forms\Controls\MultiSelectBox;
use Nette\Forms\Controls\RadioList;
use Nette\Forms\Controls\SelectBox;
use Nette\Forms\Controls\TextBase;
use Nette\Forms\Form;
use Nette\Forms\IFormRenderer;
use Nette\Forms\Rendering\DefaultFormRenderer;
use Nette\Object;

class BootstrapFormRenderer extends Object implements IFormRenderer
{
    /** @var DefaultFormRenderer */
    protected $renderer;

    /**
     * @param DefaultFormRenderer $renderer
     */
    public function __construct(DefaultFormRenderer $renderer)
    {
        $this->renderer = $renderer;

        $this->renderer->wrappers['controls']['container'] = NULL;
        $this->renderer->wrappers['pair']['container'] = 'div class=form-group';
        $this->renderer->wrappers['pair']['.error'] = 'has-error';
        $this->renderer->wrappers['control']['container'] = 'div class=col-sm-9';
        $this->renderer->wrappers['label']['container'] = 'div class="col-sm-3 control-label"';
        $this->renderer->wrappers['control']['description'] = 'span class=help-block';
        $this->renderer->wrappers['control']['errorcontainer'] = 'span class=help-block';
    }

    /**
     * @return IFormRenderer
     */
    public static function create() : IFormRenderer
    {
        return new BootstrapFormRenderer(new DefaultFormRenderer());
    }

    /**
     * @param Form $form
     * @return string
     */
    function render(Form $form)
    {
        foreach ($form->getControls() as $control) {
            if ($control instanceof Button) {
                $control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-default');
                $usedPrimary = TRUE;
            } elseif ($control instanceof TextBase || $control instanceof SelectBox || $control instanceof MultiSelectBox) {
                $control->getControlPrototype()->addClass('form-control');
            } elseif ($control instanceof Checkbox || $control instanceof CheckboxList || $control instanceof RadioList) {
                $control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
            }
        }

        return $this->renderer->render($form);
    }
}