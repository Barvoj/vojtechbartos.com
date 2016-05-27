<?php

namespace Article\Components\ArticleAddForm;

use Article\Model\Entities\Article;
use Article\Model\Facades\ArticleFacade;
use Libs\Application\UI\FormControl;
use Nette\Application\UI\Form;

/**
 * @method onSuccess(Article $article)
 */
class ArticleAddForm extends FormControl
{
    public $onSuccess = [];

    /** @var ArticleFacade */
    protected $articleFacade;

    /**
     * ArticleAddForm constructor.
     * @param ArticleFacade $articleFacade
     */
    public function __construct(ArticleFacade $articleFacade)
    {
        parent::__construct();
        $this->articleFacade = $articleFacade;
    }


    public function render()
    {
        $this->getTemplate()->setFile(__DIR__ . '/ArticleAddForm.latte');
        $this->getTemplate()->render();
    }

    /**
     * @return Form
     */
    public function createComponentForm() : Form
    {
        $form = $this->createForm();

        $form->addText("title", "messages.article.title")
            ->setAttribute("autocomplete", "off")
            ->setAttribute("placeholder", "messages.article.title")
            ->setRequired();

        $form->addTextArea("content", "messages.article.content")
            ->setAttribute("autocomplete", "off")
            ->setAttribute("placeholder", "messages.article.content")
            ->setRequired();

        $form->addSubmit("submit", "messages.article.save");

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
        $article = new Article();
        $article->setTitle($values['title'])
            ->setContent($values['content'])
            ->setUserId(1);

        $this->articleFacade->insert($article);

        $this->onSuccess($article);
    }
}