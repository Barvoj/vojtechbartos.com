<?php

namespace Article\Components\ArticleForm;

use Article\Model\Entities\Article;
use Libs\Application\UI\FormControl;
use Nette\Application\UI\Form;
use Nette\Forms\Controls\TextArea;
use Nette\Forms\Controls\TextInput;

/**
 * @method onSuccess(Article $article)
 */
abstract class ArticleForm extends FormControl
{
    const INPUT_TITLE = 'title';
    const INPUT_CONTENT = 'content';

    public $onSuccess = [];

    /**
     * @return TextInput
     */
    public function addTitle() : TextInput
    {
        return $this->getInstance()->addText(self::INPUT_TITLE, "messages.article.title")
            ->setAttribute("autocomplete", "off")
            ->setAttribute("placeholder", "messages.article.title")
            ->setRequired();
    }

    /**
     * @return TextArea
     */
    public function addContent() : TextArea
    {
        return $this->getInstance()->addTextArea(self::INPUT_CONTENT, "messages.article.content")
            ->setAttribute("autocomplete", "off")
            ->setAttribute("placeholder", "messages.article.content")
            ->setRequired();
    }

    /**
     * @return Form
     */
    protected function createComponentForm() : Form
    {
        $form = $this->getInstance();
        $form->getElementPrototype()->addClass('ajax');

        $form->addSubmit(self::INPUT_SUBMIT, "messages.form.save");

        $form->onSuccess[] = function(Form $form, $values) {
            $this->formSucceeded($form, new ArticleValues($values));
        };

        return $form;
    }

    /**
     * @param Form $form
     * @param ArticleValues $values
     */
    protected abstract function formSucceeded(Form $form, ArticleValues $values);
}