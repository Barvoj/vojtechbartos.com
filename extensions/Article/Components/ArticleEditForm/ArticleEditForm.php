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
    const INPUT_TITLE = 'title';
    const INPUT_CONTENT = 'content';

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

        $form->addText(self::INPUT_TITLE, "messages.article.title")
            ->setAttribute("autocomplete", "off")
            ->setAttribute("placeholder", "messages.article.title")
            ->setRequired()
            ->setDefaultValue($this->article->getTitle());

        $form->addTextArea(self::INPUT_CONTENT, "messages.article.content")
            ->setAttribute("autocomplete", "off")
            ->setAttribute("placeholder", "messages.article.content")
            ->setRequired()
            ->setDefaultValue($this->article->getContent());

        $form->addSubmit(self::INPUT_SUBMIT, "messages.article.save");

        $form->onSuccess[] = function(Form $form, $values) {
            $this->formSucceeded($form, new ArticleValues($values));
        };

        return $form;
    }

    /**
     * Callback on form success
     * @param Form $form
     * @param ArticleValues $values
     */
    private function formSucceeded(Form $form, ArticleValues $values)
    {
        $article = $this->article;
        $article->setTitle($values->title)
            ->setContent($values->content);

        $this->articleFacade->update($article);

        $this->onSuccess($article);
    }
}