<?php

namespace Article\Components\ArticleForm\Forms;


use Article\Components\ArticleForm\ArticleForm;
use Article\Components\ArticleForm\ArticleValues;
use Article\Model\Entities\Article;
use Article\Model\Facades\ArticleFacade;
use Nette\Application\UI\Form;

class ArticleEditForm extends ArticleForm
{
    /** @var ArticleFacade */
    protected $articleFacade;

    /** @var Article */
    protected $article;

    public function __construct(Article $article, ArticleFacade $articleFacade)
    {
        parent::__construct();
        $this->article = $article;
        $this->articleFacade = $articleFacade;
    }

    /**
     * @return Form
     */
    protected function createComponentForm() : Form
    {
        $this->addTitle()->setDefaultValue($this->article->getTitle());
        $this->addContent()->setDefaultValue($this->article->getContent());

        return parent::createComponentForm();
    }

    /**
     * @param Form $form
     * @param ArticleValues $values
     */
    protected function formSucceeded(Form $form, ArticleValues $values)
    {
        $article = $this->article;
        $article->setTitle($values->title)
            ->setContent($values->content);

        $this->articleFacade->update($article);

        $this->onSuccess($article);
    }
}