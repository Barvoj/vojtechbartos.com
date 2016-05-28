<?php

namespace Article\Components\ArticleEditForm;


use Article\Model\Entities\Article;
use Article\Model\Facades\ArticleFacade;
use Libs\Application\UI\FormControl;
use Nette\Application\UI\Form;

/**
 * @method onSuccess(Article $article)
 */
class ArticleEditForm extends FormControl
{
    public $onSuccess = [];

    /** @var ArticleFacade */
    protected $articleFacade;

    /** @var Article */
    protected $article;

    /**
     * ArticleAddForm constructor.
     * @param ArticleFacade $articleFacade
     * @param Article $article
     */
    public function __construct(ArticleFacade $articleFacade, Article $article)
    {
        parent::__construct();
        $this->articleFacade = $articleFacade;
        $this->article = $article;
    }

    public function render()
    {
        $this->getTemplate()->setFile(__DIR__ . '/ArticleEditForm.latte');
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
            ->setRequired()
            ->setDefaultValue($this->article->getTitle());

        $form->addTextArea("content", "messages.article.content")
            ->setAttribute("autocomplete", "off")
            ->setAttribute("placeholder", "messages.article.content")
            ->setRequired()
            ->setDefaultValue($this->article->getContent());

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
        $article = $this->article;
        $article->setTitle($values['title'])
            ->setContent($values['content']);

        $this->articleFacade->update($article);

        $this->onSuccess($article);
    }
}