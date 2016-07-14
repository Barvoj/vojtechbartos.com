<?php

namespace Article\Components\ArticleForm\Forms;

use Article\Components\ArticleForm\ArticleForm;
use Article\Components\ArticleForm\ArticleValues;
use Article\Model\Entities\Article;
use Article\Model\Facades\ArticleFacade;
use Nette\Application\UI\Form;

class ArticleAddForm extends ArticleForm
{
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

    /**
     * @return Form
     */
    protected function createComponentForm() : Form
    {
        $this->addTitle();
        $this->addContent();

        return parent::createComponentForm();
    }

    /**
     * @param Form $form
     * @param ArticleValues $values
     */
    protected function formSucceeded(Form $form, ArticleValues $values)
    {
        $article = new Article();
        $article->setTitle($values->title)
            ->setContent($values->content)
            ->setUserId(1);

        $this->articleFacade->insert($article);

        $this->onSuccess($article);
    }
}