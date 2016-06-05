<?php

namespace Article\Components\Article;


use Article\Model\Entities\Article as EntityArticle;
use Libs\Application\UI\Control;
use Libs\Text\Preprocesor;

class Article extends Control
{
    /** @var EntityArticle */
    protected $article;
    /** @var Preprocesor */
    private $preprocesor;

    /**
     * ArticleList constructor.
     * @param EntityArticle $article
     * @param Preprocesor $preprocesor
     */
    public function __construct(EntityArticle $article, Preprocesor $preprocesor)
    {
        parent::__construct();
        $this->article = $article;
        $this->preprocesor = $preprocesor;
    }

    public function render()
    {
        $this->getTemplate()->setFile(__DIR__ . '/Article.latte');

        $this->template->title = $this->article->getTitle();
        $this->template->content = $this->preprocesor->process($this->article->getContent());

        $this->getTemplate()->render();
    }
}