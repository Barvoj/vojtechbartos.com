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
    const INPUT_TITLE = 'title';
    const INPUT_CONTENT = 'content';

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

        $form->addText(self::INPUT_TITLE, "messages.article.title")
            ->setAttribute("autocomplete", "off")
            ->setAttribute("placeholder", "messages.article.title")
            ->setRequired();

        $form->addTextArea(self::INPUT_CONTENT, "messages.article.content")
            ->setAttribute("autocomplete", "off")
            ->setAttribute("placeholder", "messages.article.content")
            ->setRequired();

        $form->addSubmit(self::INPUT_SUBMIT, "messages.article.save");

        $form->onSuccess[] = function(Form $form, $values) {
            $this->formSucceeded($form, new ArticleValues($values));
        };

        return $form;
    }

    /**
     * Callback on form success
     * @param Form $form
     * @param $values
     */
    private function formSucceeded(Form $form, ArticleValues $values)
    {
        $article = new Article();
        $article->setTitle($values->title)
            ->setContent($values->content)
            ->setUserId(1);

        $this->articleFacade->insert($article);

        $this->onSuccess($article);
    }
}