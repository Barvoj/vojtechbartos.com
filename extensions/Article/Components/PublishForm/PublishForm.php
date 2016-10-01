<?php

namespace Article\Components\PublishForm;

use Article\Model\Entities\Article;
use Article\Model\Facades\ArticleFacade;
use Libs\Application\UI\FormControl;
use Nette\Application\UI\Form;
use Nette\Application\UI\Link;
use Nette\Utils\ArrayHash;

/**
 * @method onSuccess(Article $article)
 */
class PublishForm extends FormControl
{


    /** @var array */
    public $onSuccess = [];

    /** @var ArticleFacade */
    protected $articleFacade;

    /** @var Link */
    protected $linkCancel;

    /** @var Article */
    protected $article;

    /**
     * @param Article $article
     * @param ArticleFacade $articleFacade
     */
    public function __construct(Article $article, ArticleFacade $articleFacade)
    {
        parent::__construct();
        $this->article = $article;
        $this->articleFacade = $articleFacade;
    }

    public function render()
    {
        $this->template->linkCancel = $this->linkCancel;
        parent::render();
    }

    /**
     * @return Form
     */
    protected function createComponentForm() : Form
    {
        $form = $this->getInstance();
        $form->getElementPrototype()->addClass('ajax');

        $form->addText('date', 'messages.article.publish_date');
        $form->addSubmit(self::INPUT_SUBMIT, "messages.article.ok");

        $form->onSuccess[] = function (Form $form, $values) {
            $this->processOk($form, $values);
        };

        return $form;
    }

    /**
     * @param Form $form
     * @param ArrayHash $values
     */
    protected function processOk(Form $form, ArrayHash $values)
    {
        $this->articleFacade->publish($this->article);

        $this->onSuccess($this->article);
    }

    /**
     * @param Link $linkCancel
     */
    public function setLinkCancel(Link $linkCancel)
    {
        $this->linkCancel = $linkCancel;
    }
}